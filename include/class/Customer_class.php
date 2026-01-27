<?php

class Customer {
	protected static $connection;

	function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function save() {
		if (empty($this->id)) {
			$statement = self::$connection->prepare("SELECT id FROM customer ORDER BY id DESC LIMIT 0, 1;");
			$statement->execute();
			$row       = $statement->fetch(PDO::FETCH_OBJ);
			$this->id  = (intval($row->id) + 1);
			$statement = self::$connection->prepare("INSERT INTO customer (id, email, stripeCustomer)
                VALUES (:id, :email, :stripeCustomer);");
		} else {
			$statement = self::$connection->prepare("UPDATE customer SET
                email = :email, stripeCustomer = :stripeCustomer
                WHERE (id = :id) LIMIT 1;");
		}

		$statement->bindValue(":id", $this->id);
		$statement->bindValue(":email", trim(strtolower($this->email)));
		$statement->bindValue(":stripeCustomer", $this->stripeCustomer);
		$statement->execute();

		$customer = self::getOne($this->id);
		if (!$customer->stripeCustomer) {
			$idStripe = Payment::getStripeClient(NULL, $customer->email);
			if ($idStripe["id"]) {
				self::updateCustomerStripeId($customer->email, $idStripe["id"]);
			}
		}

		return $this->id;
	}

	public static function get($whereClause = array(), $orderBy = "id", $limit = 99999999) {
		$lst            = array();
		$whereClauseTxt = "(1 = 1)";
		if (!empty($whereClause["clause"])) {
			$whereClauseTxt = $whereClause["clause"];
		}
		$statement = DB::getConnection()
		               ->prepare("SELECT c.*
                FROM customer c
                WHERE " . $whereClauseTxt . "
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

		$obj->id             = $row->id;
		$obj->email          = $row->email;
		$obj->stripeCustomer = $row->stripeCustomer;

		return $obj;
	}

	public static function ifCustomerExist($email) {
		$statement = DB::getConnection()
		               ->prepare("SELECT id FROM customer WHERE (email = :email) LIMIT 1;");
		$statement->bindValue(":email", trim(strtolower($email)));
		$statement->execute();
		if ($row = $statement->fetch(PDO::FETCH_OBJ)) {
			return $row->id;
		}
	}

	public static function updateCustomerStripeId($email, $stripeCustomer) {
		$statement = DB::getConnection()
		               ->prepare("UPDATE customer SET stripeCustomer = :stripeCustomer WHERE (email = :email);");
		$statement->bindValue(":email", $email);
		$statement->bindValue(":stripeCustomer", $stripeCustomer);
		$statement->execute();
	}

	public static function setCustomerDefaultPayment($stripeCustomer, $source) {
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		\Stripe\Customer::update($stripeCustomer, ["source" => $source]);
	}

	public static function getClientStripeSource($stripeCustomer) {
		\Stripe\Stripe::setApiKey(STRIPE_SK);
		$card = \Stripe\Customer::allPaymentMethods($stripeCustomer);

		return $card;
	}
}

?>