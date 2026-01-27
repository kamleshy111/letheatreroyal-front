<?php
define("SESSION_LENGTH", 25200);
define("CUSTOMER_NAME", "Le Théâtre Royal");
define("GOOGLE_MAPS_API_KEY", "");
define("ADMIN_ROOT_PATH", "/web/theatreroyal/admin.letheatreroyal.com");
define("PAGE_XML_FILE", INCLUDE_PATH . "/pages.xml");
define("DOMAIN", "letheatreroyal.com");
define("NOW", date("Y-m-d H:i:s"));
define("GSTRATE", 0.05);
define("PSTRATE", 0.09975);
define("USAGEFEE", 5);
define("GSTNUMBER", "");
define("PSTNUMBER", "");
define("SMTPSERVER", "mail.jaguar-net.com");
define("SMTPUSER", "external@jaguar.tech");
define("SMTPPASSWORD", "g*4_J2");
define("SMTPPORT", 2225);
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
if (STATUS == "dev") {
	define("STRIPE_SK", "sk_test_51M1An9DjRDTuC8hRvhUWdYW7FfdoF4ccW3KW308YEjIkIXIPEfL0cEXKTePiwOZsgYwZDgASNUMIkQjhPUy9uDNV00Quqsu2HM");
	define("STRIPE_PK", "pk_test_51M1An9DjRDTuC8hR3DJ7vZzZAfcUUi2NOtSnqMkUHS0mvvInaLPpMx5zzz7YTZuRLh4hKWcCv974cJgI2mB3dv2a00aYvfdT7W");
} else {
	define("STRIPE_SK", "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");
	define("STRIPE_PK", "pk_live_51M1An9DjRDTuC8hRi02xz2nRDKBKnAezTUmP7OPOtKMYQhZEqEemP1KbVm88DpAlZiB9ULGSXer2XOu8X6mKpFP6005dEl6ch5");
}
define("GOOGLE_MAPS_SERVERSIDE_KEY", "AIzaSyArzEAWfL_lXHK7HP0f_eUnd7A1HiyvZMI");
define("GOOGLE_MAPS_CLIENTSIDE_KEY", GOOGLE_MAPS_SERVERSIDE_KEY);
define("GOOGLE_RECAPTCHA_KEY", "6LcHSvspAAAAAPIfIDjFRem3JKeRxHueJOWc7NPm");
define("SERIAL", "2024111601");
?>