<?php

class Menu {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		try {
			$statement = self::$connection->prepare("DELETE FROM menu WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->execute();
		} catch (PDOException $e) {
			$_SESSION["error"] = "On ne peut effacer, car ce menu est utilisé";
		}
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM menu ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO menu (id, active, idText, parent, title_fr, title_en, page_url, displayOrder)
                VALUES (:id, :active, :idText, :parent, :title_fr, :title_en, :page_url, :displayOrder);");
		} else {
			$statement = self::$connection->prepare("UPDATE menu SET
                active = :active, idText = :idText, parent = :parent, title_fr = :title_fr, title_en = :title_en, page_url = :page_url, displayOrder = :displayOrder
                WHERE (id = :id) LIMIT 1;");
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":idText", $this->idText);
		$statement->bindValue(":parent", $this->parent);
		$statement->bindValue(":title_fr", $this->title_fr);
		$statement->bindValue(":title_en", $this->title_en);
		$statement->bindValue(":page_url", $this->page_url);
		$statement->bindValue(":displayOrder", $this->displayOrder);
		$statement->execute();

		return $this->id;
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT l.*, t.title_" . $_SESSION["language"] . " as textTitle, m.title_" . $_SESSION["language"] . " as parentTitle
                FROM menu l LEFT JOIN text t on t.id = l.idText LEFT JOIN menu m on m.id = l.parent
                WHERE " . $whereClauseTxt . "
                ORDER BY " . $orderBy . " LIMIT " . $limit);
		if (!empty($whereClause["clause"])) {
			if (!empty($whereClause["param"])) {
				foreach ($whereClause["param"] as $key => $value) {
					$statement->bindValue($key, $value);
				}
			}
		}
		$statement->execute();
		if ($limit > 1) {
			while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$obj = self::getOne($row);

				if ($obj != false) {
					$lst[] = $obj;
				}
			}

			return $lst;
		} else {
			$row = $statement->fetch(PDO::FETCH_OBJ);

			return $row;
		}
	}

	public static function getOne($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::get(array("clause" => "l.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else if ($id != NULL) {
			$row = $id;
		} else {
			$row = $id;

			return $obj;
			exit();
		}
		if ($row->{"url_" . $_SESSION["language"]}) {
			$url = $row->{"url_" . $_SESSION["language"]};
		} else {
			$url = urlAddress($row->{"title_" . $_SESSION["language"]});
		}

		$obj->id           = $row->id;
		$obj->active       = $row->active;
		$obj->idText       = $row->idText;
		$obj->textTitle    = $row->textTitle;
		$obj->parent       = $row->parent;
		$obj->parentTitle  = $row->parentTitle;
		$obj->title_fr     = $row->title_fr;
		$obj->title_en     = $row->title_en;
		$obj->title        = $row->{"title_" . $_SESSION["language"]};
		$obj->url          = $url;
		$obj->displayOrder = $row->displayOrder;

		return $obj;
	}

	public static function getPublicMenu($pos = "main", $language = "en") {
		$statement = DB::getConnection()
		               ->prepare("SELECT m.* FROM menu m WHERE (active = 'Y') ORDER BY parent, displayOrder, id;");
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			if ($row->parent == 0) {
				$parentMenu[$row->id]["id"]       = $row->id;
				$parentMenu[$row->id]["idText"]   = $row->idText;
				$parentMenu[$row->id]["title"]    = $row->{"title_" . $language};
				$parentMenu[$row->id]["url"]      = $row->{"url_" . $language};
				$parentMenu[$row->id]["code"]     = $row->code;
				$parentMenu[$row->id]["location"] = $row->location;
				$parentMenu[$row->id]["code"]     = (($row->code) ? $row->code : urlAddress($row->{"title_" . $language}));
				$parentMenu[$row->id]["target"]   = "_self";
			} else {
				$sub_menu[$row->parent][$row->id] = array("id" => $row->id, "idText" => $row->idText, "title" => $row->{"title_" . $language}, "url" => $row->{"url_" . $language});
				if (empty($parentMenu[$row->parent]["count"])) {
					$parentMenu[$row->parent]["count"] = 0;
				}
				$parentMenu[$row->parent]["count"]++;
			}
		}
		$menu = array();

		if ($pos == "main") {
			foreach ($parentMenu as $key => $value) {
				$subMenu = array();
				if (!empty($value["count"])) {
					foreach ($sub_menu[$key] as $subValue) {
						if ($subValue["idText"] > 0) {
							$subMenu[] = array("title" => $subValue["title"], "url" => "/" . urlAddress($subValue["title"]) . "/" . $subValue["idText"] . "/", "target" => $value["target"]);
						} elseif (http($subValue["url"])) {
							$subMenu[] = array("title" => $subValue["title"], "url" => $subValue["url"], "target" => "_blank");
						} else {
							if ($subValue["url"]) {
								$subMenu[] = array("title" => $subValue["title"], "url" => $subValue["url"], "target" => $value["target"]);
							} else {
								$subMenu[] = array("title" => $subValue["title"], "url" => "/" . urlAddress($subValue["title"]) . "/", "target" => $value["target"]);
							}
						}
					}
				}

				if ((file_exists(INCLUDE_PATH . "/menu/" . $value["code"] . ".php")) || (file_exists(INCLUDE_PATH . "/menu/" . $value["code"] . ".html"))) {
					if (file_exists(INCLUDE_PATH . "/menu/" . $value["code"] . ".php")) {
						include_once(INCLUDE_PATH . "/menu/" . $value["code"] . ".php");
					} elseif (file_exists(INCLUDE_PATH . "/menu/" . $value["code"] . ".html")) {
						include_once(INCLUDE_PATH . "/menu/" . $value["code"] . ".html");
					}
					$menu[] = array("id" => $value["id"], "title" => $value["title"], "url" => $value["url"], "code" => $value["code"], "target" => $value["target"], "subMenu" => $subMenu);
				} else if (!empty($value["count"])) {
					$menu[] = array("id" => $value["id"], "title" => $value["title"], "url" => $value["url"], "target" => $value["target"], "subMenu" => $subMenu);
				} elseif (http($value["url"])) {
					$menu[] = array("id" => $value["id"], "title" => $value["title"], "url" => $value["url"], "target" => "_blank", "subMenu" => $subMenu);
				} else {
					$menu[] = array("id" => $value["id"], "title" => $value["title"], "url" => "/" . urlAddress($value["title"]) . "/", "code" => $value["code"], "location" => $value["location"], "target" => "_self", "subMenu" => $subMenu);
				}
			}
		}

		return $menu;
	}

	public static function getLanguageTitle($language) {
		$statement = DB::getConnection()
		               ->prepare("SELECT id, code, title_" . $language . " as title FROM menu m WHERE (active = 'Y');");
		$statement->execute();

		return $statement->fetchAll();
	}

	public static function getNav($language = "fr") {
		if (userIsLogged()) {
			$menuLst = parseMenu("main", $language);
			foreach ($menuLst as $key => $menuItem) {
				if ((in_array($menuItem->pageid, json_decode($_SESSION["access"]))) || ($_SESSION["admin"] == "Y")) {
					$subMenu = "";
					$icon    = "";
					if ($menuItem->icon) {
						$icon = "<i class='" . $menuItem->icon . "'></i>";
					}
					if (substr($menuItem->{"page" . ucfirst(strtolower($language))}, 0, 4) == "http") {
						$target  = "_blank";
						$urlDest = $menuItem->{"page" . ucfirst(strtolower($language))};
					} else {
						$urlDest = "/" . $menuItem->pageid . "/" . $menuItem->{"page" . ucfirst(strtolower($language))} . "/";
					}

					if ((file_exists(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".php")) || (file_exists(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".html"))) {
						$classMenu .= " dropdown";
						$mainNav   .= '
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="' . $urlDest . '">' . $icon . $menuItem->{"pageTitle" . ucfirst(strtolower($language))} . '</a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">';
						if (file_exists(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".php")) {
							include(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".php");
						} elseif (file_exists(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".html")) {
							$mainNav .= file_get_contents(INCLUDE_PATH . "/menu/" . $menuItem->pageid . ".html");
						}
						$mainNav .= '
                        </div>
                    </li>';
					} else {
						$mainNav .= '
                    <li class="nav-item">
                        <a class="nav-link" href="' . $urlDest . '">' . $icon . $menuItem->{"pageTitle" . ucfirst(strtolower($language))} . '</a>
                    </li>';
					}
				}
			}
		}

		return $mainNav;
	}

	public static function getBreadcrumbs($currentPage = NULL, $language) {
		$breadcrumb            = array();
		$url                   = "/";
		$crumbs                = explode("/", $_SERVER["REQUEST_URI"]);
		$breadcrumb["Accueil"] = $url;
		foreach ($crumbs as $crumb) {
			$tmp = getPage($crumb, NULL, NULL, $language, false);
			if ($tmp) {
				if ($tmp["title"] == "Livre") {
					$tmp["title"] = "Catalogue";
				}
				$url                       .= urlAddress($tmp["title"]) . "/";
				$breadcrumb[$tmp["title"]] = $url;
			}
		}

		return $breadcrumb;
	}

}

?>