<?php

require_once("path.php");

// Load .env variables early so they are available everywhere.
require_once(__DIR__ . "/env.php");

if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', __DIR__); // fallback if path.php doesn't define it
}

$statusPath = INCLUDE_PATH . "/status.txt";

if (is_readable($statusPath) && ($statusFile = fopen($statusPath, "r"))) {
    $status = trim(fread($statusFile, filesize($statusPath)));
    fclose($statusFile);
} else {
    $status = "dev"; // fallback default
    error_log("Failed to open or read status.txt at $statusPath");
}

define("STATUS", $status);
// Suppress deprecation warnings and notices (only modify error_reporting, keep display_errors as configured)
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE & ~E_STRICT);

// Only set secure flag if HTTPS is actually available
$secureFlag = (STATUS === "prod" && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
session_set_cookie_params(strtotime("+365 days"), "/", "." . $_SERVER["SERVER_NAME"], $secureFlag, true);
ini_set("session.cookie_httponly", 1);

if (STATUS === "prod") {
    ini_set("session.use_only_cookies", 1);
    // Only set cookie_secure if HTTPS is actually available
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set("session.cookie_secure", 1);
    }
}

ini_set("session.cookie_lifetime", "360000");
ini_set("session.gc_maxlifetime", "360000");
ini_set("register_globals", "0");
ini_set("memory_limit", "150M");
ini_set("post_max_size", "10M");
ini_set("upload_max_filesize", "10M");


session_start();
ob_start();
date_default_timezone_set("America/Montreal");
header("Content-type: text/html; charset=UTF-8");

require_once(INCLUDE_PATH . "/constant.php");
require_once(INCLUDE_PATH . "/db.php");
require_once(INCLUDE_PATH . "/function.php");

require_once(COMPOSER_PATH . "/vendor/autoload.php");

spl_autoload_register("__autoload_my");

$detect     = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? "tablet" : "phone") : "computer");

$language             = "fr";
$_SESSION["language"] = $language;
putenv("LC_ALL=" . $_SESSION["language"] . "_CA.utf8");
setlocale(LC_ALL, $_SESSION["language"] . "_CA.utf8");
bindtextdomain("default", INCLUDE_PATH . "/locale");
textdomain("default");
bindtextdomain("smarty", INCLUDE_PATH . "/locale");
textdomain("smarty");
define('LANGUAGE', $_SESSION["language"]);

$smartyObj = new Smarty();
if (STATUS == "prod") {
	$smartyObj->caching = 0;
	$smartyObj->loadFilter("output", "trimwhitespace");
}
$smartyObj->setTemplateDir(APP_ROOT_PATH . "/smarty/templates");
$smartyObj->setCompileDir(APP_ROOT_PATH . "/smarty/templates_c");
$smartyObj->setCacheDir(APP_ROOT_PATH . "/smarty/cache/" . SERIAL . "-" . $_SESSION["language"]);
$smartyObj->setConfigDir(APP_ROOT_PATH . "smarty/configs");
$smartyObj->setPluginsDir(array(SMARTY_DIR . "/plugins/", APP_ROOT_PATH . "/smarty/plugins/"));

function __autoload_my($className) {
	if (file_exists(CLASS_PATH . "/" . $className . "_class.php")) {
		require CLASS_PATH . "/" . $className . "_class.php";
	}
}

$connection = DB::getConnection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ((strpos($_SERVER["PHP_SELF"], "/ajax") === false) && (php_sapi_name() != "cli")) {
	$idPage = NULL;
	$idCat  = NULL;
	$page   = "home";
	if (isset($_GET["idPage"])) {
		$idPage = $_GET["idPage"];
		if (isset($_GET["idPage"])) {
			$idCat = $_GET["idCat"];
		}
	} else {
		if (isset($_REQUEST["page"])) {
			$page = $_REQUEST["page"];
		}
	}
	if ($currentPage = getPage($page, $idPage, $idCat, $_SESSION["language"], true)) {
		if ($currentPage["code"]) {
			$page = (string) $currentPage["code"];
		}
		if ($currentPage["pageid"]) {
			$page = (string) $currentPage["pageid"];
		}
	}
	require_once(INCLUDE_PATH . "/contentVariable.php");
}

