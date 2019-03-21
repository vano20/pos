<?php
//Includes DB config
require_once("config_db.php");

/** Database class
*** 
**/
class Database {

	public $pgsql_ob;

	function __construct() {
		$this->open_db_connection();

	}

	//function untuk connection ke DB
	public function open_db_connection() {

		//connection instance
		$this->pgsql_ob = new PDO("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";user=".DB_USER.";password=".DB_PASS);

		$this->pgsql_ob->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// return $this->pgsql_ob;

	}

	//function untuk query
	public function query_db($str_query) {

		//check query is string and not space or empty string
		if (is_string($str_query) && $str_query !== '') {
			$result_query = $this->pgsql_ob->query($str_query);
		} else die("System fatal error: Please contact administrator !");
		
		$this->confirm_query($result_query);

		return $result_query;
	}

	private function confirm_query($result) {

		//check mysqli_query return value
		if(!$result) die("Query error: ");
	}

	//function untuk escaping query str
	// public function escape_string_query($str_query) {

	// 	return $this->pgsql_ob->quote($str_query);
	// }

	public function inserted_id($seq="") {
		return $this->pgsql_ob->lastInsertId($seq);
	}

} //End of Database class

$database = new Database();


?>