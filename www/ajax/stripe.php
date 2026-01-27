<?php

require_once("../../include/config.php");
$obj                    = new Payment();
$obj->capture           = false;
$obj->amount            = $_POST["amount"];
$obj->stripeToken       = $_POST["stripeToken"];
$obj->stripeDescription = $_POST["stripeDescription"];
$payment                = $obj->stripePayment();
echo $payment["status"];
?>