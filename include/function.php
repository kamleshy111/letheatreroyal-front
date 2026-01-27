<?php

function generatePassword($length, $strength) {
	$vowels     = "aeuy";
	$consonants = "bdghjmnpqrstvz";
	if ($strength & 1) {
		$consonants .= "BDGHJLMNPQRSTVWXZ";
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= "23456789";
	}
	if ($strength & 8) {
		$consonants .= "@#$%";
	}
	$password = "";
	$alt      = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt      = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt      = 1;
		}
	}

	return $password;
}

function parseMenu($position, $langue = "fr") {
	$xml  = simplexml_load_file(PAGE_XML_FILE);
	$menu = array();
	foreach ($xml as $key => $getName) {
		if ($position) {
			if ((strpos($getName->menuPosition, $position) !== false) && ($getName->pageActive == "Y")) {
				if ($getName->pageActive == "Y") {
					$menu[] = $getName;
				}
			}
		} else {
			if ($getName->pageActive == "Y") {
				$menu[] = $getName;
			}
		}
	}
	if (isset($menu)) {
		return $menu;
	}
}

function userIsLogged() {
	$connection = DB::getConnection();
	$statement  = $connection->prepare("SELECT idUser FROM session WHERE (sessionId = :sessionId) AND (expirationDate > :expirationDate) ORDER BY id DESC LIMIT 1;");
	$statement->bindValue(":sessionId", session_id());
	$statement->bindValue(":expirationDate", date("Y-m-d H:i:s", time()));
	$statement->execute();
	if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
		if ($user = User::getOne($row->idUser)) {
			$_SESSION["idUser"] = $user->id;
			$_SESSION["name"]   = $user->fullname;
			$_SESSION["admin"]  = $user->admin;
			$_SESSION["access"] = $user->access;
			if ($user->admin == "Y") {
				$_SESSION["role"] = "administrator";
			}
			User::updateSessionExpiration();

			return true;
		}
	}

	return false;
}

function hasTheRights($currentCategory) {
	if ($currentCategory) {
		if (isset($_SESSION["access"])) {
			if (in_array($currentCategory, json_decode($_SESSION["access"]))) {
				return true;
			} else {
				return false;
			}
		} else {
			if ((!$currentCategory) || ($currentCategory == "general")) {
				return true;
			}
		}
	}
}

function http($url) {
	if ($url) {
		if ((strpos($url, "http://") === false) && (strpos($url, "https://") === false)) {
			return "http://" . $url;
		} else {
			return $url;
		}
	}
}

function formatPhone($phone) {
	$phone = preg_replace("/[^0-9]/", "", $phone);
	if (strlen($phone) == 7) {
		return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	} elseif (strlen($phone) == 10) {
		return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1 $2-$3", $phone);
	} else {
		return $phone;
	}
}

function replaceAccent($string) {
	return str_replace(array("à", "á", "â", "ã", "ä", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ñ", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ý", "ÿ", "À", "Á", "Â", "Ã", "Ä", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "Ý"), array("a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "n", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "y", "A", "A", "A", "A", "A", "C", "E", "E", "E", "E", "I", "I", "I", "I", "N", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y"), $string);
}

function excerpt($content, $numberOfWords = 10) {
	$contentWords = substr_count($content, " ") + 1;
	$words        = explode(" ", $content, ($numberOfWords + 1));
	if ($contentWords > $numberOfWords) {
		$words[count($words) - 1] = "...";
	}
	$excerpt = join(" ", $words);

	return $excerpt;
}

function urlAddress($url) {
	$url = replaceAccent($url);
	$url = strip_tags($url);
	$url = preg_replace("~[^\\pL0-9_]+~u", "-", $url);
	$url = trim($url, "-");
	$url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
	$url = strtolower($url);

	return $url;
}

