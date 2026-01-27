<?php

class Registration {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE registration SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM registration ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO registration (id, `type`, firstname, lastname, birthdate, school, fatherFirstname, fatherLastname, motherFirstname, motherLastname, email, phone, emergencyContact, emergencyPhone, allergies, heardAbout, consent, `date`, IP)
                VALUES (:id, :type, :firstname, :lastname, :birthdate, :school, :fatherFirstname, :fatherLastname, :motherFirstname, :motherLastname, :email, :phone, :emergencyContact, :emergencyPhone, :allergies, :heardAbout, :consent, :date, :IP);");
			$statement->bindValue(":consent", $this->consent);
			$statement->bindValue(":date", NOW);
			$statement->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
		} else {
			$statement = self::$connection->prepare("UPDATE registration SET
                `type` = :type, firstname = :firstname, lastname = :lastname, birthdate = :birthdate, school = :school, fatherFirstname = :fatherFirstname, fatherLastname = :fatherLastname, motherFirstname = :motherFirstname, motherLastname = :motherLastname, email = :email, phone = :phone, emergencyContact = :emergencyContact, emergencyPhone = :emergencyPhone, allergies = :allergies, heardAbout = :heardAbout
                WHERE (id = :id) LIMIT 1;");
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":type", $this->type);
		$statement->bindValue(":firstname", $this->firstname);
		$statement->bindValue(":lastname", $this->lastname);
		$statement->bindValue(":birthdate", $this->birthdate);
		$statement->bindValue(":school", $this->school);
		$statement->bindValue(":fatherFirstname", $this->fatherFirstname);
		$statement->bindValue(":fatherLastname", $this->fatherLastname);
		$statement->bindValue(":motherFirstname", $this->motherFirstname);
		$statement->bindValue(":motherLastname", $this->motherLastname);
		$statement->bindValue(":email", $this->email);
		$statement->bindValue(":phone", $this->phone);
		$statement->bindValue(":emergencyContact", $this->emergencyContact);
		$statement->bindValue(":emergencyPhone", $this->emergencyPhone);
		$statement->bindValue(":allergies", $this->allergies);
		$statement->bindValue(":heardAbout", $this->heardAbout);
		$statement->execute();

		if ($this->dayCareDate) {
			$statement = self::$connection->prepare("UPDATE registration SET dayCareDate = :dayCareDate WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":dayCareDate", $this->dayCareDate);
			$statement->execute();
		}
		if ($this->campDate) {
			$statement = self::$connection->prepare("UPDATE registration SET campDate = :campDate WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":campDate", json_encode($this->campDate));
			$statement->execute();
		}
		if ($this->subTotal > 0) {
			$statement = self::$connection->prepare("UPDATE registration SET subTotal = :subTotal, gst = :gst, pst = :pst, total = :total, paymentOption = :paymentOption, nbPayment = :nbPayment WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":paymentOption", $this->paymentOption);
			$statement->bindValue(":subTotal", cleanAmount($this->subTotal));
			$statement->bindValue(":gst", cleanAmount($this->gst));
			$statement->bindValue(":pst", cleanAmount($this->pst));
			$statement->bindValue(":total", cleanAmount($this->total));
			$statement->bindValue(":nbPayment", (($this->paymentOption == "monthly") ? $_SESSION["transactionData"]["nbPayment"] : 1));
			$statement->execute();
		}
		self::spreadRegCamp($this->id);

		if (!Customer::ifCustomerExist($this->email)) {
			$customerObj                 = new Customer();
			$customerObj->email          = $this->email;
			$customerObj->stripeCustomer = "";
			$customerObj->save();
		}

		return $this->id;
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT r.*
                FROM registration r
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
			$row = self::get(array("clause" => "r.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$dayCareLst = array();
		$campLst    = array();
		foreach (json_decode($row->campDate) as $actCamp) {
			if ($row->type == "artcamp") {
				$campLst[] = ArtCamp::getOne($actCamp->id);
			} elseif ($row->type == "daycamp") {
				$campLst[] = DayCamp::getOne($actCamp->id);
				if ($actCamp->dayCare == "Y") {
					$dayCareLst[$actCamp->id] = $actCamp->id;
				}
			} elseif ($row->type == "theaterschool") {
				$campLst[] = TheaterSchool::getOne($actCamp->id);
			}
		}
		$obj->id               = $row->id;
		$obj->type             = $row->type;
		$obj->typeTxt          = self::getRegistrationType($row->type);
		$obj->firstname        = $row->firstname;
		$obj->lastname         = $row->lastname;
		$obj->childrenName     = $row->firstname . " " . $row->lastname;
		$obj->birthdate        = $row->birthdate;
		$obj->school           = $row->school;
		$obj->fatherFirstname  = $row->fatherFirstname;
		$obj->fatherLastname   = $row->fatherLastname;
		$obj->fatherName       = $row->fatherFirstname . " " . $row->fatherLastname;
		$obj->motherFirstname  = $row->motherFirstname;
		$obj->motherLastname   = $row->motherLastname;
		$obj->motherName       = $row->motherFirstname . " " . $row->motherLastname;
		$obj->email            = $row->email;
		$obj->phone            = formatPhone($row->phone);
		$obj->emergencyContact = $row->emergencyContact;
		$obj->emergencyPhone   = $row->emergencyPhone;
		$obj->allergies        = $row->allergies;
		$obj->heardAbout       = $row->heardAbout;
		$obj->consent          = $row->consent;
		$obj->dayCareDate      = $row->dayCareDate;
		$obj->campDate         = $row->campDate;
		$obj->description      = "Inscription #" . $row->id . " - " . $obj->typeTxt . " - " . $obj->childrenName;
		$obj->subtotal         = $row->subtotal;
		$obj->gst              = $row->gst;
		$obj->pst              = $row->pst;
		$obj->total            = $row->total;
		$obj->nbPayment        = $row->nbPayment;
		$obj->payment          = Payment::get(array("clause" => "(`type` = 'registration') AND (idType = " . $row->id . ")"), "date");
		$obj->paymentSchedule  = Payment::getScheduledPayment(array("clause" => "(idRegistration = " . $row->id . ") AND (captured = 'N')"), "date");
		$obj->campLst          = $campLst;
		$obj->dayCareLst       = $dayCareLst;

		return $obj;
	}

	// Simple formatter compatible with PHP 7+ (money_format is removed in PHP 8).
	private static function formatAmount($value) {
		return number_format((float) $value, 2, ".", "");
	}

	public static function getRegistrationTotal($data) {
		$total        = 0;
		$totalDayCare = 0;
		$subtotal     = 0;
		$gst          = 0;
		$pst          = 0;
		$tax          = 0;
		$nbPayment    = 1;
		$firstDate    = date("Y-m-d", strtotime("+10 year", strtotime(date("Y-m-d"))));

		$fp = fopen(INCLUDE_PATH . "/temp-total.txt", "w");
		fwrite($fp, NOW . "\n" . $data["type"] . " / " . $firstDate);

		if ($data["type"] == "daycare") {
			$subtotal = DAYCAREPRICE;
		} else {
			$campLst = array();
			if ($data["type"] == "artcamp") {
				foreach ($data["artcamp"] as $actCamp) {
					$campLst[] = ArtCamp::getOne($actCamp);
				}
			} elseif ($data["type"] == "daycamp") {
				foreach ($data["daycamp"] as $actCamp) {
					$currentCampData = DayCamp::getOne($actCamp);
					$campLst[]       = $currentCampData;
					if ($data["campDayCare-" . $actCamp] == "Y") {
						$totalDayCare += $currentCampData->campDays->total;
					}
				}
			} elseif ($data["type"] == "theaterschool") {
				foreach ($data["theaterschool"] as $actCamp) {
					$campLst[] = TheaterSchool::getOne($actCamp);
				}
			}
			foreach ($campLst as $actCamp) {
				$subtotal += $actCamp->price;
				if ($firstDate > $actCamp->dateStart) {
					$firstDate = $actCamp->dateStart;
				}
			}
			if ($data["type"] == "daycamp") {
				if (count($campLst) == 4) {
					$totalDayCare = 0;
				}
				if (count($campLst) >= 3) {
					$subtotal = ($subtotal * .85);
				}
			}
			if ($subtotal > 0) {
				$nbPayment             = getTotalMonth(NOW, $firstDate);
				$_SESSION["tempMonth"] = getTotalMonth(NOW, $firstDate);
			}
		}
		$subtotal                    += ($totalDayCare * DAYCAMPDAYCAREPRICE);
		$gst                         += round(($subtotal * GSTRATE), 2);
		$pst                         += round(($subtotal * PSTRATE), 2);
		$tax                         = ($gst + $pst);
		$total                       = ($subtotal + $gst + $pst);
		$monthlySubTotal             = ($nbPayment > 0) ? ($subtotal / $nbPayment) : 0;
		$monthlyGst                  = round(($monthlySubTotal * GSTRATE), 2);
		$monthlyPst                  = round(($monthlySubTotal * PSTRATE), 2);
		$monthlyTotal                = ($monthlySubTotal + $monthlyGst + $monthlyPst);
		$_SESSION["transactionData"] = array(
			"subtotal"         => self::formatAmount($subtotal),
			"gst"              => self::formatAmount($gst),
			"pst"              => self::formatAmount($pst),
			"tax"              => self::formatAmount($tax),
			"total"            => self::formatAmount($total),
			"transactionAmount"=> self::formatAmount($total),
			"firstDate"        => $firstDate,
			"monthlySubTotal"  => self::formatAmount($monthlySubTotal),
			"monthlyGst"       => self::formatAmount($monthlyGst),
			"monthlyPst"       => self::formatAmount($monthlyPst),
			"monthlyPayment"   => self::formatAmount($monthlyTotal),
			"nbPayment"        => $nbPayment
		);

		fwrite($fp, "\n" . $firstDate . "\n" . print_r($_SESSION, true));
		fclose($fp);

		return $_SESSION["transactionData"];
	}

	public static function sendToCustomer($idRegistration) {
		if ($registration = self::getOne($idRegistration)) {
			$orderContent = "<h5>" . $registration->typeTxt . "</h5>";
			if ($registration->type == "daycare") {
				$orderContent .= "Journée du " . strftime("%e %B %Y", strtotime($registration->dayCareDate));
			} else {
				$orderContent .= "<ul>";
				foreach ($registration->campLst as $actCamp) {
					$orderContent .= "<li>";
					$orderContent .= $actCamp->name;
					if ($registration->type == "artcamp") {
						$orderContent .= " - " . $actCamp->datePeriod;
					} elseif ($registration->type == "daycamp") {
						$orderContent .= (($actCamp->title) ? $actCamp->title . " - " : "") . $actCamp->datePeriod;
						if (in_array($actCamp->id, $registration->dayCareLst)) {
							$orderContent .= " + service de garde";
						}
					}
					$orderContent .= "</li>";
				}
				$orderContent .= "</ul>";
			}
			if ($registration->payment[0]->methodPayment == "cc") {
				$ccConfirmation = "Paiement par carte de crédit<br/>Numéro de confirmation: " . $registration->payment[0]->transactionConfirmation;
			} elseif ($registration->payment[0]->methodPayment == "cc") {
				$ccConfirmation = "Comptant";
			} elseif ($registration->payment[0]->methodPayment == "specimen") {
				$ccConfirmation = "Spécimen chèque";
			} elseif ($registration->payment[0]->methodPayment == "bankinfo") {
				$ccConfirmation = "Coordonnées bancaires";
			}

			if (count($registration->paymentSchedule) > 0) {
				$paymentSchedule = "<h4>Calendrier des paiements</h4>";
			} else {
				$paymentSchedule = "<h4>Paiement</h4>";
			}
			$paymentSchedule .= "<table id='paymentSchedule'>";
			foreach ($registration->payment as $actPayment) {
				$paymentSchedule .= "<tr><td>" . strftime("%e %B %Y", strtotime($actPayment->date)) . "</td><td class='amount'>" . $actPayment->amount . "$</td><td>" . $actPayment->methodPaymentTxt . (($actPayment->methodPayment == "cc") ? " (" . $actPayment->transactionConfirmation . ")" : "") . "</td><td><i class=\"fa fa-check-square\" aria-hidden=\"true\"></i></td></tr>";
			}
			foreach ($registration->paymentSchedule as $actPayment) {
				$paymentSchedule .= "<tr><td>" . strftime("%e %B %Y", strtotime($actPayment->date)) . "</td><td class='amount'>" . $actPayment->amount . "$</td><td>Carte de crédit</td><td></td></tr>";
			}
			$paymentSchedule .= "</table>";

			$template = loadMailTemplate("templateMail.html");
			if ($registration->type == "theaterschool") {
				$myFile = INCLUDE_PATH . "/mail/registrationTheatherSchool.html";
			} else {
				$myFile = INCLUDE_PATH . "/mail/registration.html";
			}
			$fh       = fopen($myFile, "r");
			$mailBody = fread($fh, filesize($myFile));
			fclose($fh);

			$consentTxt = "";
			if ($registration->consent == "Y") {
				$consentTxt = "<hr/>Le parent autorise la réception de courriels concernant la programmation et l'inscription aux cours offerts, en septembre, à l'école du Théâtre royal ou concernant l'inscription à l'agence de casting Marie-Ève Lafond et souhaite être avisé par courriel, en avant-première, pour l'inscription aux camps l'année prochaine.";
			}
			if (($registration->type == "artcamp") || ($registration->type == "daycamp")) {
				$consentTxt .= "<br/>Veuillez prendre note qu'en raison des places très limitées, nous ne pouvons faire un remboursement et ce formulaire retourné sert de consentement.";
				if ($registration->type == "daycamp") {
					$consentTxt .= "<br/>Il est à prévoir que le deuxième jeudi de chaque bloc n'offre pas de service de garde en vue de la préparation du spectacle.";
				}
			}

			$mailBody = str_replace("[[mailContent]]", $mailBody, $template);
			$mailBody = str_replace("[[title]]", "<h1>Confirmation de votre inscription</h1>", $mailBody);
			$mailBody = str_replace("[[subtitle]]", "<h2>" . $registration->description . "</h2>", $mailBody);
			$mailBody = str_replace("[[firstname]]", $registration->firstname, $mailBody);
			$mailBody = str_replace("[[lastname]]", $registration->lastname, $mailBody);
			$mailBody = str_replace("[[birthdate]]", $registration->birthdate, $mailBody);
			$mailBody = str_replace("[[school]]", $registration->school, $mailBody);
			$mailBody = str_replace("[[fatherFirstname]]", $registration->fatherFirstname, $mailBody);
			$mailBody = str_replace("[[fatherLastname]]", $registration->fatherLastname, $mailBody);
			$mailBody = str_replace("[[motherFirstname]]", $registration->motherFirstname, $mailBody);
			$mailBody = str_replace("[[motherLastname]]", $registration->motherLastname, $mailBody);
			$mailBody = str_replace("[[email]]", $registration->email, $mailBody);
			$mailBody = str_replace("[[phone]]", $registration->phone, $mailBody);
			$mailBody = str_replace("[[emergencyContact]]", $registration->emergencyContact, $mailBody);
			$mailBody = str_replace("[[emergencyPhone]]", $registration->emergencyPhone, $mailBody);
			$mailBody = str_replace("[[allergies]]", $registration->allergies, $mailBody);
			$mailBody = str_replace("[[ccConfirmation]]", $ccConfirmation, $mailBody);
			$mailBody = str_replace("[[subtotal]]", $registration->subtotal, $mailBody);
			$mailBody = str_replace("[[gst]]", $registration->gst, $mailBody);
			$mailBody = str_replace("[[pst]]", $registration->pst, $mailBody);
			$mailBody = str_replace("[[total]]", $registration->total, $mailBody);
			$mailBody = str_replace("[[orderContent]]", $orderContent, $mailBody);
			$mailBody = str_replace("[[paymentSchedule]]", $paymentSchedule, $mailBody);
			$mailBody = str_replace("[[consent]]", $consentTxt, $mailBody);

			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			try {
				$mail->IsSMTP();
				$mail->MessageDate = date(DATE_RFC822, strtotime($registration->date));
				$mail->SMTPAuth    = true;
				$mail->Host        = SMTPSERVER;
				$mail->Port        = SMTPPORT;
				$mail->Username    = SMTPUSER;
				$mail->Password    = SMTPPASSWORD;
				$mail->SMTPOptions = SMTPOPTIONS;
				$mail->Encoding    = "base64";
				$mail->SetFrom("info@letheatreroyal.com", CUSTOMER_NAME);
				if (STATUS == "dev") {
					$mail->AddAddress("seb@jaguar.tech", $registration->childrenName);
				} else {
					$mail->AddAddress($registration->email, $registration->childrenName);
					if ($registration->type == "theaterschool") {
						$mail->AddCC("info@letheatreroyal.com", "Agence Marie-Ève Lafond");
						$mail->AddCC("theatre.royal@outlook.com", "Agence Marie-Ève Lafond");
					} else {
						$mail->AddCC("beatrice@letheatreroyal.com", CUSTOMER_NAME);
					}
					$mail->AddCC("info@agencelafond.com", "Agence Marie-Ève Lafond");
				}
				$mail->CharSet = "UTF-8";
				$mail->Subject = $registration->description;
				$mail->isHTML(true);
				$mail->AddEmbeddedImage(WWW_PATH . "/images/logo-mail.png", "logo-mail");
				$mail->Body = $mailBody;
				$mail->Send();
			} catch (Exception $e) {
				$logError = fopen(INCLUDE_PATH . "/error.txt", "w");
				fwrite($logError, NOW . "\n\n" . print_r($e, true));
				fclose($logError);
			} catch (\Exception $e) {
				$logError = fopen(INCLUDE_PATH . "/error.txt", "w");
				fwrite($logError, NOW . "\n\n" . print_r($e, true));
				fclose($logError);
			}
		}
	}

	public static function getRegistrationType($registrationType) {
		switch ($registrationType) {
			case "daycare":
				return "Service de garde artistique";
				break;
			case "artcamp":
				return "Camps artistiques";
				break;
			case "daycamp":
				return "Camp de jour";
				break;
			case "theaterschool":
				return "École de théâtre";
				break;
		}
	}

	public static function spreadRegCamp($idRegistration) {
		$statement = DB::getConnection()
		               ->prepare("DELETE FROM regCamp WHERE (idRegistration = :idRegistration);");
		$statement->bindValue(":idRegistration", $idRegistration);
		$statement->execute();
		if ($registration = self::getOne($idRegistration)) {
			foreach (json_decode($registration->campDate) as $actCamp) {
				$sql2 = self::$connection->prepare("INSERT INTO regCamp (`type`, idRegistration, idCamp, price) VALUES (:type, :idRegistration, :idCamp, :price);");
				$sql2->bindValue(":type", $registration->type);
				$sql2->bindValue(":idRegistration", $idRegistration);
				$sql2->bindValue(":idCamp", $actCamp->id);
				$sql2->bindValue(":price", $actCamp->price);
				$sql2->execute();
			}
		}
	}

	public static function getTotalRegistration($type = NULL, $idCamp = NULL, $nextFriday = NULL, $artCampLst = NULL, $dayCampLst = NULL, $theaterSchoolLst = NULL) {
		if (($type) && ($idCamp)) {
			if ($type == "daycare") {
				$statement = DB::getConnection()
				               ->prepare("SELECT COUNT(id) as total FROM registration r WHERE (`type` = :type) AND (dayCareDate = :idCamp);");
				$statement->bindValue(":type", $type);
			} else {
				$statement = DB::getConnection()
				               ->prepare("SELECT COUNT(idRegistration) as total FROM regCamp WHERE (`type` = :type) AND (idCamp = :idCamp);");
				$statement->bindValue(":type", $type);
			}
			$statement->bindValue(":idCamp", $idCamp);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_OBJ);

			return $row->total;
		} else {
			$totalArtCamp       = array();
			$totalDayCamp       = array();
			$totalTheaterSchool = array();
			$statement          = DB::getConnection()
			                        ->prepare("SELECT COUNT(id) as total FROM registration r WHERE (`type` = 'daycare') AND (dayCareDate = :dayCareDate);");
			$statement->bindValue(":dayCareDate", $nextFriday);
			$statement->execute();
			$row          = $statement->fetch(PDO::FETCH_OBJ);
			$totalDayCare = $row->total;

			foreach ($artCampLst as $actCamp) {
				$statement = DB::getConnection()
				               ->prepare("SELECT COUNT(idRegistration) as total FROM regCamp WHERE (`type` = 'artcamp') AND (idCamp = :idCamp);");
				$statement->bindValue(":idCamp", $actCamp->id);
				$statement->execute();
				$row                        = $statement->fetch(PDO::FETCH_OBJ);
				$totalArtCamp[$actCamp->id] = $row->total;
			}
			foreach ($dayCampLst as $actCamp) {
				$statement = DB::getConnection()
				               ->prepare("SELECT COUNT(idRegistration) as total FROM regCamp WHERE (`type` = 'daycamp') AND (idCamp = :idCamp);");
				$statement->bindValue(":idCamp", $actCamp->id);
				$statement->execute();
				$row                        = $statement->fetch(PDO::FETCH_OBJ);
				$totalDayCamp[$actCamp->id] = $row->total;
			}
			foreach ($dayCampLst as $actCamp) {
				$statement = DB::getConnection()
				               ->prepare("SELECT COUNT(idRegistration) as total FROM regCamp WHERE (`type` = 'theaterschool') AND (idCamp = :idCamp);");
				$statement->bindValue(":idCamp", $actCamp->id);
				$statement->execute();
				$row                              = $statement->fetch(PDO::FETCH_OBJ);
				$totalTheaterSchool[$actCamp->id] = $row->total;
			}

			return array("daycare" => $totalDayCare, "artcamp" => $totalArtCamp, "daycamp" => $totalDayCamp, "theaterschool" => $totalTheaterSchool);
		}
	}

	public static function getRegistration($type, $idCamp) {
		$lst       = array();
		$statement = DB::getConnection()
		               ->prepare("SELECT r.id FROM registration r JOIN regCamp rc ON (rc.idRegistration = r.id) WHERE (rc.`type` = :type) AND (rc.idCamp = :idCamp);");
		$statement->bindValue(":type", $type);
		$statement->bindValue(":idCamp", $idCamp);
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			//$lst[] = $row;
			$lst[] = self::getOne($row->id);
		}

		return $lst;
	}

	public static function sendHoliday($idRegistration) {
		if ($registration = self::getOne($idRegistration)) {
			$template = loadMailTemplate("templateMail.html");
			$myFile   = INCLUDE_PATH . "/mail/holiday.html";
			$fh       = fopen($myFile, "r");
			$mailBody = fread($fh, filesize($myFile));
			fclose($fh);

			$mailBody = str_replace("[[mailContent]]", $mailBody, $template);
			$mailBody = str_replace("[[title]]", "", $mailBody);
			$mailBody = str_replace("[[subtitle]]", "", $mailBody);

			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			try {
				$mail->IsSMTP();
				$mail->MessageDate = date(DATE_RFC822, strtotime(NOW));
				$mail->SMTPAuth    = true;
				$mail->Host        = SMTPSERVER;
				$mail->Port        = SMTPPORT;
				$mail->Username    = SMTPUSER;
				$mail->Password    = SMTPPASSWORD;
				$mail->SMTPOptions = SMTPOPTIONS;
				$mail->Encoding    = "base64";
				$mail->SetFrom("info@letheatreroyal.com", CUSTOMER_NAME);
				if (STATUS == "dev") {
					$mail->AddAddress("seb@jaguar.tech", $registration->childrenName);
				} else {
					$mail->AddAddress($registration->email, $registration->childrenName);
				}
				$mail->CharSet = "UTF-8";
				$mail->Subject = $registration->description;
				$mail->isHTML(true);
				$mail->AddEmbeddedImage(WWW_PATH . "/images/logo-mail.png", "logo-mail");
				$mail->AddEmbeddedImage(WWW_PATH . "/images/agencelafond.png", "agencelafond");
				$mail->Body = $mailBody;
				$mail->Send();
			} catch (Exception $e) {
				$logError = fopen(INCLUDE_PATH . "/error.txt", "w");
				fwrite($logError, NOW . "\n\n" . print_r($e, true));
				fclose($logError);
			} catch (\Exception $e) {
				$logError = fopen(INCLUDE_PATH . "/error.txt", "w");
				fwrite($logError, NOW . "\n\n" . print_r($e, true));
				fclose($logError);
			}
		}
	}
}

?>