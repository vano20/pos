<?php

class Product extends Db_object {

	protected static $db_table = "product";
	protected static $db_table_fields = array('name','description','price','stock','category');
	protected static $pk_field = "id";

	public $id;
	public $name;
	public $description;
	public $price;
	public $stock;
	public $category;

} //End of User class

?>