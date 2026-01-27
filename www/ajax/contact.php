<?php
$result  = "";
$message = "";
if (isset($_POST["email"])) {
	if ($_POST["email"]) {
		require_once("../../include/config.php");
		$obj = new Contact();
		foreach ($_POST as $key => $value) {
			$obj->$key = $value;
		}
		$idContact = $obj->save();
		if ($_SESSION['reCAPTCHAScore'] > 0.5) {
			$obj->sendToUs($idContact);
		}
		$result  = "00";
		$message = "Merci d'avoir communiqué avec nous, nous vous contacterons sous peu.";
	}
}
echo json_encode(array("result" => $result, "message" => $message));
?>