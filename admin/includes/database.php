<?php
//Includes DB config
require_once("config_db.php");

/** Database class
*** 
**/
class Database {

	public $mysql_ob;

	function __construct() {
		$this->open_db_connection();

	}

	//function untuk conenction ke DB
	public function open_db_connection() {

		//connection instance
		$this->mysql_ob = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		if($this->mysql_ob->connect_errno){
			die("Error: Database connection error " . $this->mysql_ob->connect_error);
		}

	}

	//function untuk query
	public function query_db($str_query) {

		//check query is string and not space or empty string
		if (is_string($str_query) && $str_query !== '') {
			$result_query = $this->mysql_ob->query($str_query);
		} else die("System fatal error: Please contact administrator !");
		
		$this->confirm_query($result_query);

		return $result_query;
	}

	private function confirm_query($result) {

		//check mysqli_query return value
		if(!$result) die("Query error: " . $this->mysql_ob->error);
	}

	//function untuk escaping query str
	public function escape_string_query($str_query) {

		return $this->mysql_ob->real_escape_string($str_query);
	}

	public function inserted_id() {
		return $this->mysql_ob->insert_id;
	}
} //End of Database class

$database = new Database();


?>