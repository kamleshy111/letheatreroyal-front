<?php
$result  = "";
$message = "";
if (isset($_POST["email"])) {
	if ($_POST["email"]) {
		require_once("../../include/config.php");
		$obj        = new Newsletter();
		$obj->email = strtolower(trim($_POST["email"]));
		$obj->saveSubscriberEmail();
		$result  = "00";
		$message = "Merci de vous être abonné à notre infolettre.<br />Votre inscription sera active après que vous ayez validé votre demande en cliquant sur le lien que vous allez recevoir par courriel.";
		if ($_POST["type"] == "c") {
			$toConfirm = true;
			if ($idSubscriber = Newsletter::getIdByEmail($_POST["email"])) {
				$subscriber = Newsletter::getOne($idSubscriber);
				if ($subscriber->confirmed == "Y") {
					$toConfirm = false;
				}
			}
			$obj        = new Newsletter();
			$obj->email = strtolower(trim($_POST["email"]));
			$obj->saveSubscriber();
			if ($toConfirm == true) {
				$message = "Merci de vous être abonné à notre infolettre.<br />Votre inscription sera active après que vous ayez validé votre demande en cliquant sur le lien que vous allez recevoir par courriel.";
			} elseif ($toConfirm == false) {
				$message = "Merci, nous avons enregistré vos préférences.";
			}
		}
	}
}
echo json_encode(array("result" => $result, "message" => $message));
?>