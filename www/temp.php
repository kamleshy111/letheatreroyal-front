<?php
require_once("../include/config.php");

var_dump($_SESSION);

//  6LcHSvspAAAAAJWY35Wy-5cfWGsSto5R4Sehciix
//  6LcHSvspAAAAAPIfIDjFRem3JKeRxHueJOWc7NPm


#card_1LOlchFvzc7hnuF7QAZJpLgh
/*
$stripe = new \Stripe\StripeClient(STRIPE_SK);
$result = $stripe->customers->retrieve("cus_M6zb9x5219Mhpu", []);
$card =$stripe->customers->retrieveSource(
	"cus_M6zb9x5219Mhpu",
	'card_1LOlWgFvzc7hnuF7QT701ciG',
	[]
);
*/

#Registration::sendToCustomer(116);
#echo "<hr/>";
#Registration::sendToCustomer(21);
#echo "<hr/>";
#Registration::sendToCustomer(28);

#Payment::savePaymentCustomer(955);
#Payment::saveStripeClient(NULL, 247);
#Payment::saveStripeClient(NULL, 249);
#var_dump(Payment::getStripeClient("web@knap.ca"));
?>