<?php

class Orderdetail extends Db_object {

	protected static $db_table = "order_detail";
	protected static $db_table_fields = array('order','product','qty','price');
	protected static $pk_field = "id";

	public $id;
	public $order;
	public $product;
	public $qty;
	public $price;

} //End of User class

?>