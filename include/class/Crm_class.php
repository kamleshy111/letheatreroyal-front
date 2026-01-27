<?php

class Crm {
	protected static $connection;
	public           $id;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function saveChange() {
		$statement = self::$connection->prepare("INSERT INTO logChanges (type, oldData, newData, idUser, date, IP)
                VALUES (:type, :oldData, :newData, :idUser, :date, :IP);");
		$statement->bindValue(":type", $this->type);
		$statement->bindValue(":oldData", $this->oldData);
		$statement->bindValue(":newData", $this->newData);
		$statement->bindValue(":idUser", $_SESSION["idUser"]);
		$statement->bindValue(":date", date("Y-m-d H:i:s"));
		$statement->bindValue(":IP", $_SERVER["REMOTE_ADDR"]);
		$statement->execute();
	}
}

?>