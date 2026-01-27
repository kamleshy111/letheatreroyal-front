<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Payment {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE payment SET canceled = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if ($this->amount > 0) {
			if (empty($this->id)) {
				$statement = self::$connection->prepare("SELECT id FROM payment ORDER BY id DESC LIMIT 0, 1;");
				$statement->execute();
				$row       = $statement->fetch(PDO::FETCH_OBJ);
				$this->id  = (intval($row->id) + 1);
				$statement = self::$connection->prepare("INSERT INTO payment (id, `type`, idType, methodPayment, transactionConfirmation, subtotal, gst, pst, amount, cardBrand, cardLast4, description, `date`, `note`, creationDate, IP)
                VALUES (:id, :type, :idType, :methodPayment, :transactionConfirmation, :subtotal, :gst, :pst, :amount, :cardBrand, :cardLast4, :description, :date, :note, :creationDate, :IP);");
				$statement->bindValue(":creationDate", NOW);
				$statement->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
			} else {
				$statement = self::$connection->prepare("UPDATE payment SET
                `type` = :type, idType = :idType, methodPayment = :methodPayment, transactionConfirmation = :transactionConfirmation, subtotal = :subtotal, gst = :gst, pst = :pst, amount = :amount, cardBrand = :cardBrand, cardLast4 = :cardLast4, description = :description, `date` = :date, `note` = :note
				WHERE (id = :id) LIMIT 1;");
			}
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":type", $this->type);
			$statement->bindValue(":idType", $this->idType);
			$statement->bindValue(":methodPayment", $this->methodPayment);
			$statement->bindValue(":transactionConfirmation", $this->transactionConfirmation);
			if ($this->paymentOption == "monthly") {
				$statement->bindValue(":subtotal", cleanAmount($_SESSION["transactionData"]["monthlySubTotal"]));
				$statement->bindValue(":gst", cleanAmount($_SESSION["transactionData"]["monthlyGst"]));
				$statement->bindValue(":pst", cleanAmount($_SESSION["transactionData"]["monthlyPst"]));
				$statement->bindValue(":amount", cleanAmount($_SESSION["transactionData"]["monthlyPayment"]));
			} else {
				$statement->bindValue(":subtotal", cleanAmount($this->subtotal));
				$statement->bindValue(":gst", cleanAmount($this->gst));
				$statement->bindValue(":pst", cleanAmount($this->pst));
				$statement->bindValue(":amount", cleanAmount($this->amount));
			}
			$statement->bindValue(":cardBrand", $this->cardBrand);
			$statement->bindValue(":cardLast4", $this->cardLast4);
			$statement->bindValue(":description", $this->description);
			$statement->bindValue(":date", $this->date);
			$statement->bindValue(":note", $this->note);
			$statement->execute();
		}

		if (($this->methodPayment == "cc") && ($_SESSION["stripeToken"])) {
			$statement = self::$connection->prepare("UPDATE payment SET stripeToken = :stripeToken WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":stripeToken", $_SESSION["stripeToken"]);
			$statement->execute();
		}

		if (($this->paymentOption == "monthly") && ($_SESSION["transactionData"]["nbPayment"] > 1)) {
			$this->programFuturePayment();
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
		               ->prepare("SELECT p.*
                FROM payment p
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
			$row = self::get(array("clause" => "p.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id                      = $row->id;
		$obj->type                    = $row->type;
		$obj->idType                  = $row->idType;
		$obj->transactionConfirmation = $row->transactionConfirmation;
		$obj->idRegistration          = $row->idRegistration;
		$obj->amount                  = $row->amount;
		$obj->methodPayment           = $row->methodPayment;
		$obj->methodPaymentTxt        = self::getPaymentMethod($row->methodPayment);
		$obj->cardLast4               = $row->cardLast4;
		$obj->cardBrand               = $row->cardBrand;
		$obj->cardName                = $row->name;
		$obj->date                    = $row->date;
		$obj->note                    = $row->note;
		$obj->captured                = $row->captured;
		$obj->description             = $row->description;

		return $obj;
	}

	public static function getScheduledPayment($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT pc.*
                FROM paymentCalendar pc
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
				$obj = self::getOneScheduledPayment($row);

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

	public static function getOneScheduledPayment($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::getScheduledPayment(array("clause" => "pc.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id             = $row->id;
		$obj->idRegistration = $row->idRegistration;
		$obj->subtotal       = $row->subtotal;
		$obj->gst            = $row->gst;
		$obj->pst            = $row->pst;
		$obj->amount         = $row->amount;
		$obj->date           = $row->date;
		$obj->captured       = $row->captured;
		$obj->ccConfirmation = $row->ccConfirmation;

		return $obj;
	}

	public static function getTotalPayment($idType, $type = "registration") {
		$obj       = new self;
		$statement = DB::getConnection()
		               ->prepare("SELECT SUM(amount) as total FROM payment WHERE (`type` = :type) AND (idType = :idType);");
		$statement->bindValue(":type", $type);
		$statement->bindValue(":idType", $idType);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_OBJ);

		return $row;
	}

	public static function getByIdType($idType, $type = "registration") {
		$statement = DB::getConnection()
		               ->prepare("SELECT id FROM payment WHERE (`type` = :type) AND (idType = :idType);");
		$statement->bindValue(":type", $type);
		$statement->bindValue(":idType", $idType);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return self::getOne($row->id);
		}
	}

	public static function getPaymentMethod($method = NULL) {
		$paymentMethod = array(array("value" => "cheque", "name" => "Chèque"), array("value" => "cc", "name" => "Carte de crédit"), array("value" => "wire", "name" => "Transfert bancaire"));
		if ($method) {
			foreach ($paymentMethod as $actMethod) {
				if ($method == $actMethod["value"]) {
					return $actMethod["name"];
				}
			}
		} else {
			return ($paymentMethod);
		}
	}

	public static function sendReceipt($idPayment) {
		$payment = self::getOne($idPayment);
		if ($payment->type == "activityRegistration") {
			$registration = Activity::getOneRegistration($payment->idType);
			$member       = Member::getOne($registration->idMember);
			$data         = json_decode($registration->data);
			$total        = $data->total;
		} elseif ($payment->type == "membership") {
			$registration = Member::getOne($payment->idType);
			$data         = json_decode($registration->data);
			if ($data->action == "add") {
				$description = "Nouvelle adhésion: " . $data->AccountName;
			}
			$total = $payment->amount;
		}

		$myFile = INCLUDE_PATH . "/mail/receipt.html";
		$fh     = fopen($myFile, "r");
		$data   = fread($fh, filesize($myFile));
		fclose($fh);

		$data = str_replace("[[now]]", $payment->date, $data);
		$data = str_replace("[[transactionConfirmation]]", $payment->transactionConfirmation, $data);
		$data = str_replace("[[amount]]", number_format((float) $total, 2), $data);
		$data = str_replace("[[card]]", $payment->cardName, $data);
		$data = str_replace("[[cardLast4]]", $payment->cardLast4, $data);
		$data = str_replace("[[description]]", $payment->description, $data);
		$msg  = $data;

		$mail = new PHPMailer(true);
		try {
			$mail->IsSMTP();
			$mail->MessageDate = date(DATE_RFC822, strtotime($payment->date));
			$mail->SMTPAuth    = true;
			$mail->Host        = "mail.letheatreroyal.com";
			$mail->Port        = 2225;
			$mail->Username    = "site@letheatreroyal.com";
			$mail->Password    = "vu*y8ejU_AMa";
			$mail->SMTPOptions = array(
				"ssl" => array(
					"verify_peer"       => false,
					"verify_peer_name"  => false,
					"allow_self_signed" => true
				)
			);
			$mail->Encoding    = "base64";
			$mail->SetFrom("info@letheatreroyal.com", CUSTOMER_NAME);
			if (STATUS == "dev") {
				$mail->AddAddress("seb@jaguar.tech", "Sébastien Knap");
			} else {
				$mail->AddAddress($registration->email, $registration->name);
				$mail->AddCC("info@letheatreroyal.com", CUSTOMER_NAME);
			}
			$mail->AddCC("info@agencelafond.com", "Agence Marie-Ève Lafond");
			$mail->CharSet = "UTF-8";
			$mail->Subject = "Relevé de transaction";
			$mail->msgHTML($msg);
			$mail->isHTML(true);
			$mail->Body = $msg;
			$mail->Send();
		} catch (Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "a");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		} catch (\Exception $e) {
			$fp = fopen(INCLUDE_PATH . "/error.txt", "w");
			fwrite($fp, NOW . "\n\n" . print_r($e, true));
			fclose($fp);
		}
	}

	public static function updateDetail($idPayment, $idType, $idMember, $description) {
		$statement = DB::getConnection()
		               ->prepare("UPDATE payment SET idType = :idType, idMember = :idMember, `description` = :description WHERE (id = :id);");
		$statement->bindValue(":id", $idPayment);
		$statement->bindValue(":idType", $idType);
		$statement->bindValue(":idMember", $idMember);
		$statement->bindValue(":description", $description);
		$statement->execute();
	}

	public static function capturePayment($idPayment) {
		$payment = self::getOne($idPayment);
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		$ch = \Stripe\Charge::retrieve($payment->transactionConfirmation);
		$ch->capture();
		$statement = DB::getConnection()
		               ->prepare("UPDATE payment SET captured = 'Y' WHERE (id = :id);");
		$statement->bindValue(":id", $idPayment);
		$statement->execute();
	}

	public static function changePaymentDescription($idPayment, $description) {
		if ($description) {
			$payment   = self::getOne($idPayment);
			$statement = DB::getConnection()
			               ->prepare("UPDATE payment SET `description` = :description WHERE (id = :id);");
			$statement->bindValue(":description", $description);
			$statement->bindValue(":id", $idPayment);
			$statement->execute();
			$stripe = new \Stripe\StripeClient(STRIPE_SK);
			$stripe->charges->update($payment->transactionConfirmation, ["description" => $description]);
		}
	}

	public static function refundPayment($idPayment) {
		$payment = self::getOne($idPayment);
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		$ch        = \Stripe\Refund::create(["charge" => $payment->transactionConfirmation, "amount" => intval(str_replace(".", "", number_format($payment->amount, 2)))]);
		$statement = DB::getConnection()
		               ->prepare("UPDATE payment SET canceled = 'Y', captured = 'N' WHERE (id = :id);");
		$statement->bindValue(":id", $idPayment);
		$statement->execute();
	}

	public function stripePayment() {
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		try {
			$result                              = \Stripe\Charge::create(array("amount" => intval($this->amount), "currency" => "cad", "source" => $this->stripeToken, "capture" => $this->capture, "description" => $this->stripeDescription));
			$_SESSION["transactionConfirmation"] = $result->id;
			$_SESSION["cardBrand"]               = $result->source->brand;
			$_SESSION["cardLast4"]               = $result->source->last4;
			$_SESSION["fingerprint"]             = $result->source->fingerprint;
			$_SESSION["stripeToken"]             = $this->stripeToken;

			$fp = fopen(INCLUDE_PATH . "/tmp/result-" . time() . ".txt", "w");
			fwrite($fp, print_r($result, true));
			fclose($fp);

			$token = \Stripe\Token::retrieve($this->stripeToken, []);

			return array("status" => "00", "result" => $result);
		} catch (\Stripe\Error\Card $e) {
			$errorMessageLst = array(
				"incorrect_number"     => "Le numéro de la carte est invalide.",
				"invalid_number"       => "Le numéro de la carte est invalide.",
				"invalid_expiry_month" => "Le mois de la date d'expiration est invalide.",
				"invalid_expiry_year"  => "L'année de la date d'expiration est invalide.",
				"invalid_cvc"          => "Le code de sécurité est invalide.",
				"expired_card"         => "La carte est expirée.",
				"incorrect_cvc"        => "Le code de sécurité est invalide.",
				"card_declined"        => "La carte a été rejetée",
				"processing_error"     => "Une erreur est survenue durant le traitement de la carte.",
				"rate_limit"           => "An error occurred due to requests hitting the API too quickly. Please let us know if you're consistently running into this error."
			);
			$body            = json_decode($e);
			$err             = $body["error"];

			return $err["message"];
		} catch (Exception $e) {
			$body = json_decode($e);
			$err  = $body["error"];

			return $err["message"];
		}
	}

	public function programFuturePayment() {
		$startDate = NOW;
		if (date("d", strtotime($startDate)) > 28) {
			$date = new DateTime("now");
			$date->modify("first day of next month");
			$startDate = $date->format("Y-m-d");
		}
		for ($i = 1; $i < $this->nbPayment; $i++) {
			$startDate = date("Y-m-d", strtotime("+1 month", strtotime($startDate)));
			$statement = self::$connection->prepare("INSERT INTO paymentCalendar (idRegistration, subtotal, gst, pst, amount, `date`) VALUES (:idRegistration, :subtotal, :gst, :pst, :amount, :date);");
			$statement->bindValue(":idRegistration", $_SESSION["idRegistration"]);
			$statement->bindValue(":subtotal", cleanAmount($_SESSION["transactionData"]["monthlySubTotal"]));
			$statement->bindValue(":gst", cleanAmount($_SESSION["transactionData"]["monthlyGst"]));
			$statement->bindValue(":pst", cleanAmount($_SESSION["transactionData"]["monthlyPst"]));
			$statement->bindValue(":amount", cleanAmount($_SESSION["transactionData"]["monthlyPayment"]));
			$statement->bindValue(":date", $startDate);
			$statement->execute();
		}
	}

	public static function saveStripeClient($id = NULL, $idRegistration = NULL) {
		$registration = Registration::getOne($idRegistration);
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		if ($id) {
			$stripe = new \Stripe\StripeClient(STRIPE_SK);
			$client = $stripe->customers->update($id, ["email" => trim($registration->email), "description" => "Inscription #" . $registration->id]);
		} else {
			$client = \Stripe\Customer::create(["name" => $registration->fullname, "email" => trim($registration->email)]);
		}

		return $client;
	}

	public static function getStripeClient($id = NULL, $email = NULL) {
		$stripe = new \Stripe\StripeClient(STRIPE_SK);
		if ($id) {
			$result = $stripe->customers->retrieve($id, []);
		} else {
			$result = $stripe->customers->search(['query' => 'email:\'' . trim($email) . '\'']);
		}

		return array("total" => count($result["data"]), "data" => $result["data"], "id" => $result["data"][0]["id"]);
	}

	public static function attachStripePaymentMethod($idPaymentMethod, $idStripeCustomer, $idCharge) {
		$stripe            = new \Stripe\StripeClient(STRIPE_SK);
		$stripeCustomer    = $stripe->customers->retrieve($idStripeCustomer, []);
		$stripeCardPayment = $stripe->customers->allPaymentMethods($idStripeCustomer, ["type" => "card"]);
		$stripeCharge      = Payment::getCharge($idCharge);
		$cardFound         = false;

		foreach ($stripeCardPayment as $actCard) {
			if ($actCard->card->fingerprint == $stripeCharge->source->fingerprint) {
				$cardFound = true;
			}
		}
		if ($cardFound == false) {
			$stripe->paymentMethods->attach($idPaymentMethod, ["customer" => $idStripeCustomer]);
		}
	}

	public static function savePaymentCustomer($idPayment) {
		$payment = self::getOne($idPayment);
		if ($payment->type == "donation") {
			$data  = Donation::getOne($payment->idType);
			$donor = Donor::getOne($data->idDonor);
		}

		$stripe = new \Stripe\StripeClient(STRIPE_SK);
		$charge = $stripe->charges->retrieve($payment->transactionConfirmation, []);

		if (!$charge->customer) {
			$stripe->charges->update($payment->transactionConfirmation, ["customer" => $donor->idStripeCustomer]);
		}

		$card = $stripe->charges->retrieve($payment->transactionConfirmation, []); # card_1LOlnzFvzc7hnuF76fJhfAcR
	}

	public static function getCustomerPaymentMethod($idCustomer) {
		$stripe = new \Stripe\StripeClient(STRIPE_SK);

		return $stripe->customers->allPaymentMethods($idCustomer, ["type" => "card"]);
	}

	public static function getCharge($idCharge) {
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		$result = \Stripe\Charge::retrieve($idCharge);

		$fp = fopen(INCLUDE_PATH . "/tmp/" . $idCharge . ".txt", "w");
		fwrite($fp, print_r($result, true));
		fclose($fp);

		$stripe = new \Stripe\StripeClient(STRIPE_SK);

		return $stripe->charges->retrieve($idCharge, []);
	}

	public static function createScheduledCharge($idPayment) {
		$payment      = self::getOneScheduledPayment($idPayment);
		$registration = Registration::getOne($payment->idRegistration);
		$charge       = Payment::getCharge($registration->payment[0]->transactionConfirmation);
		$card         = "";
		if ($idCustomer = Customer::ifCustomerExist($registration->email)) {
			$customer     = Customer::getOne($idCustomer);
			$stripeSource = Customer::getClientStripeSource($customer->stripeCustomer);
			foreach ($stripeSource["data"] as $actSource) {
				$expiration = date("Y-m-t", strtotime($actSource["card"]["exp_year"] . "-" . str_pad($actSource["card"]["exp_month"], 2, "0", STR_PAD_LEFT) . "-01"));
				if (date("Y-m-d") <= $expiration) {
					$card = $actSource->id;
				}
			}
		}

		if (($customer->stripeCustomer) && ($card)) {
			$fp = fopen(INCLUDE_PATH . "/tmp/sch-charge-" . $idPayment . "-" . $customer->stripeCustomer . ".txt", "w");
			fwrite($fp, NOW . "\n" . $idPayment . "\n" . print_r($stripeSource, true) . "\n" . print_r($customer, true));
			fclose($fp);

			try {
				$intent = \Stripe\PaymentIntent::create(["customer" => $customer->stripeCustomer, "setup_future_usage" => "off_session", "amount" => str_replace(".", "", $payment->amount), "currency" => "cad", "payment_method_types" => ["card"], "payment_method" => $card, "description" => $registration->description]);
				$stripe = new \Stripe\StripeClient(STRIPE_SK);
				$stripe->paymentIntents->confirm($intent->id, ["payment_method" => $card]);

				$obj                          = new self();
				$obj->type                    = "registration";
				$obj->idType                  = $payment->idRegistration;
				$obj->idCustomer              = $idCustomer;
				$obj->methodPayment           = "cc";
				$obj->paymentOption           = "";
				$obj->nbPayment               = 1;
				$obj->subtotal                = cleanAmount($payment->subtotal);
				$obj->amount                  = cleanAmount($payment->amount);
				$obj->gst                     = cleanAmount($payment->gst);
				$obj->pst                     = cleanAmount($payment->pst);
				$obj->description             = $registration->description;
				$obj->transactionConfirmation = $intent->id;
				$obj->cardBrand               = ucfirst($actSource["card"]["brand"]);
				$obj->cardLast4               = $actSource["card"]["last4"];
				$obj->note                    = "";
				$obj->date                    = date("Y-m-d");
				$idPayment                    = $obj->save();

				$statement = DB::getConnection()
				               ->prepare("UPDATE payment SET captured = 'Y' WHERE (id = :id);");
				$statement->bindValue(":id", $idPayment);
				$statement->execute();

				$statement = DB::getConnection()
				               ->prepare("UPDATE paymentCalendar SET captured = 'Y', ccConfirmation = :ccConfirmation WHERE (id = :id) LIMIT 1;");
				$statement->bindValue(":id", $payment->id);
				$statement->bindValue(":ccConfirmation", $intent->id);
				$statement->execute();
			} catch (Exception $e) {
				$fp = fopen(INCLUDE_PATH . "/tmp/sch-charge-" . $idPayment . "-" . $customer->stripeCustomer . ".txt", "a");
				fwrite($fp, "\n\n" . print_r($e, true));
				fclose($fp);
			}
		}
	}

	public static function saveStripeToken($token) {
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		$result = \Stripe\Token::retrieve($token);

		$fp = fopen(INCLUDE_PATH . "/tmp/" . $token . ".txt", "w");
		fwrite($fp, print_r($result, true));
		fclose($fp);
	}
}

?>