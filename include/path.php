<?php
define("APP_ROOT_PATH", dirname(__DIR__)); // dynamically resolves to /home/letheatreroyal/public_html
define("INCLUDE_PATH", APP_ROOT_PATH . "/include");
define("CLASS_PATH", INCLUDE_PATH . "/class");
define("WWW_PATH", APP_ROOT_PATH . "/www");
define("COMPOSER_PATH", APP_ROOT_PATH); // Composer vendor directory is in project root
/*define("ADMIN_ROOT_PATH", APP_ROOT_PATH);
define("COMPOSER_PATH", "/home/letheatreroyal/composer/"); // or set the correct composer path
*/
define("IMAGEMAGICK_PATH", "/usr/bin");
define("CSS_PATH", "/include/css");
define("JS_PATH", "/include/js");
define("GEOCODING_PATH", APP_ROOT_PATH . "/helper/geocoding"); // if it exists
define("PDFTK_PATH", "/usr/local/bin/pdftk ");
?>
