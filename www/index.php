<?php
require_once("../include/config.php");
echo '<!DOCTYPE html><html lang="fr-CA" class="' . (($deviceType == "computer") ? 'wide wow-animation desktop' : '') . '">';
$smartyObj->display("head.tpl", $smartyVar);
echo '<body id="page-top"><div class="text-center page">';
$smartyObj->display("preloader.tpl", $smartyVar);
$smartyObj->display("header.tpl", $smartyVar);
echo "<main>";
include(INCLUDE_PATH . "/content.php");
echo "</main>";
$smartyObj->display("footer.tpl", $smartyVar);
$smartyObj->display("js.tpl", $smartyVar);
echo '</div></body></html>';
?>