function getPage($pageVar, $idPage = NULL, $idCat = NULL, $language, $breadcrumb = true) {
	if ($idPage) {
		if ($idCat) {
			$pages = Menu::get(array("clause" => "(m.id = " . $idCat . ") AND (l.id = " . $idPage . ")"));
			$pages = (array) $pages[0];
		} else {
			$pages = (array) Menu::getOne($idPage);
		}
		$pages["breadcrumb"] = Menu::getBreadcrumbs($pages, $language);

		return $pages;
	} else {
		$pages = Menu::getLanguageTitle($language);
		if (!empty($pageVar)) {
			foreach ($pages as $actPage) {
				if (urlAddress($actPage["code"]) == trim($pageVar)) {
					if ($breadcrumb == true) {
						$actPage["breadcrumb"] = Menu::getBreadcrumbs($actPage, $language);
					}

					return $actPage;
				} elseif (urlAddress($actPage["title"]) == trim($pageVar)) {
					if ($breadcrumb == true) {
						$actPage["breadcrumb"] = Menu::getBreadcrumbs($actPage, $language);
					}

					return $actPage;
				}
			}
			if ($actPage = setPage($pageVar)) {
				if ($breadcrumb == true) {
					$actPage["breadcrumb"] = Menu::getBreadcrumbs($actPage, $language);
				}

				return $actPage;
			}
		}
	}
}

function setPage($pageVar) {
	if ($pageVar) {
		if (defined("PAGE_XML_FILE")) {
			$xml = simplexml_load_file(PAGE_XML_FILE);
			foreach ($xml as $actPage) {
				if (((strtolower($actPage->pageid) == $pageVar) && ($actPage->pageActive == "Y")) || ((strtolower($actPage->{"page" . ucfirst(strtolower($_SESSION["language"]))}) == $pageVar) && ($actPage->pageActive == "Y"))) {
					return array("code" => (string) $actPage->pageid, "title" => (string) $actPage->{"pageTitle" . ucfirst(strtolower($_SESSION["language"]))}, "idText" => 0);
				}
			}
		}
	}
}

function getAdminPage($pageVar) {
	$found = false;
	if (!file_exists(PAGE_XML_FILE)) {
		exit("Error, the path " . PAGE_XML_FILE . " defined in function " . __FUNCTION__ . " was not found");
	} else {
		$xmlTag = "page" . ucfirst(strtolower(LANGUAGE));
		if (!empty($pageVar)) {
			$xml = simplexml_load_file(PAGE_XML_FILE);
			foreach ($xml as $key => $page) {
				if ($page->{"page" . ucfirst(strtolower(LANGUAGE))} == $pageVar) {
					$found = true;

					return $page;
				}
			}
		}
	}
	if ($found == false) {
		return $pageVar;
	} else {
		return "";
	}
}

function getCurrentURL() {
	$currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	$currentURL .= $_SERVER["SERVER_NAME"];

	if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
		$currentURL .= ":" . $_SERVER["SERVER_PORT"];
	}

	$currentURL .= $_SERVER["REQUEST_URI"];

	return $currentURL;
}

function getAge($dob, $tdate) {
	$age = 0;
	while ($tdate > $dob = strtotime("+1 year", $dob)) {
		++$age;
	}

	return $age;
}

function cleanAmount($amount) {
	$amount = str_replace(",", ".", $amount);
	$amount = str_replace(" ", "", $amount);
	$amount = str_replace("$", "", $amount);

	return $amount;
}

function getCanonical() {
	$canonicalURL = $_SERVER["HTTP_HOST"];
	$url          = $_SERVER["REQUEST_URI"];
	$protocol     = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";

	return $protocol . $canonicalURL . $url;
}

function searchForId($id, $array) {
	foreach ($array as $key => $val) {
		if ($val->id === $id) {
			return $key;
		}
	}

	return NULL;
}

