<?php
if (($page != "home") && ($page != "confirmRegistration")) {
	$smartyObj->display("breadcrumbs.tpl", $smartyVar);
}
$dynamicText = Text::getTextByCode(strtolower($page));
$smartyObj->assign("pageText", $dynamicText);
if (file_exists(INCLUDE_PATH . "/" . $page . ".php")) {
	include_once(INCLUDE_PATH . "/" . $page . ".php");
} elseif (file_exists(WWW_PATH . "/" . $page . ".php")) {
	include_once(WWW_PATH . "/" . $page . ".php");
} elseif (file_exists(APP_ROOT_PATH . "/smarty/templates/" . $page . ".tpl")) {
	$smartyObj->display(APP_ROOT_PATH . "/smarty/templates/" . $page . ".tpl", $smartyVar);
} elseif (file_exists(APP_ROOT_PATH . "/smarty/templates/" . $page . "-" . $site->code . ".tpl")) {
	$smartyObj->display(APP_ROOT_PATH . "/smarty/templates/" . $page . "-" . $site->code . ".tpl", $smartyVar);
} elseif ($dynamicText->id) {
	$smartyObj->display("text.tpl", $smartyVar);
} elseif ($dynamicText = Text::getOne($currentPage["idText"])) {
	$smartyObj->assign("pageText", $dynamicText);
	$smartyObj->display("text.tpl", $smartyVar);
}
?>