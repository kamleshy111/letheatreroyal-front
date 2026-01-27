<?php

class User {
	protected static $connection;

	public $id;
	public $active;
	public $admin;
	public $firstname;
	public $lastname;
	public $email;
	public $password;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function delete() {
		$statement = self::$connection->prepare("UPDATE user SET deleted = 'Y' WHERE (id = :id) LIMIT 1;");
		$statement->bindValue(":id", $this->id);
		$statement->execute();
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM user ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO user (id, active, admin, lastname, email, firstname, access)
                VALUES (:id, :active, :admin, :lastname, :email, :firstname, :access);");
		} else {
			$statement = self::$connection->prepare("UPDATE user SET
                active = :active, admin = :admin, lastname = :lastname, email = :email, firstname = :firstname, access = :access
                WHERE (id = :id) LIMIT 1;");
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":active", $this->active);
		$statement->bindValue(":admin", $this->admin);
		$statement->bindValue(":lastname", $this->lastname);
		$statement->bindValue(":firstname", $this->firstname);
		$statement->bindValue(":email", $this->email);
		$statement->bindValue(":access", $this->access);
		$statement->execute();

		if ($this->password != "") {
			$statement = self::$connection->prepare("UPDATE user SET password = :password WHERE (id = :id) LIMIT 1;");
			$statement->bindValue(":id", $this->id);
			$statement->bindValue(":password", md5($this->password));
			$statement->execute();
		}

		return $this->id;
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "1 = 1";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT u.*
                FROM user u
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
			$row = self::get(array("clause" => "u.id = :id", "param" => array(":id" => $id)), "id", 1);
		} else {
			$row = $id;
		}

		$obj->id            = $row->id;
		$obj->active        = $row->active;
		$obj->admin         = $row->admin;
		$obj->firstname     = $row->firstname;
		$obj->lastname      = $row->lastname;
		$obj->fullname      = $row->firstname . " " . $row->lastname;
		$obj->email         = $row->email;
		$obj->password      = $row->password;
		$obj->access        = $row->access;
		$obj->lastLoginDate = $row->lastLoginDate;

		return $obj;
	}

	public static function userLogin($email, $password) {
		$statement = DB::getConnection()
		               ->prepare("SELECT id FROM `user` WHERE (email = :email) AND (password = :password)");
		$statement->bindValue(":email", $email);
		$statement->bindValue(":password", md5($password));
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return self::getOne($row->id);
		}
	}

	public static function updateSessionExpiration() {
		setcookie(session_name(), session_id(), (time() + SESSION_LENGTH), "/", "." . $_SERVER["SERVER_NAME"], ((STATUS == "prod") ? true : false), ((STATUS == "prod") ? true : false));
		$statement = DB::getConnection()
		               ->prepare("UPDATE `session` SET expirationDate = :expirationDate WHERE (sessionId = :sessionId) LIMIT 1;");
		$statement->bindValue(":expirationDate", date("Y-m-d H:i:s", time() + SESSION_LENGTH));
		$statement->bindValue(":sessionId", session_id());
		$statement->execute();
	}

	public static function saveUserLogin($idUser) {
		DB::getConnection()
		  ->exec("DELETE FROM `session` WHERE (idUser = " . $idUser . ");");
		DB::getConnection()
		  ->exec("INSERT INTO `session` (idUser, creationDate, expirationDate, sessionId) VALUES (" . $idUser . ", '" . date("Y-m-d H:i:s", time()) . "', '" . date("Y-m-d H:i:s", time() + SESSION_LENGTH) . "', '" . session_id() . "');");
		DB::getConnection()
		  ->exec("INSERT INTO logLogin (idUser, IP, date) VALUES(" . $idUser . ", '" . $_SERVER["REMOTE_ADDR"] . "', '" . date("Y-m-d H:i:s") . "');");
		DB::getConnection()
		  ->exec("UPDATE `user` SET lastLoginDate = '" . date("Y-m-d H:i:s", time()) . "' WHERE (id = " . $idUser . ");");
	}

	public static function logout($idUser) {
		DB::getConnection()
		  ->exec("DELETE FROM `session` WHERE (idUser = " . $idUser . ");");
	}
}

?>