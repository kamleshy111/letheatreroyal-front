<?php

class Geo {
	protected static $connection;

	public $id;
	public $country;
	public $province;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function getDataByZip($postalCode) {
		if ($postalCode) {
			$postalCode = strtoupper(trim(str_replace(" ", "", $postalCode)));
			$handle     = fopen(GEOCODING_PATH . "/" . $postalCode . ".txt", "r");
			$googleData = fread($handle, filesize(GEOCODING_PATH . "/" . $postalCode . ".txt"));
			fclose($handle);
			$data = json_decode($googleData);
			foreach ($data->results[0]->address_components as $key => $actData) {
				if (in_array("locality", $actData->types)) {
					$city = $actData->long_name;
				} elseif (in_array("administrative_area_level_1", $actData->types)) {
					$stateProvince     = $actData->long_name;
					$stateProvinceCode = $actData->short_name;
					$province          = $stateProvince;
				} elseif (in_array("administrative_area_level_2", $actData->types)) {
					$mrc = $actData->long_name;
				} elseif (in_array("country", $actData->types)) {
					$country = $actData->long_name;
				}
			}

			return json_encode(array("data" => $data, "city" => $city, "stateProvince" => $stateProvince, "country" => $country, "province" => $province, "mrc" => $mrc, "status" => $data->status));
		}
	}

	public static function saveZipInfo($postalCode) {
		if ($postalCode) {
			$postalCode = strtoupper(trim(str_replace(" ", "", $postalCode)));
			#self::cleanFile();
			if (!file_exists(GEOCODING_PATH . "/" . $postalCode . ".txt")) {
				$url       = "https://maps.googleapis.com/maps/api/geocode/json?language=fr-CA&address=" . $postalCode . "&key=" . GOOGLE_MAPS_SERVERSIDE_KEY;
				$resp_json = file_get_contents($url);
				$fp        = fopen(GEOCODING_PATH . "/" . $postalCode . ".txt", "w");
				fwrite($fp, $resp_json);
				fclose($fp);
			}
		}
	}

	public static function saveGeocode($address) {
		$resp_json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?language=fr-CA&address=" . urlencode($address) . "&key=" . GOOGLE_MAPS_SERVERSIDE_KEY);
		$resp      = json_decode($resp_json, true);
		if ($resp["status"] == "OK") {
			$latitude          = isset($resp["results"][0]["geometry"]["location"]["lat"]) ? $resp["results"][0]["geometry"]["location"]["lat"] : "";
			$longitude         = isset($resp["results"][0]["geometry"]["location"]["lng"]) ? $resp["results"][0]["geometry"]["location"]["lng"] : "";
			$formatted_address = isset($resp["results"][0]["formatted_address"]) ? $resp["results"][0]["formatted_address"] : "";
			if ($latitude && $longitude && $formatted_address) {
				return array($latitude, $longitude, $formatted_address);
			} else {
				return false;
			}
		}
	}

	public static function cleanFile() {
		$files = glob(GEOCODING_PATH . "/*.{txt}", GLOB_BRACE);
		foreach ($files as $file) {
			if ((filesize($file) < 800) || ((time() - filemtime($file)) > (60 * 60 * 24 * 365))) {
				unlink($file);
			}
		}
	}
}

?>