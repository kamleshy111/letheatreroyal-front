<?php
if (isset($_POST["c"])) {
	if ($_POST["c"] == "1") {
		require_once("../../include/config.php");
		echo json_encode(Registration::getRegistrationTotal($_POST));
	}
}
?>