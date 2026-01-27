<?php
define("SESSION_LENGTH", 25200);
define("CUSTOMER_NAME", getenv('CUSTOMER_NAME') ?: "Le Théâtre Royal");
define("GOOGLE_MAPS_API_KEY", getenv('GOOGLE_MAPS_API_KEY') ?: "");
define("ADMIN_ROOT_PATH", getenv('ADMIN_ROOT_PATH') ?: "/web/theatreroyal/admin.letheatreroyal.com");
define("PAGE_XML_FILE", INCLUDE_PATH . "/pages.xml");
define("DOMAIN", getenv('APP_DOMAIN') ?: "letheatreroyal.com");
define("NOW", date("Y-m-d H:i:s"));
define("GSTRATE", 0.05);
define("PSTRATE", 0.09975);
define("USAGEFEE", 5);
define("GSTNUMBER", "");
define("PSTNUMBER", "");
define("SMTPSERVER", getenv('SMTP_SERVER') ?: "");
define("SMTPUSER", getenv('SMTP_USER') ?: "");
define("SMTPPASSWORD", getenv('SMTP_PASSWORD') ?: "");
define("SMTPPORT", getenv('SMTP_PORT') ? (int) getenv('SMTP_PORT') : 0);
define("SMTPOPTIONS", array("ssl" => array("verify_peer" => false, "verify_peer_name" => false, "allow_self_signed" => true)));
define("VERSION", "1.3");
define("EMAIL_SENDER", CUSTOMER_NAME);
if (date("n") > 6) {
	define("CURRENTSESSION", date("Y"));
} else {
	define("CURRENTSESSION", (date("Y") - 1));
}
if ((strpos($_SERVER["HTTP_HOST"], "admin.") !== false) || (strpos($_SERVER["HTTP_HOST"], "2535") == true)) {
	define("BACKEND", true);
} else {
	define("BACKEND", false);
}
if (BACKEND == true) {
	define("PROJECT_NAME", CUSTOMER_NAME . " | CMS");
	define("SITENAME", "-");
} else {
	define("PROJECT_NAME", CUSTOMER_NAME);
	define("SITENAME", CUSTOMER_NAME);
}
define("STRIPE_SK", getenv('STRIPE_SK') ?: "");
define("STRIPE_PK", getenv('STRIPE_PK') ?: "");

define("GOOGLE_MAPS_SERVERSIDE_KEY", getenv('GOOGLE_MAPS_SERVERSIDE_KEY') ?: "");
define("GOOGLE_MAPS_CLIENTSIDE_KEY", getenv('GOOGLE_MAPS_CLIENTSIDE_KEY') ?: GOOGLE_MAPS_SERVERSIDE_KEY);
define("GOOGLE_RECAPTCHA_KEY", getenv('GOOGLE_RECAPTCHA_KEY') ?: "");
define("SERIAL", "2024111601");
?>