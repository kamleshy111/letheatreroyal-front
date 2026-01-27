<?php

$siteDescription      = "";
$mainPictureURL       = "";
$pageTitle            = "";
$breadcrumbIntro      = "";
$breadcrumbTitle      = "";
$breadcrumbBackground = "";
$siteDescription      = PROJECT_NAME;
$smartyVar            = $page . "-" . $_GET["id"];

if ($currentPage["title"]) {
	$pageTitle = $currentPage["title"];
}

$smartyObj->assign("dynamicText", Text::getDynamic());
if ($page == "home") {
	$smartyObj->assign("carousel", Carousel::get(array("clause" => "(c.active = 'Y')"), "rand()", 4));
	$smartyObj->assign("homeText", Text::getTextByCode("home"));
} elseif ($page == "artcamp") {
	$smartyObj->assign("blocLst", DayCamp::get(array("clause" => "(d.dateStart > :now) AND (d.active = 'Y')", "param" => array(":now" => NOW)), "d.dateStart, d.dateEnd"));
	$pageTitle = "Camps artistiques";
} elseif ($page == "about") {
	$smartyObj->assign("teamLst", Team::get(array("clause" => "(t.deleted = 'N') AND (t.active = 'Y') AND (t.idCategory = 2)"), "t.displayOrder, t.lastname, t.firstname"));
	$smartyObj->assign("aboutText", $text = Text::getTextByCode("about"));
	$pageTitle = "À propos";
	if ($text->headerBackground) {
		$breadcrumbBackground = $text->headerBackground;
	}
} elseif ($page == "confirmRegistration") {
	$pageTitle       = "Confirmation de votre inscription";
	$breadcrumbTitle = $pageTitle;
	if (($_GET["email"]) && ($_GET["k"])) {
		Newsletter::confirmSubscription($_GET["email"], $_GET["k"]);
	}
} elseif ($page == "theaterschool") {
	$smartyObj->assign("sectionLst", array("musictheater", "youngactors", "privatelessons", "theaterschoolschedule", "showschedule"));
	$smartyObj->assign("schedule", TheaterSchool::getSchedule(array("clause" => "(tss.active = 'Y')"), "tss.weekday, tss.timeStart"));
	$smartyObj->assign("alacarte", TheaterSchool::get(array("clause" => "(active = 'Y')"), "displayOrder"));
} elseif ($page == "registration") {
	$smartyVar .= "_" . $_GET["t"];
	if (($_GET["t"] == "daycare") || (!$_GET["t"])) {
	#	$smartyObj->assign("subTotal", DAYCAREPRICE);
	} else {
		$smartyObj->assign("subTotal", 0);
	}
} elseif ($page == "contact") {
	$pageTitle = "Nous joindre";
}
$breadcrumbTitle = $pageTitle;

if (!$mainPictureURL) {
	$mainPictureURL = "/images/shareImage.jpg";
}

$smartyObj->assign("openingHour", Text::getTextByCode("openingHour"));
$smartyObj->assign("contactInformation", Text::getTextByCode("contactInformation"));
$smartyObj->assign("siteName", PROJECT_NAME);
$smartyObj->assign("pageTitle", $pageTitle);
$smartyObj->assign("siteDescription", $siteDescription);
$smartyObj->assign("mainPictureURL", $mainPictureURL);
$smartyObj->assign("breadcrumbTitle", $breadcrumbTitle);
$smartyObj->assign("breadcrumbBackground", $breadcrumbBackground);
$smartyObj->assign("breadcrumbIntro", $breadcrumbIntro);
$smartyObj->assign("canonicalURL", getCanonical());
?>