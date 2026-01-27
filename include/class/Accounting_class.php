<?php

class Accounting {
	protected static $connection;
	public           $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function setYear($year = NULL) {
		if ($year) {
			$_SESSION["fiscalYear"] = $year;
		} else {
			$year                             = date("Y");
			$maxYear                          = date("Y");
			$_SESSION["fiscalYear"]           = $year;
			$_SESSION["fiscalYearEndMaximum"] = ($maxYear . "-12-31 23:59");
		}
		$_SESSION["fiscalYearStart"] = (($_SESSION["fiscalYear"]) . "-01-01");
		$_SESSION["fiscalYearEnd"]   = ($_SESSION["fiscalYear"] . "-12-31 23:59");
	}

	public static function getTransaction($id, $type = "registration") {
		$transaction = array();
		$statement   = DB::getConnection()
		                 ->prepare("SELECT * FROM (SELECT id, date, 'payment' as type FROM payment p WHERE (p.idRegistration = :id) AND (p.`type` = :type) UNION SELECT id, date, 'refund' as type FROM refunds r WHERE (r.idRegistration = :id) AND (r.`type` = :type)) a ORDER BY date;");
		$statement->bindValue(":id", $id);
		$statement->bindValue(":type", $type);
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			if ($row->type == "payment") {
				$row->detail = Payment::getOne($row->id);
			} elseif ($row->type == "refund") {
				$row->detail = Refund::getOne($row->id);
			}
			$transaction[] = $row;
		}

		return $transaction;
	}

	public function saveTransaction() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM membershipTransaction ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row             = $statement->fetch(PDO::FETCH_OBJ);
			$this->id        = (intval($row->id) + 1);
			$statement       = self::$connection->prepare("INSERT INTO membershipTransaction (id, idMember, type, amount, paid, note, idPayment, idUser, date, IP)
                VALUES (:id, :idMember, :type, :amount, :paid, :note, :idPayment, :idUser, :date, :IP);");
			$saveTransaction = true;
		} else {
			$statement = self::$connection->prepare("UPDATE membershipTransaction SET
                idMember = :idMember, type = :type, amount = :amount, paid = :paid, note = :note, idPayment = :idPayment, idUser = :idUser, date = :date, IP = :IP = :importantNotice
				WHERE (id = :id) LIMIT 1;");
		}
		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":idMember", $this->idMember);
		$statement->bindValue(":type", $this->type);
		$statement->bindValue(":amount", $this->amount);
		$statement->bindValue(":paid", $this->paid);
		$statement->bindValue(":note", $this->note);
		$statement->bindValue(":idPayment", $this->idPayment);
		$statement->bindValue(":idUser", $_SESSION["idUser"]);
		$statement->bindValue(":date", date("Y-m-d H:i:s"));
		$statement->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
		$statement->execute();
	}
}

?>