<?php

class DayCamp {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE dayCamp SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM dayCamp ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO dayCamp (id, active, title, dateStart, dateEnd, price, registrationLimit)
                VALUES (:id, :active, :title, :dateStart, :dateEnd, :price, :registrationLimit);");
		} else {
			$statement = self::$connection->prepare("UPDATE dayCamp SET
                active = :active, title = :title, dateStart = :dateStart, dateEnd = :dateEnd, price = :price, registrationLimit = :registrationLimit
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":title", $this->title);
		$statement->bindValue(":dateStart", $this->dateStart);
		$statement->bindValue(":dateEnd", $this->dateEnd);
		$statement->bindValue(":price", $this->price);
		$statement->bindValue(":registrationLimit", $this->registrationLimit);
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
		               ->prepare("SELECT d.*
                FROM dayCamp d
                WHERE " . $whereClauseTxt . "
                AND (deleted = 'N')
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
			$row = self::get(array("clause" => "d.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id                = $row->id;
		$obj->active            = $row->active;
		$obj->title             = $row->title;
		$obj->dateStart         = $row->dateStart;
		$obj->dateEnd           = $row->dateEnd;
		$obj->datePeriod        = getDatePeriod($row->dateStart, $row->dateEnd);
		$obj->price             = $row->price;
		$obj->campDays          = getWeekDays($row->dateStart, $row->dateEnd);
		$obj->monthBefore       = getTotalMonth(NOW, $row->dateStart);
		$obj->registrationLimit = $row->registrationLimit;
		$obj->totalRegistration = Registration::getTotalRegistration("daycamp", $row->id, NULL, NULL, NULL, NULL);

		return $obj;
	}
}

?>