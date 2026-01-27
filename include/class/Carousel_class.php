<?php

class Carousel {
	protected static $connection;

	public $id;
	public $active;
	public $displayOrder;
	public $creationDate;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("SELECT filename FROM carousel WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_OBJ);
		if (file_exists(WWW_PATH . "/carousel/" . $row->filename)) {
			unlink(WWW_PATH . "/carousel/" . $row->filename);
		}

		$statement = self::$connection->prepare("DELETE FROM carousel WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM carousel ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO carousel (id, active, filename, text1_fr, text2_fr, text1_en, text2_en, url_fr, url_en, displayOrder, creationDate)
                VALUES (:id, :active, :filename, :text1_fr, :text2_fr, :text1_en, :text2_en, :url_fr, :url_en, :displayOrder, :creationDate);");
			$statement->bindValue(":creationDate", NOW);
		} else {
			$statement = self::$connection->prepare("UPDATE carousel SET
                active = :active, filename = :filename, text1_fr = :text1_fr, text2_fr = :text2_fr, text1_en = :text1_en, text2_en = :text2_en, url_fr = :url_fr, url_en = :url_en, displayOrder = :displayOrder
                WHERE (id = :id) LIMIT 1;");
		}

		if ($_FILES["upload"]["name"]) {
			$ext            = substr(basename($_FILES["upload"]["name"]), strrpos(basename($_FILES["upload"]["name"]), ".") + 1);
			$this->filename = (($this->text1_fr) ? urlAddress($this->text1_fr) : urlAddress(CUSTOMER_NAME)) . "-" . $this->id . "." . $ext;
			if (move_uploaded_file($_FILES["upload"]["tmp_name"], WWW_PATH . "/carousel/original/" . $this->filename)) {
				if ($ext != "jpg") {
					exec('/usr/bin/mogrify -format jpg "' . WWW_PATH . "/carousel/original/" . $this->filename . '"');
					$this->filename = str_replace("." . $ext, ".jpg", $this->filename);
				}

				copy(WWW_PATH . "/carousel/original/" . $this->filename, WWW_PATH . "/carousel/" . $this->filename);
				exec("/usr/bin/convert " . WWW_PATH . "/carousel/" . $this->filename . " -gravity center -crop 8:11 " . WWW_PATH . "/carousel/" . $this->filename);
				exec(IMAGEMAGICK_PATH . '/mogrify -resize 640x\> -density 72 -quality 60 "' . WWW_PATH . "/carousel/" . $this->filename . '"');
				//exec(IMAGEMAGICK_PATH . '/mogrify -density 72 -quality 60 "' . WWW_PATH . "/carousel/" . $this->filename . '"');
			}
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":filename", $this->filename);
		$statement->bindValue(":text1_fr", $this->text1_fr);
		$statement->bindValue(":text2_fr", $this->text2_fr);
		$statement->bindValue(":text1_en", $this->text1_en);
		$statement->bindValue(":text2_en", $this->text2_en);
		$statement->bindValue(":url_fr", $this->url_fr);
		$statement->bindValue(":url_en", $this->url_en);
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
		               ->prepare("SELECT c.*
                FROM carousel c
                WHERE " . $whereClauseTxt . "
                ORDER BY " . $orderBy . "
                LIMIT " . $limit);
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
			$row = self::get(array("clause" => "c.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id           = $row->id;
		$obj->active       = $row->active;
		$obj->filename     = $row->filename;
		$obj->text1_fr     = $row->text1_fr;
		$obj->text2_fr     = $row->text2_fr;
		$obj->text1_en     = $row->text1_en;
		$obj->text2_en     = $row->text2_en;
		$obj->url_fr       = $row->url_fr;
		$obj->url_en       = $row->url_en;
		$obj->text1        = $row->{"text1_" . $_SESSION["language"]};
		$obj->text2        = $row->{"text2_" . $_SESSION["language"]};
		$obj->url          = $row->{"url_" . $_SESSION["language"]};
		$obj->target       = (((strpos($obj->url, "http://") === false) && (strpos($obj->url, "https://") === false)) ? "" : "_blank");
		$obj->displayOrder = $row->displayOrder;
		$obj->creationDate = $row->creationDate;
		$obj->image        = "";
		if ($row->filename) {
			if (file_exists(WWW_PATH . "/carousel/" . $row->filename)) {
				$obj->image = $row->filename;
			}
		}

		return $obj;
	}

	public static function getFirst() {
		$statement = DB::getConnection()
		               ->prepare("SELECT c.id FROM carousel c WHERE (active = 'Y') LIMIT 1;");
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return self::getOne($row->id);
		}
	}
}

?>