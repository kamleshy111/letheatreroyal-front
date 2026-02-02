<?php

require_once("../../include/config.php");

header("Content-Type: text/plain; charset=UTF-8");

try {
	if (empty($_POST["amount"]) || empty($_POST["stripeToken"])) {
		echo "Données de paiement manquantes.";
		exit;
	}
	$obj                    = new Payment();
	$obj->capture           = false;
	$obj->amount            = $_POST["amount"];
	$obj->stripeToken       = $_POST["stripeToken"];
	$obj->stripeDescription = isset($_POST["stripeDescription"]) ? $_POST["stripeDescription"] : "";
	$payment                = $obj->stripePayment();

	if (is_array($payment) && isset($payment["status"]) && $payment["status"] === "00") {
		echo "00";
	} else {
		// Error message string from stripePayment()
		echo is_string($payment) ? $payment : "Une erreur est survenue lors du paiement.";
	}
} catch (Throwable $e) {
	// Log and return a safe message so front can show it (no 500)
	error_log("stripe.php: " . $e->getMessage());
	echo "Une erreur est survenue lors du paiement. Veuillez réessayer.";
}