<?php

if ($_POST["result"] <> "") {
	require_once("../../include/config.php");
	$fp = fopen(INCLUDE_PATH . "/stripe.txt", ((STATUS == "dev") ? "a" : "w"));
	fwrite($fp, NOW . "\n" . print_r($_POST["result"], true));
	fclose($fp);
}
?>