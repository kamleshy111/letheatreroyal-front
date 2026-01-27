<?php
if ($_POST["result"]) {
	require_once("../../include/config.php");
	$stripe = new \Stripe\StripeClient(STRIPE_SK);
	Payment::attachStripePaymentMethod($_POST["result"]["paymentMethod"]["id"], $_POST["idStripeCustomer"], $_SESSION["transactionConfirmation"]);
}
?>