$isGoogle = false;

if (!isset($_SESSION["expires"]) || $_SESSION["expires"] < time()) {
	unset($_SESSION["referer"]);
}
$_SESSION["expires"] = time() + 1200;

if (!isset($_SESSION["referer"])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		$_SESSION["referer"] = $_SERVER["HTTP_REFERER"];
	} else {
		$_SESSION["referer"] = "";
	}
}

if (isset($_SERVER["HTTP_FROM"])) {
	if (strpos("googlebot", $_SERVER["HTTP_FROM"]) > 0) {
		$smartyObj->assign("showSeo", "Y");
		$isGoogle = true;
	}
}

foreach ($constant = Constant::loadConstant() as $actConstant) {
	$smartyObj->assign(strtolower($actConstant->code), $actConstant->value);
}
$smartyObj->assign("constant", $constant);
$smartyObj->assign("sitename", SITENAME);
$smartyObj->assign("customername", CUSTOMER_NAME);
$smartyObj->assign("deviceType", $deviceType);
$smartyObj->assign("status", STATUS);
$smartyObj->assign("stripe_pk", STRIPE_PK);
$smartyObj->assign("page", $page);
$smartyObj->assign("google_api_key", GOOGLE_MAPS_CLIENTSIDE_KEY);
$smartyObj->assign("APP_ROOT_PATH", APP_ROOT_PATH);
$smartyObj->assign("WWW_PATH", WWW_PATH);
$smartyObj->assign("JS_PATH", JS_PATH);
$smartyObj->assign("gstRate", GSTRATE);
$smartyObj->assign("pstRate", PSTRATE);
$smartyObj->assign("currentURL", getCurrentURL());
$smartyObj->assign("mainNav", $menu = Menu::getPublicMenu("main", strtolower($language)));
$smartyObj->assign("footerNav", $menu);
$smartyObj->assign("siteType", $_SESSION["siteType"]);
$smartyObj->assign("language", $language);
$smartyObj->assign("breadcrumb", $currentPage["breadcrumb"]);
$smartyObj->assign("currentPage", $currentPage);
$smartyObj->assign("footerText", Text::getTextByCode("footer"));
$smartyObj->assign("serial", ((STATUS == "prod") ? SERIAL : time()));
$smartyObj->assign("yesNoLst", array("Y" => "Oui", "N" => "Non"));
$smartyObj->assign("hearAboutLst", array("website" => "Site Internet", "socialMedia" => "Réseaux sociaux", "reference" => "Référence", "ad" => "Publicité", "other" => "Autre"));
$smartyObj->assign("genderLst", array("F" => "Femme", "M" => "Homme"));
$smartyObj->assign("paymentModeLst", $paymentModeLst = array("cc" => "Carte de crédit"));
$smartyObj->assign("paymentTheaterModeLst", $paymentModeLst = array("specimen" => "Spécimen chèque", "bankinfo" => "Coordonnées bancaires"));
$smartyObj->assign("nextFriday", $nextFriday = date("Y-m-d", strtotime("next friday")));
$smartyObj->assign("artCampLst", $artCampLst = ArtCamp::get(array("clause" => "(a.dateStart > :now) AND (a.active = 'Y')", "param" => array(":now" => NOW)), "a.dateStart, a.dateEnd"));
$smartyObj->assign("dayCampLst", $dayCampLst = DayCamp::get(array("clause" => "(d.dateStart > :now) AND (d.active = 'Y')", "param" => array(":now" => NOW)), "d.dateStart, d.dateEnd"));
$smartyObj->assign("theaterSchoolLst", $theaterSchoolLst = TheaterSchool::get(array("clause" => "(ts.active = 'Y')"), "ts.displayOrder"));
$smartyObj->assign("totalRegistration", Registration::getTotalRegistration(NULL, NULL, $nextFriday, $artCampLst, $dayCampLst, $theaterSchoolLst));

/*
$fp = fopen(INCLUDE_PATH . "/temp.txt", "w");
fwrite($fp, NOW . "\n" . print_r($_POST, true));
fclose($fp);
*/
?>