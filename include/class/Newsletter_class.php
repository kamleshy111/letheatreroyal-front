<?php

class Newsletter {
	protected static $connection;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function deleteSubscriber() {
		$statement = self::$connection->prepare("UPDATE newsletterRegistration SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function saveSubscriberEmail() {
		$statement = self::$connection->prepare("SELECT id FROM newsletterRegistration WHERE (email = :email) LIMIT 1;");
		$statement->bindValue(":email", trim($this->email));
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			$subscriber = self::getOne($row->id);
			if ($subscriber->confirmed == "N") {
				self::sendConfirmation($row->id);
			}
		} else {
			$statement = self::$connection->prepare("SELECT id FROM newsletterRegistration ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO newsletterRegistration (id, email, date)
                VALUES (:id, :email, :date);");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":email", $this->email);
			$statement->bindValue(":date", date("Y-m-d H:i:s"));
			$statement->execute();
			self::sendConfirmation($this->id);
		}
	}

	public function saveSubscriber() {
		if (!$this->id) {
			$this->id = self::getIdByEmail($this->email);
		}
		if (!$this->id) {
			$statement = self::$connection->prepare("SELECT id FROM newsletterRegistration ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO newsletterRegistration (id, active, firstname, lastname, email, date)
                VALUES (:id, 'Y', :firstname, :lastname, :email, :date);");
			$statement->bindValue(":date", date("Y-m-d H:i:s"));
		} else {
			$statement = self::$connection->prepare("UPDATE newsletterRegistration SET
                active = :active, firstname = :firstname, lastname = :lastname, email = :email
                WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":active", $this->active);
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":firstname", trim($this->firstname));
		$statement->bindValue(":lastname", trim($this->lastname));
		$statement->bindValue(":email", trim($this->email));
		$statement->execute();

		return $this->id;
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT s.*
                FROM newsletterRegistration s
                WHERE " . $whereClauseTxt . "
                AND (deleted = 'N')
                ORDER BY " . $orderBy . "
                LIMIT " . $limit);
		if (!empty($whereClause["clause"])) {
			if (!empty($whereClause["param"])) {
				foreach ($whereClause["param"] as $key => $value) {
					$statement->bindValue($key, $value);
				}
			}
		}
		$statement->execute();
		if ($limit > 1) {
			while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$obj = self::getOne($row);

				if ($obj != false) {
					$lst[] = $obj;
				}
			}

			return $lst;
		} else {
			$row = $statement->fetch(PDO::FETCH_OBJ);

			return $row;
		}
	}

	public static function getOne($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::get(array("clause" => "s.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id            = $row->id;
		$obj->firstname     = $row->firstname;
		$obj->lastname      = $row->lastname;
		$obj->name          = $row->firstname . " " . $row->lastname;
		$obj->email         = $row->email;
		$obj->date          = $row->date;
		$obj->confirmed     = $row->confirmed;
		$obj->confirmedDate = $row->confirmedDate;
		$obj->confirmedIP   = $row->confirmedIP;
		$obj->confirmKey    = $row->confirmKey;

		return $obj;
	}

	public static function getIdByEmail($email) {
		$statement = DB::getConnection()
		               ->prepare("SELECT id FROM newsletterRegistration WHERE (email = :email) AND (deleted = 'N') ORDER BY id DESC LIMIT 1;");
		$statement->bindValue(":email", $email);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return $row->id;
		}
	}

	public static function setSubscriberKey($idSubscriber) {
		$statement = DB::getConnection()
		               ->prepare("UPDATE `newsletterRegistration` SET confirmKey = :confirmKey WHERE (id = :id);");
		$statement->bindValue(":confirmKey", generatePassword(75, 7));
		$statement->bindValue(":id", $idSubscriber);
		$statement->execute();
	}

	public static function sendConfirmation($id) {
		self::setSubscriberKey($id);
		$registration = self::getOne($id);

		$template = loadMailTemplate("template.html");
		$myFile   = INCLUDE_PATH . "/mail/newsletterRegistrationConfirmation.html";
		$fh       = fopen($myFile, "r");
		$mailBody = fread($fh, filesize($myFile));
		fclose($fh);
		$mailBody = str_replace("[[mailContent]]", $mailBody, $template);

		$externalLink = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/confirmRegistration/?id=" . $id . "&email=" . $registration->email . "&k=" . $registration->confirmKey;
		$mailBody     = str_replace("[[title]]", "<h1>Confirmation de votre inscription</h1>", $mailBody);
		$mailBody     = str_replace("[[subtitle]]", "", $mailBody);
		$mailBody     = str_replace("[[email]]", $registration->email, $mailBody);
		$mailBody     = str_replace("[[externalLink]]", $externalLink, $mailBody);
		$mailBody     = str_replace("[[serial]]", NOW, $mailBody);

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->MessageDate = date(DATE_RFC822, strtotime($registration->date));
			$mail->SMTPAuth    = true;
			$mail->Host        = SMTPSERVER;
			$mail->Username    = SMTPUSER;
			$mail->Password    = SMTPPASSWORD;
			$mail->Port        = SMTPPORT;
			$mail->SMTPOptions = SMTPOPTIONS;
			$mail->Encoding    = "base64";
			$mail->SetFrom("info@" . DOMAIN, CUSTOMER_NAME);
			$mail->AddAddress($registration->email, $registration->name);
			if (STATUS == "dev") {
				$mail->AddAddress("seb@jaguar.tech", "Sébastien Knap");
				$mail->AddAddress($registration->email);
			} else {
				$mail->AddAddress($registration->email);
			}
			$mail->CharSet = "UTF-8";
			$mail->Subject = "Confirmation de votre abonnement";
			$mail->isHTML(true);
			$mail->AddEmbeddedImage(WWW_PATH . "/images/logo-mail.png", "logo-mail");
			$mail->Body = $mailBody;
			$mail->Send();
		} catch (Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "w");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		} catch (\Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "w");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		}
	}

	public static function sendSubscription($id) {
		$registration = self::getOne($id);

		$template = loadMailTemplate("template.html");
		$myFile   = INCLUDE_PATH . "/mail/newsletterRegistration.html";
		$fh       = fopen($myFile, "r");
		$mailBody = fread($fh, filesize($myFile));
		fclose($fh);

		$mailBody = str_replace("[[mailContent]]", $mailBody, $template);
		$mailBody = str_replace("[[title]]", "<h1>Nouvelle inscription à l'infolettre</h1>", $mailBody);
		$mailBody = str_replace("[[subtitle]]", "", $mailBody);
		$mailBody = str_replace("[[name]]", $registration->name, $mailBody);
		$mailBody = str_replace("[[email]]", $registration->email, $mailBody);
		$mailBody = str_replace("[[serial]]", NOW, $mailBody);

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->MessageDate = date(DATE_RFC822, strtotime($registration->confirmedDate));
			$mail->SMTPAuth    = true;
			$mail->Host        = SMTPSERVER;
			$mail->Username    = SMTPUSER;
			$mail->Password    = SMTPPASSWORD;
			$mail->Port        = SMTPPORT;
			$mail->SMTPOptions = SMTPOPTIONS;
			$mail->Encoding    = "base64";
			$mail->SetFrom("info@" . DOMAIN, CUSTOMER_NAME);
			$mail->AddReplyTo($registration->email, $registration->name);
			if (STATUS == "dev") {
				$mail->AddAddress("seb@jaguar.tech", "Sébastien Knap");
			} else {
				$mail->AddAddress("info@letheatreroyal.com", CUSTOMER_NAME);
			}
			$mail->CharSet = "UTF-8";
			$mail->Subject = "Abonnement à l'infolettre";
			$mail->isHTML(true);
			$mail->AddEmbeddedImage(WWW_PATH . "/images/logo-mail.png", "logo-mail");
			$mail->Body = $mailBody;
			$mail->Send();
		} catch (Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "w");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		} catch (\Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "w");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		}
	}

	public static function confirmSubscription($email, $key) {
		$statement = DB::getConnection()
		               ->prepare("SELECT id FROM newsletterRegistration WHERE (`email` = :email) AND (confirmKey = :key);");
		$statement->bindValue(":email", $email);
		$statement->bindValue(":key", $key);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			$statementC = DB::getConnection()
			                ->prepare("UPDATE newsletterRegistration SET confirmed = 'Y', confirmedDate = :NOW, confirmedIP = :IP, confirmKey = '' WHERE (id = :id);");
			$statementC->bindValue(":id", $row->id);
			$statementC->bindValue(":NOW", NOW);
			$statementC->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
			$statementC->execute();
			$_SESSION["isNewsletterSubscriber"] = true;
		}
	}
}

?>