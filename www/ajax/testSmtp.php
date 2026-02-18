<?php
/**
 * SMTP / email test script.
 * Sends a single test email using the app's SMTP config.
 * Only runs when STATUS is "dev" to avoid abuse in production.
 *
 * Usage (browser):
 *   /ajax/testSmtp.php
 *   /ajax/testSmtp.php?to=your@email.com
 *
 * Usage (CLI):
 *   php -r "parse_str('to=your@email.com', \$_GET); include 'www/ajax/testSmtp.php';"
 *   Or from project root: php www/ajax/testSmtp.php  (optional: pass env to set to address)
 */

require_once __DIR__ . "/../../include/config.php";

header("Content-Type: application/json; charset=UTF-8");


$to = isset($_GET["to"]) ? trim($_GET["to"]) : (isset($argv[1]) ? $argv[1] : null);
if (empty($to)) {
	$to = "jskrta@gmail.com"; // default dev recipient
}

$result = ["ok" => false, "to" => $to, "message" => ""];

if (empty(SMTPSERVER) || empty(SMTPUSER) || SMTPPORT <= 0) {
	$result["error"] = "SMTP not configured. Check .env: SMTP_SERVER, SMTP_USER, SMTP_PASSWORD, SMTP_PORT.";
	echo json_encode($result);
	exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

try {
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host       = SMTPSERVER;
	$mail->Port       = SMTPPORT;
	$mail->SMTPAuth   = true;
	$mail->Username   = SMTPUSER;
	$mail->Password   = SMTPPASSWORD;
	$mail->SMTPOptions = defined("SMTPOPTIONS") ? SMTPOPTIONS : [];
	$mail->CharSet    = "UTF-8";
	$mail->Encoding   = "base64";
	$mail->setFrom("info@letheatreroyal.com", defined("CUSTOMER_NAME") ? CUSTOMER_NAME : "Le Théâtre Royal");
	$mail->addAddress($to);
	$mail->Subject    = "Test SMTP – " . date("Y-m-d H:i:s");
	$mail->isHTML(true);
	$mail->Body       = "<p>Ceci est un courriel de test.</p><p>SMTP config: " . SMTPSERVER . ":" . SMTPPORT . "</p><p>Envoyé à " . date("Y-m-d H:i:s") . ".</p>";

	$mail->send();
	$result["ok"]     = true;
	$result["message"] = "Test email sent to " . $to . ".";
} catch (PHPMailerException $e) {
	$result["error"] = $e->getMessage();
} catch (Throwable $e) {
	$result["error"] = $e->getMessage();
}

echo json_encode($result);
