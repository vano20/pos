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

} //End of User class

?>