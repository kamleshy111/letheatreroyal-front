<?php
$subMenu = array();
foreach (Report::get(array("clause" => "(active = 'Y')"), "displayOrder") as $actItem) {
	$subMenu[] = array("title" => $actItem->name, "url" => "/report/" . $actItem->filename, "target" => "_blank");
}
?>