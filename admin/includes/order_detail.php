<?php

class Order_detail extends Db_object {

	protected static $db_table = "order_detail";
	protected static $db_table_fields = array('orders','product','qty','price','created_date','updated_date','status');
	protected static $pk_field = "id";

	public $id;
	public $orders;
	public $product;
	public $qty;
	public $price;
    public $created_date;
    public $updated_date;
    public $status;



	public static function find_sukses() {

		return static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE status = 1 ORDER BY id ASC");
	}

	public static function find_by_order($order_id) {

		$array_result = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE orders = {$order_id} LIMIT 1 OFFSET 0");

		return !empty($array_result) ? array_shift($array_result) : false;
	}

} //End of User class

?>