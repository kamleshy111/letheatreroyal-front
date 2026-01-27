<?php

class Csrf {
	public static function validToken($token, $page) {
		$sessionProvider = new EasyCSRF\NativeSessionProvider();
		$easyCSRF        = new EasyCSRF\EasyCSRF($sessionProvider);
		$result          = "";
		$csrfError       = "N";
		if ($_SESSION["idUser"]) {
			$csrfVar = "u" . $_SESSION["idUser"];
		} else {
			$csrfVar = $page;
		}
		if ($token) {
			try {
				$easyCSRF->check($csrfVar, $token, (60 * 60), true);
			} catch (Exception $e) {
				$result = $e->getMessage();
				$fp     = fopen(INCLUDE_PATH . "/csrf-error.txt", ((STATUS == "prod") ? "a" : "w"));
				fwrite($fp, "\n" . NOW . "\n" . $page . " - " . $_SERVER["REMOTE_ADDR"] . " - " . $_SERVER["HTTP_USER_AGENT"] . "\n" . $_SESSION["role"] . " - " . $_SESSION["idUser"] . " / " . $_SESSION["name"] . "\n" . $e->getMessage() . "\n\n" . ((STATUS == "dev") ? $_SERVER["PHP_SELF"] . "\n" . $token . "\n" . print_r($_SESSION, true) : print_r($_POST, true)));
				fclose($fp);
			}
			if (strpos($_SERVER["PHP_SELF"], "/ajax") === false) {
				$csrfToken = $easyCSRF->generate($csrfVar);
			} else {
				$csrfToken = $token;
			}
		} else {
			if (strpos($_SERVER["PHP_SELF"], "/ajax") === false) {
				$csrfToken = $easyCSRF->generate($csrfVar);
			}
		}

		return array("result" => $result, "token" => $csrfToken, "csrfError" => $csrfError);
	}
}

?>