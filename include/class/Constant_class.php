<?php

class Constant {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function save() {
		if ($this->id) {
			$statement = self::$connection->prepare("UPDATE constant SET value = :value WHERE (id = :id) LIMIT 1;");

			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":value", $this->value);
			$statement->execute();

			return $this->id;
		}
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT c.*
                FROM constant c
                WHERE " . $whereClauseTxt . "
                AND (code <> '')
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

		$obj->id    = $row->id;
		$obj->name  = $row->name;
		$obj->code  = $row->code;
		$obj->value = $row->value;

		return $obj;
	}

	public static function loadConstant() {
		foreach ($constant = self::get() as $actItem) {
			define(strtoupper($actItem->code), $actItem->value);
		}

		return $constant;
	}
}

?>