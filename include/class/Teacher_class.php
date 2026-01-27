<?php

class Teacher {
	protected static $connection;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE teacher SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM teacher ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO teacher (id, active, lastname, firstname)
                VALUES (:id, :active, :lastname, :firstname);");
		} else {
			$statement = self::$connection->prepare("UPDATE teacher SET
                lastname = :lastname, firstname = :firstname
                WHERE (id = :id) LIMIT 1;");
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":lastname", trim($this->lastname));
		$statement->bindValue(":firstname", trim($this->firstname));
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
                FROM teacher t
                WHERE " . $whereClauseTxt . "
                AND (t.deleted = 'N')
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
			$row = self::get(array("clause" => "t.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id        = $row->id;
		$obj->active    = $row->active;
		$obj->lastname  = $row->lastname;
		$obj->firstname = $row->firstname;
		$obj->name      = trim($row->firstname . " " . $row->lastname);

		return $obj;
	}

	public static function getName($id) {
		$lst = array();
		foreach ($id as $actTeacher) {
			$statement = DB::getConnection()
			               ->prepare("SELECT lastname, firstname FROM teacher WHERE (id = :id);");
			$statement->bindValue(":id", $actTeacher);
			$statement->execute();
			if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$lst[] = trim($row->firstname . " " . $row->lastname);
			}
		}

		return $lst;
	}
}

?>