<?php

class DB {
	private static $connection;

	public static function getConnection() {
		if (!self::$connection) {
			/*self::$connection = new PDO('mysql:host=localhost;dbname=letheatreroyal_theatreroyal', 'letheatreroyal_theatreroyal', 'Y7y_a_eMAGy_EXUgU_UqY*Y3a8a*u_aN', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8,sql_mode=''"));*/
			
			$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DBNAME;
			self::$connection = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8,sql_mode=''"));
	
		}

		return self::$connection;
	}

	public static function setCollation($collation) {
		$statement = self::getConnection()
		                 ->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE (TABLE_SCHEMA = '" . "theatreroyal" . "') AND (TABLE_COLLATION <> :collation);");
		$statement->bindValue(":collation", $collation);
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			self::getConnection()
			    ->exec("ALTER TABLE `" . $row->TABLE_NAME . "` CONVERT TO CHARACTER SET utf8 COLLATE " . $collation);
		}
	}

	public static function setEngine() {
		$statement = self::getConnection()
		                 ->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE (TABLE_SCHEMA = 'theatreroyal') AND (ENGINE = 'MyISAM');");
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			self::getConnection()
			    ->exec("ALTER TABLE `" . $row->TABLE_NAME . "` ENGINE=INNODB;");
		}
	}
}

?>