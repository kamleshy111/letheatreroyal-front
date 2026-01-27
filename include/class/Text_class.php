<?php

class Text {
	protected static $connection;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("DELETE FROM text WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM text ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO text (id, active, title, subTitle, excerpt, text, code, headerBackground, featuredImage, textImage, creationDate)
                VALUES (:id, :active, :title, :subTitle, :excerpt, :text, :code, :headerBackground, :featuredImage, :textImage, :creationDate);");
			$statement->bindValue(":creationDate", NOW);
		} else {
			$statement = self::$connection->prepare("UPDATE text SET
                active = :active, title = :title, subTitle = :subTitle, excerpt = :excerpt, text = :text, code = :code, headerBackground = :headerBackground, featuredImage = :featuredImage, textImage = :textImage
                WHERE (id = :id) LIMIT 1;");
		}
		if ($_FILES["uploadTextImage"]["name"]) {
			$ext             = substr(basename($_FILES["uploadTextImage"]["name"]), strrpos(basename($_FILES["uploadTextImage"]["name"]), ".") + 1);
			$this->textImage = urlAddress($this->title) . "-" . $this->id . "." . $ext;
			if (move_uploaded_file($_FILES["uploadTextImage"]["tmp_name"], WWW_PATH . "/media/original/" . $this->textImage)) {
				$this->textImage = self::generateImage($this->id, $this->textImage, "textImage");
			}
		}
		if ($_FILES["uploadHeaderBackground"]["name"]) {
			$ext                    = substr(basename($_FILES["uploadHeaderBackground"]["name"]), strrpos(basename($_FILES["uploadHeaderBackground"]["name"]), ".") + 1);
			$this->headerBackground = urlAddress($this->title) . "-" . $this->id . "." . $ext;
			if (move_uploaded_file($_FILES["uploadHeaderBackground"]["tmp_name"], WWW_PATH . "/media/original/" . $this->headerBackground)) {
				$this->headerBackground = self::generateImage($this->id, $this->headerBackground, "headerBackground");
			}
		}
		if ($_FILES["uploadFeaturedImage"]["name"]) {
			$ext                 = substr(basename($_FILES["uploadFeaturedImage"]["name"]), strrpos(basename($_FILES["uploadFeaturedImage"]["name"]), ".") + 1);
			$this->featuredImage = urlAddress($this->title) . "-" . $this->id . "." . $ext;
			if (move_uploaded_file($_FILES["uploadFeaturedImage"]["tmp_name"], WWW_PATH . "/media/original/" . $this->featuredImage)) {
				$this->featuredImage = self::generateImage($this->id, $this->featuredImage, "featuredImage");
			}
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":title", $this->title);
		$statement->bindValue(":subTitle", $this->subTitle);
		$statement->bindValue(":excerpt", $this->excerpt);
		$statement->bindValue(":text", $this->text);
		$statement->bindValue(":code", $this->code);
		$statement->bindValue(":headerBackground", $this->headerBackground);
		$statement->bindValue(":featuredImage", $this->featuredImage);
		$statement->bindValue(":textImage", $this->textImage);
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
		               ->prepare("SELECT t.*
                FROM text t
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

	public static function getDynamic() {
		$lst = array();
		foreach (self::get(array("clause" => "(active = 'Y')")) as $actText) {
			$lst[$actText->code] = $actText;
		}

		return $lst;
	}

	public static function getOne($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::get(array("clause" => "t.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id               = $row->id;
		$obj->active           = $row->active;
		$obj->code             = $row->code;
		$obj->title            = $row->title;
		$obj->subTitle         = $row->subTitle;
		$obj->excerpt          = $row->excerpt;
		$obj->text             = $row->text;
		$obj->headerBackground = $row->headerBackground;
		$obj->featuredImage    = $row->featuredImage;
		$obj->textImage        = $row->textImage;

		return $obj;
	}

	public static function getTextByCode($code = NULL) {
		$statement = DB::getConnection()
		               ->prepare(" SELECT t.id FROM text t WHERE (t.code = :code) LIMIT 0, 1;");
		$statement->bindParam(":code", $code);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return self::getOne($row->id);
		}
	}

	public static function generateImage($id, $filename, $type = "headerBackground") {
		if ($type == "headerBackground") {
			$ratio    = "2560:606";
			$location = "/bg";
		} elseif ($type == "featuredImage") {
			$ratio    = "16:9";
			$location = "/media";
		} else {
			$ratio    = "1:1";
			$location = "/media";
		}
		$ext = substr(basename($filename), strrpos(basename($filename), ".") + 1);
		if ($ext != "jpg") {
			exec('/usr/bin/mogrify -format jpg "' . WWW_PATH . $location . "/original/" . $filename . '"');
			$filename = str_replace("." . $ext, ".jpg", $filename);
		}
		copy(WWW_PATH . $location . "/original/" . $filename, WWW_PATH . $location . "/" . $filename);
		exec("/usr/bin/convert " . WWW_PATH . $location . "/" . $filename . " -gravity center -crop " . $ratio . " " . WWW_PATH . $location . "/" . $filename);
		copy(WWW_PATH . $location . "/" . $filename, WWW_PATH . $location . "/small/" . $filename);
		exec(IMAGEMAGICK_PATH . '/mogrify -density 72 -quality 60 "' . WWW_PATH . $location . "/" . $filename . '"');
		if ($type == "featuredImage") {
			exec(IMAGEMAGICK_PATH . '/mogrify -geometry x375\> "' . WWW_PATH . $location . "/small/" . $filename . '"');
		}

		return $filename;
	}
}

?>