<?php

class Order extends Db_object {

	protected static $db_table = "orders";
	protected static $db_table_fields = array('invoice','users','total','created_date','updated_date','status');
	protected static $pk_field = "id";

	public $id;
	public $invoice;
	public $users;
	public $total;
	public $created_date;
	public $updated_date;
	public $status;

	//create new invoice for new order [00000001]
	public function create_invoice() {

		$last_invoice = static::find_by_query("SELECT * FROM orders ORDER BY invoice DESC LIMIT 1 OFFSET 0 ");

		if($last_invoice){

			$last_invoice[0]->invoice++;

			return sprintf('%08d', $last_invoice[0]->invoice);			

		} else 
			return sprintf('%08d', 1);
	}

	public static function find_sukses() {

		return static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE status = 1 ORDER BY id ASC");
	}

	public static function report_per_tanggal() {
		global $database;

		$sql_report  = "SELECT TO_CHAR(created_date :: DATE, 'dd-mm-yyyy') AS tanggal, "; 
		$sql_report .= "SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS sukses, ";
		$sql_report .= "SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS batal ";
		$sql_report .= "FROM orders GROUP BY TO_CHAR(created_date :: DATE, 'dd-mm-yyyy')";

		$report_by_date = $database->query_db($sql_report);

		$data_report = array();

		while($row=$report_by_date->fetch(PDO::FETCH_ASSOC)){
			$data_report[] = $row;
		}

		if($report_by_date) 
			return $data_report;
		else
			return false;
	}

	public static function report_tanggal($date) {

		return static::find_by_query("SELECT * FROM orders WHERE TO_CHAR(created_date :: DATE, 'dd-mm-yyyy') = '" . $date . "' ORDER BY invoice");
	}

} //End of User class

?>