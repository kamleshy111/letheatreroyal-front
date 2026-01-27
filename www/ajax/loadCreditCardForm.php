<?php
if (isset($_POST["c"])) {
	if ($_POST["c"] == "1") {
		require_once("../../include/config.php");
		$smartyObj->assign("loadStripe", "Y");
		$smartyObj->display("form/creditPayment.tpl", $smartyVar);
	}
}
?>