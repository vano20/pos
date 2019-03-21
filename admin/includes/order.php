<?php

class Order extends Db_object {

	protected static $db_table = "\"order\"";
	protected static $db_table_fields = array('invoice','user','total');
	protected static $pk_field = "id";

	public $id;
	public $invoice;
	public $user;
	public $total;

} //End of User class

?>