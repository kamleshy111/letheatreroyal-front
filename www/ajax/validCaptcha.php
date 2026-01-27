<?php

if (($page = preg_replace("/[^A-Za-z0-9]/", "", $_POST["page"])) && ($token = preg_replace("/[^A-Za-z0-9_-]/", "", $_POST["token"]))) {
	require_once("../../include/config.php");
	header("Content-type: application/json");
	if (($_SESSION["isValidUser"] == "Y") && ($_POST["force"] == "N")) {
		$success = true;
	} else {
		$captcha      = filter_input(INPUT_POST, $token, FILTER_SANITIZE_STRING);
		$secretKey    = GOOGLE_RECAPTCHA_KEY;
		$url          = "https://www.google.com/recaptcha/api/siteverify";
		$data         = array("secret" => $secretKey, "response" => $token);
		$options      = array("http" => array("header" => "Content-type: application/x-www-form-urlencoded\r\n", "method" => "POST", "content" => http_build_query($data)));
		$context      = stream_context_create($options);
		$response     = file_get_contents($url, false, $context);
		$responseKeys = json_decode($response, true);
		if ($responseKeys["success"]) {
			$success                 = true;
			$_SESSION["isValidUser"] = "Y";
		} else {
			$success                 = false;
			$_SESSION["isValidUser"] = "N";
		}
		$_SESSION["reCAPTCHA"]      = "Y";
		$_SESSION["reCAPTCHAScore"] = number_format(str_replace(",", ".", $responseKeys["score"]), 1);

		$fp = fopen(INCLUDE_PATH . "/captcha.txt", "a");
		fwrite($fp, "\n\n--------------------------------------------\n" . NOW . "\n" . $_SERVER["REMOTE_ADDR"] . " - " . $_SERVER["HTTP_REFERER"] . " - " . $_SERVER["HTTP_USER_AGENT"] . "\n" . print_r($responseKeys, true) . "\n***");
		fclose($fp);
	}
}
echo json_encode(array("success" => $success, "isValidUser" => $_SESSION["isValidUser"], "reCAPTCHAScore" => $_SESSION["reCAPTCHAScore"]));
?>