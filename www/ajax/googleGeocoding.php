<?php
if ($_POST["c"] == "1") {
	require_once("../../include/config.php");
	$postalCode = strtoupper(trim(str_replace(" ", "", $_POST["postalCode"])));
	Geo::saveZipInfo($postalCode);
	echo Geo::getDataByZip($postalCode);
}
?>