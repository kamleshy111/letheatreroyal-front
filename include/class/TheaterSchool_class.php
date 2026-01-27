<?php

class TheaterSchool {
	protected static $connection;

	public $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE theaterschool SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM theaterschool ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO theaterschool (id, active, `name`, price, displayOrder)
                VALUES (:id, :active, :name, :price, :displayOrder);");
		} else {
			$statement = self::$connection->prepare("UPDATE theaterschool SET
                active = :active, `name` = :name, price = :price, displayOrder = :displayOrder
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":name", $this->name);
		$statement->bindValue(":price", $this->price);
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
		               ->prepare("SELECT ts.*
                FROM theaterschool ts
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
			$row = self::get(array("clause" => "ts.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id                = $row->id;
		$obj->active            = $row->active;
		$obj->name              = $row->name;
		$obj->price             = $row->price;
		$obj->gst               = number_format(($row->price * GSTRATE), 2, ".", "");
		$obj->pst               = number_format(($row->price * PSTRATE), 2, ".", "");
		$obj->total             = number_format(($obj->price + $obj->gst + $obj->pst), 2, ".", "");
		$obj->displayOrder      = $row->displayOrder;
		$obj->totalRegistration = Registration::getTotalRegistration("theaterschool", $row->id, NULL, NULL, NULL, NULL);

		return $obj;
	}

	public function deleteCategory() {
		$statement = self::$connection->prepare("UPDATE theaterSchoolCategory SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function saveCategory() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM theaterSchoolCategory ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO theaterSchoolCategory (id, active, `name`, displayOrder)
                VALUES (:id, :active, :name, :displayOrder);");
		} else {
			$statement = self::$connection->prepare("UPDATE theaterSchoolCategory SET
                active = :active, `name` = :name, displayOrder = :displayOrder
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":name", $this->name);
		$statement->bindValue(":displayOrder", $this->displayOrder);
		$statement->execute();

		return $this->id;
	}

	public static function getCategory($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT tsc.*
                FROM theaterSchoolCategory tsc
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
				$obj = self::getOneCategory($row);

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

	public static function getOneCategory($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::getCategory(array("clause" => "tsc.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id           = $row->id;
		$obj->active       = $row->active;
		$obj->name         = $row->name;
		$obj->displayOrder = $row->displayOrder;

		return $obj;
	}

	public function deleteSchedule() {
		$statement = self::$connection->prepare("UPDATE theaterSchoolSchedule SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function saveSchedule() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM theaterSchoolSchedule ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO theaterSchoolSchedule (id, active, complete, `name`, price, idTeacher, weekday, age, timeStart, timeEnd, yearSession, registrationLimit, displayOrder)
                VALUES (:id, :active, :complete, :name, :price, :idTeacher, :weekday, :age, :timeStart, :timeEnd, :yearSession, :registrationLimit, :displayOrder);");
		} else {
			$statement = self::$connection->prepare("UPDATE theaterSchoolSchedule SET
                active = :active, complete = :complete, `name` = :name, price = :price, idTeacher = :idTeacher, weekday = :weekday, age = :age, timeStart = :timeStart, timeEnd = :timeEnd, yearSession = :yearSession, registrationLimit = :registrationLimit, displayOrder = :displayOrder
                WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":name", $this->name);
		$statement->bindValue(":complete", (($this->complete) ? $this->complete : "N"));
		$statement->bindValue(":price", $this->price);
		$statement->bindValue(":idTeacher", json_encode($this->idTeacher));
		$statement->bindValue(":weekday", $this->weekday);
		$statement->bindValue(":age", $this->age);
		$statement->bindValue(":timeStart", $this->timeStart);
		$statement->bindValue(":timeEnd", $this->timeEnd);
		$statement->bindValue(":yearSession", $this->yearSession);
		$statement->bindValue(":registrationLimit", $this->registrationLimit);
		$statement->bindValue(":displayOrder", $this->displayOrder);
		$statement->execute();

		return $this->id;
	}

	public static function getSchedule($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT tss.*
                FROM theaterSchoolSchedule tss
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
				$obj = self::getOneSchedule($row);

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

	public static function getOneSchedule($id) {
		$obj = new self;

		if (is_numeric($id)) {
			$row = self::getSchedule(array("clause" => "tss.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id                = $row->id;
		$obj->active            = $row->active;
		$obj->complete          = $row->complete;
		$obj->name              = $row->name;
		$obj->price             = $row->price;
		$obj->idTeacher         = json_decode($row->idTeacher);
		$obj->teacher           = Teacher::getName(json_decode($row->idTeacher));
		$obj->teacherLst        = ((count($obj->teacher) > 1) ? substr_replace(implode(", ", $obj->teacher), " et", strrpos(implode(", ", $obj->teacher), ", "), 1) : $obj->teacher[0]);
		$obj->weekday           = $row->weekday;
		$obj->dayname           = strftime(strtotime("Sunday + " . $row->weekday . " Days"));
		$obj->age               = $row->age;
		$obj->timeStart         = $row->timeStart;
		$obj->timeEnd           = $row->timeEnd;
		$obj->yearSession       = $row->yearSession;
		$obj->registrationLimit = $row->registrationLimit;
		$obj->displayOrder      = $row->displayOrder;
		$obj->totalRegistration = Registration::getTotalRegistration("theaterSchoolSchedule", $row->id, NULL, NULL, NULL, NULL);

		return $obj;
	}
}

?>