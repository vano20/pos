<?php

class Category extends Db_object {

	protected static $db_table = "category";
	protected static $db_table_fields = array('name','description');
	protected static $pk_field = "id";

	public $id;
	public $name;
	public $description;

} //End of User class

?>