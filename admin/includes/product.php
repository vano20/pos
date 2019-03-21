<?php

class Product extends Db_object {

	protected static $db_table = "product";
	protected static $db_table_fields = array('name','description','price','stock','category','created_date','updated_date');
	protected static $pk_field = "id";

	public $id;
	public $name;
	public $description;
	public $price;
	public $stock;
	public $category;
	public $created_date;
	public $updated_date;

	public static function deduct_qty($id="", $qty=0) {

		if($qty > 0 && $id != "") {

			$product = self::find_by_id($id);
			
			$product->stock        = $product->stock - $qty;
			$product->updated_date = date("Y-m-d H:i:s");

			$product->update();

		} else
			return false;
	}

} //End of User class

?>