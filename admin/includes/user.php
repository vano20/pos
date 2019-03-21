<?php

class User extends Db_object {

	protected static $db_table = "\"user\"";
	protected static $db_table_fields = array('username','usergroup','password','full_name');
	protected static $pk_field = "id";

	public $id;
	public $username;
	public $usergroup;
	public $password;
	public $full_name;

	
	//verify login detail from table user
	public static function verify_user($username, $password) {
		global $database;

		$sql       = "SELECT * FROM " . self::$db_table;
		$add_where = " WHERE username = '{$username}' AND password = '{$password}'";
		$filters   = " LIMIT 1 OFFSET 0";

		$array_result = self::find_by_query($sql . $add_where . $filters);

		return !empty($array_result) ? array_shift($array_result) : false;

	}

} //End of User class

?>