<?php

class IPAPI {
	static $fields     = 65535;     // refer to http://ip-api.com/docs/api:returned_values#field_generator
	static $use_xcache = false;  // set this to false unless you have XCache installed (http://xcache.lighttpd.net/)
	static $api        = "http://ip-api.com/php/";

	public $status, $country, $countryCode, $region, $regionName, $city, $zip, $lat, $lon, $timezone, $isp, $org, $as, $reverse, $query, $message;
	private static                                                                                                                       $connection;

	function __construct() {
		self::$connection = self::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	private static function getConnection() {
		if (!self::$connection) {
			self::$connection = new PDO("mysql:host=localhost;dbname=helper", "helper", "6Yt_f*aw", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}

		return self::$connection;
	}

	public static function query($q) {
		if ($q) {
			$result   = new static;
			$lastSave = self::lastSave($q);
			if (($lastSave === "") || ($lastSave > 24)) {
				$data = self::communicate($q);
				if ($data) {
					foreach ($data as $key => $val) {
						$result->$key = $val;
					}
					self::saveData($result);

					return $result;
				}
			}
		}
	}

	private static function communicate($q) {
		$q_hash = md5("ipapi" . $q);
		if (self::$use_xcache && xcache_isset($q_hash)) {
			return xcache_get($q_hash);
		}
		if (is_callable("curl_init")) {
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, self::$api . $q . "?fields=" . self::$fields);
			curl_setopt($c, CURLOPT_HEADER, false);
			curl_setopt($c, CURLOPT_TIMEOUT, 30);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$result_array = unserialize(curl_exec($c));
			curl_close($c);
		} else {
			$result_array = unserialize(file_get_contents(self::$api . $q . "?fields=" . self::$fields));
		}
		if (self::$use_xcache) {
			xcache_set($q_hash, $result_array, 86400);
		}

		return $result_array;
	}

	private static function saveData($data) {
		if ($data->query) {
			$statement = self::getConnection()
			                 ->prepare("SELECT dateUpdated FROM geoIP WHERE (IP = :IP);");
			$statement->bindValue(":IP", $data->query);
			$statement->execute();
			if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$statementSave = self::getConnection()
				                     ->prepare("UPDATE geoIP SET city = :city, country = :country, countryCode = :countryCode, region = :region, regionName = :regionName, zip = :zip, latitude = :latitude, longitude = :longitude, timezone = :timezone, isp = :isp, reverse = :reverse, dateUpdated = :dateUpdated WHERE (IP = :IP);");
			} else {
				$statementSave = self::getConnection()
				                     ->prepare("INSERT INTO geoIP (IP, city, country, countryCode, region, regionName, zip, latitude, longitude, timezone, isp, reverse, dateUpdated) VALUES (:IP, :city, :country, :countryCode, :region, :regionName, :zip, :latitude, :longitude, :timezone, :isp, :reverse, :dateUpdated);");
			}
			$statementSave->bindValue(":IP", $data->query);
			$statementSave->bindValue(":city", $data->city);
			$statementSave->bindValue(":country", $data->country);
			$statementSave->bindValue(":countryCode", $data->countryCode);
			$statementSave->bindValue(":region", $data->region);
			$statementSave->bindValue(":regionName", $data->regionName);
			$statementSave->bindValue(":zip", $data->zip);
			$statementSave->bindValue(":latitude", $data->lat);
			$statementSave->bindValue(":longitude", $data->lon);
			$statementSave->bindValue(":timezone", $data->timezone);
			$statementSave->bindValue(":isp", $data->isp);
			$statementSave->bindValue(":reverse", $data->reverse);
			$statementSave->bindValue(":dateUpdated", date("Y-m-d H:i:s"));
			$statementSave->execute();
		}
	}

	private static function lastSave($IP) {
		$lastSave  = "";
		$statement = self::getConnection()
		                 ->prepare("SELECT dateUpdated FROM geoIP WHERE (IP = :IP);");
		$statement->bindValue(":IP", $IP);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			$lastSave = round((strtotime(date("Y-m-d H:i:s")) - strtotime($row->dateUpdated)) / 3600, 1);
		}

		return $lastSave;
	}

	public static function get($IP) {
		$statement = self::getConnection()
		                 ->prepare("SELECT * FROM geoIP WHERE (IP = :IP) limit 1;");
		$statement->bindValue(":IP", $IP);
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return $row;
		}
	}
}

?>