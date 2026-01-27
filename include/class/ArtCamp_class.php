<?php

class ArtCamp {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE artCamp SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM artCamp ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO artCamp (id, active, `name`, dateStart, dateEnd, price, place, placeAddress, `time`, age, registrationLimit)
                VALUES (:id, :active, :name, :dateStart, :dateEnd, :price, :place, :placeAddress, :time, :age, :registrationLimit);");
		} else {
			$statement = self::$connection->prepare("UPDATE artCamp SET
                active = :active, `name` = :name, dateStart = :dateStart, dateEnd = :dateEnd, price = :price, place = :place, placeAddress = :placeAddress, `time` = :time, age = :age, registrationLimit = :registrationLimit
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":name", $this->name);
		$statement->bindValue(":dateStart", $this->dateStart);
		$statement->bindValue(":dateEnd", $this->dateEnd);
		$statement->bindValue(":price", $this->price);
		$statement->bindValue(":place", $this->place);
		$statement->bindValue(":placeAddress", $this->placeAddress);
		$statement->bindValue(":time", $this->time);
		$statement->bindValue(":age", $this->age);
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
		               ->prepare("SELECT a.*
                FROM artCamp a
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
			$row = self::get(array("clause" => "a.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id                = $row->id;
		$obj->active            = $row->active;
		$obj->name              = $row->name;
		$obj->dateStart         = $row->dateStart;
		$obj->dateEnd           = $row->dateEnd;
		$obj->datePeriod        = getDatePeriod($row->dateStart, $row->dateEnd);
		$obj->price             = $row->price;
		$obj->place             = $row->place;
		$obj->placeAddress      = $row->placeAddress;
		$obj->time              = $row->time;
		$obj->age               = $row->age;
		$obj->campDays          = getWeekDays($row->dateStart, $row->dateEnd);
		$obj->monthBefore       = getTotalMonth(NOW, $row->dateStart);
		$obj->registrationLimit = $row->registrationLimit;
		$obj->totalRegistration = Registration::getTotalRegistration("artcamp", $row->id, NULL, NULL, NULL, NULL);

		return $obj;
	}
}

?>