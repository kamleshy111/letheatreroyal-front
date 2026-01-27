<?php
$donor   = "";
$result  = "";
$message = "";
if (($_POST["email"]) && ($_POST["amount"])) {
	require_once("../../include/config.php");
	$obj = new Registration();
	foreach ($_POST as $key => $value) {
		$obj->$key = $value;
	}
	if (($_POST["artcamp"]) || ($_POST["daycamp"]) || ($_POST["theaterschool"])) {
		$campLst = array();
		foreach ($_POST["artcamp"] as $actCamp) {
			$camp      = ArtCamp::getOne($actCamp);
			$campLst[] = array("id" => $actCamp, "price" => $camp->price);
		}
		foreach ($_POST["daycamp"] as $actCamp) {
			$camp      = DayCamp::getOne($actCamp);
			$campLst[] = array("id" => $actCamp, "price" => $camp->price, "dayCare" => (($_POST["campDayCare-" . $actCamp] == "Y") ? "Y" : "N"));
		}
		foreach ($_POST["theaterschool"] as $actCamp) {
			$camp      = TheaterSchool::getOne($actCamp);
			$campLst[] = array("id" => $actCamp, "price" => $camp->price);
		}
		$obj->campDate = $campLst;
	}
	if (!$_POST["consent"]) {
		$obj->consent = "N";
	}
	$idRegistration             = $obj->save();
	$_SESSION["idRegistration"] = $idRegistration;
	$registration               = Registration::getOne($idRegistration);
	if (!$idCustomer = Customer::ifCustomerExist($registration->email)) {
		$customerObj        = new Customer();
		$customerObj->email = $registration->email;
		$idCustomer         = $customerObj->save();
	}

	$fp = fopen(INCLUDE_PATH . "/tmp/reg-" . $idRegistration . ".txt", "w");
	fwrite($fp, NOW . "\n\n" . $idRegistration . "\n\n" . print_r($_POST, true) . "\n\n" . print_r($obj, true) . "\n\n" . print_r($_SESSION, true));
	fclose($fp);

	$obj                          = new Payment();
	$obj->type                    = "registration";
	$obj->idType                  = $idRegistration;
	$obj->idCustomer              = $idCustomer;
	$obj->methodPayment           = $_POST["paymentMode"];
	$obj->paymentOption           = $_POST["paymentOption"];
	$obj->nbPayment               = $_SESSION["transactionData"]["nbPayment"];
	$obj->subtotal                = cleanAmount($_POST["subTotal"]);
	$obj->amount                  = cleanAmount($_POST["total"]);
	$obj->gst                     = cleanAmount($_POST["gst"]);
	$obj->pst                     = cleanAmount($_POST["pst"]);
	$obj->description             = $_POST["stripeDescription"];
	$obj->transactionConfirmation = (($_POST["paymentMode"] == "cc") ? $_SESSION["transactionConfirmation"] : "");
	$obj->cardBrand               = (($_POST["paymentMode"] == "cc") ? $_SESSION["cardBrand"] : "");
	$obj->cardLast4               = (($_POST["paymentMode"] == "cc") ? $_SESSION["cardLast4"] : "");
	$obj->note                    = "";
	$obj->date                    = date("Y-m-d");
	if ($idPayment = $obj->save()) {
		$_SESSION["idPayment"] = $idPayment;
		if ($_POST["paymentMode"] == "cc") {
			Payment::capturePayment($idPayment);
			Payment::changePaymentDescription($idPayment, $registration->description);
			$idStripe = Payment::getStripeClient(NULL, $registration->email);
			if (!$idStripe["id"]) {
				$idStripe = Payment::saveStripeClient(NULL, $registration->id);
				Customer::updateCustomerStripeId($registration->email, $idStripe["id"]);
			}
		}
	}
	$customer = Customer::getOne($idCustomer);
	Registration::sendToCustomer($idRegistration);
	if (($registration->type == "theaterschool") && (date("Y-m-d") < "2023-08-14")) {
		Registration::sendHoliday($idRegistration);
	}
	$result  = "00";
	$message = "Merci, votre inscription est enregistrée. Vous recevrez une confirmation par courriel à l'adresse " . $_POST["email"] . ".";
}
echo json_encode(array("result" => $result, "message" => $message, "customer" => $customer));
?>