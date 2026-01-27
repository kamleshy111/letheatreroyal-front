<?php

class Contact {
	protected static $connection;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM `contact` ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO `contact` (id, name, email, subject, message, language, date, browser, IP)
                VALUES (:id, :name, :email, :subject, :message, 'fr', :date, :browser, :IP);");
			$statement->bindValue(":date", NOW);
			$statement->bindValue(":browser", $_SERVER["HTTP_USER_AGENT"]);
			$statement->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
		} else {
			$statement = self::$connection->prepare("UPDATE `contact` SET
                `name` = :name, email = :email, subject = :subject, message = :message
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":name", $this->name);
		$statement->bindValue(":email", $this->email);
		$statement->bindValue(":subject", $this->subject);
		$statement->bindValue(":message", $this->message);
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
		               ->prepare("SELECT c.*
                FROM contact c
                WHERE " . $whereClauseTxt . "
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
			$row = self::get(array("clause" => "c.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id      = $row->id;
		$obj->name    = $row->name;
		$obj->email   = $row->email;
		$obj->subject = $row->subject;
		$obj->message = $row->message;
		$obj->date    = $row->date;
		$obj->browser = $row->browser;
		$obj->IP      = $row->IP;

		return $obj;
	}

	public static function sendToUs($id) {
		$contact = self::getOne($id);
		$msg     = '<h3 style="font-family: Arial; font-size: 16px; color: #000;">' . $contact->subject->subject . '</h3>
<table cellspacing="0" cellpadding="0" border="1">
<tr>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">Nom:</td>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">' . $contact->name . '</td>
</tr>
<tr>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">Courriel:</td>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;"><a href="mailto:' . $contact->email . '">' . $contact->email . '</a></td>
</tr>
<tr>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">Sujet:</td>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">' . $contact->subject . '</td>
</tr>
<tr>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">Message:</td>
<td valign="top" style="font-family: Arial; font-size: 13px; color: #000; padding: 2px 4px;">' . nl2br($contact->message) . '</td>
</tr>
</table>
<p style="font-family: Arial; font-size:10px;color:#999;">Date: ' . $contact->date . ' - IP: ' . $contact->IP . ' - ' . $contact->browser . '</p>
';
		$mail    = new PHPMailer\PHPMailer\PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->MessageDate = date(DATE_RFC822, strtotime($contact->date));
			$mail->SMTPAuth    = true;
			$mail->Host        = SMTPSERVER;
			$mail->Username    = SMTPUSER;
			$mail->Password    = SMTPPASSWORD;
			$mail->Port        = SMTPPORT;
			$mail->SMTPOptions = SMTPOPTIONS;
			$mail->Encoding    = "base64";
			$mail->SetFrom("info@" . DOMAIN, SITENAME);
			if (STATUS == "dev") {
				$mail->AddAddress("seb@jaguar.tech", "Jaguar Tech");
			} else {
				$mail->AddAddress("info@letheatreroyal.com", CUSTOMER_NAME);
				$mail->AddAddress("beatrice@letheatreroyal.com", CUSTOMER_NAME);
				$mail->AddCC("info@agencelafond.com", "Agence Marie-Ève Lafond");
			}
			$mail->AddReplyTo($contact->email, $contact->name);
			$mail->CharSet = "UTF-8";
			$mail->Subject = "Message provenant du site Internet " . PROJECT_NAME;
			$mail->isHTML(true);
			$mail->Body = $msg;
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
}

?>