function loadMailTemplate($filename = "templateMail.html") {
	$myFile   = INCLUDE_PATH . "/mail/" . $filename;
	$fh       = fopen($myFile, "r");
	$mailBody = fread($fh, filesize($myFile));
	fclose($fh);
	if (STATUS == "prod") {
		$mailBody = str_replace("../../www/css/", "https://" . DOMAIN . "/css/", $mailBody);
	} elseif (STATUS == "dev") {
		$mailBody = str_replace("../../www/css/", "http://dev7.internal.jaguar.tech:2534/css/", $mailBody);
	}
	$mailBody = str_replace("[[customerName]]", CUSTOMER_NAME, $mailBody);
	$mailBody = str_replace("[[domain]]", DOMAIN, $mailBody);

	return $mailBody;
}

function getDatePeriod($startDate, $endDate) {
	if (strtotime($startDate) == strtotime($endDate)) {
		return "Le " . strftime("%e %B %Y", strtotime($startDate));
	} elseif (date("Y", strtotime($startDate)) != date("Y", strtotime($endDate))) {
		$from = strftime("%e %B %Y", strtotime($startDate));
		$to   = strftime("%e %B %Y", strtotime($endDate));
	} elseif (date("m", strtotime($startDate)) != date("m", strtotime($endDate))) {
		$from = strftime("%e %B", strtotime($startDate));
		$to   = strftime("%e %B %Y", strtotime($endDate));
	} else {
		$from = strftime("%e", strtotime($startDate));
		$to   = strftime("%e %B %Y", strtotime($endDate));
	}

	return "Du " . trim($from) . " au " . trim($to);
}

function getWeekDays($startDate, $endDate) {
	$totalWeekDay = 0;
	$resultDays   = array("Monday" => 0, "Tuesday" => 0, "Wednesday" => 0, "Thursday" => 0, "Friday" => 0, "Saturday" => 0, "Sunday" => 0);
	$startDate    = new DateTime($startDate);
	$endDate      = new DateTime($endDate);
	while ($startDate <= $endDate) {
		$timestamp            = strtotime($startDate->format("d-m-Y"));
		$weekDay              = date("l", $timestamp);
		$resultDays[$weekDay] = $resultDays[$weekDay] + 1;
		if (($weekDay != "Saturday") && ($weekDay != "Sunday")) {
			$totalWeekDay++;
		}
		$startDate->modify("+1 day");
	}

	return (object) array("total" => $totalWeekDay, "days" => $resultDays);
}

function getTotalMonth($startDate, $endDate) {
	if (date("d", strtotime($startDate)) > 28) {
		$date = new DateTime("now");
		$date->modify("first day of next month");
		$startDate = $date->format("Y-m-d");
	}
	$start         = new DateTime($startDate);
	$end           = new DateTime($endDate);
	$diff          = $start->diff($end);
	$yearsInMonths = ($diff->format("%r%y") * 12);
	$months        = $diff->format("%r%m");
	$totalMonths   = ($yearsInMonths + $months);
	if (($diff->m == 1) && ($diff->d > 1) && ($totalMonths == 1)) {
		$totalMonths++;
	}
	if ($totalMonths > 1) {
		$totalMonths++;
	}

	$fp = fopen(INCLUDE_PATH . "/temp-month.txt", "w");
	fwrite($fp, NOW . "\n" . $diff->m . " - " . $diff->d . "\n" . print_r($date, true) . "\n" . print_r($start, true) . "\n" . print_r($end, true) . "\n" . print_r($diff, true) . "\n" . print_r($yearsInMonths, true) . "\n" . print_r($months, true) . "\n" . print_r($totalMonths, true));
	fclose($fp);

	return $totalMonths;
}

function getWeekday() {
	$lst         = array();
	$currentDate = date("Y-m-d", strtotime("monday this week"));
	for ($i = 0; $i < 7; $i++) {
		$lst[] = date("Y-m-d", strtotime($currentDate . " + $i day"));
	}

	return $lst;
}

?>