<?php

/** Database object for inheritaing methods
 *  
 */
class Db_object {

	
	//query all from table users
	public static function find_all() {
		
		return static::find_by_query("SELECT * FROM " . static::$db_table);
	}

	//query user by id
	public static function find_by_id($pk_id) {

		$array_result = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE " . static::$pk_field . " = $pk_id LIMIT 1");

		return !empty($array_result) ? array_shift($array_result) : false;
	}

	//query method
	public static function find_by_query($query) {
		global $database;

		$result_query = $database->query_db($query);
		$ob_array = array();

		while($row = mysqli_fetch_array($result_query)) {

			$ob_array[] = static::instance($row);
		}

		return $ob_array;
	}

	public static function instance($data) {
		
		$all_class = get_called_class();

		$user_ob = new $all_class;

		foreach($data as $table_column_name=>$value) {
			if($user_ob->has_attribute($table_column_name)) {
				$user_ob->$table_column_name = $value;

			}
		}

        return $user_ob;

	}

	private function has_attribute($string) {
		//getting all prop from object / class
		$ob_prop = get_object_vars($this);

		//checking whether the key existed in the array/object given
		return array_key_exists($string, $ob_prop);
	}



	protected function properties() {
		$properties = array();

		foreach (static::$db_table_fields as $key => $value) {
			if (property_exists($this, $value)) {
				$properties[$value] = $this->$value;
			}
		}

		return $properties;

	}

	protected function clean_properties() {
		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			
			$clean_properties[$key] = $database->escape_string_query($value);
		}

		return $clean_properties;
	}

	public function save() {

		$pk_string = static::$pk_field;

		return isset($this->$pk_string) ? $this->update() : $this->create();
	}

	public function create() {
		global $database;
		$pk_string = static::$pk_field;

		$properties = $this->clean_properties();

		$insert_query = "INSERT INTO " . static::$db_table . " (" . implode(", ", array_keys($properties)) .")";
		$insert_query .= " VALUES ('" . implode("', '", array_values($properties)) . "')";

		if($database->query_db($insert_query)) {

			$this->$pk_string = $database->inserted_id();
			return true;

		} else {

			return false;

		}
	} //End of create method

	public function update() {
		global $database;

		$pk_string = static::$pk_field;

		$properties = $this->clean_properties();

		$pairs = array();

		foreach ($properties as $key => $value) {
			$pairs[] = "{$key} = '{$value}'";
		}

		$update_query = "UPDATE " . static::$db_table . " SET ";
		$update_query .= implode(", ", $pairs);
		$update_query .=  " WHERE ". static::$pk_field . " = " . $database->escape_string_query($this->$pk_string);

		$database->query_db($update_query);

		return $database->mysql_ob->affected_rows == 1 ? true : false;

	} // End of Update method

	public function delete() {
		global $database;

		$pk_string = static::$pk_field;

		$delete_query = "DELETE FROM " . static::$db_table . " WHERE " . static::$pk_field ." = " . $database->escape_string_query($this->$pk_string);
		$delete_query .= " LIMIT 1";

		$database->query_db($delete_query);

		return $database->mysql_ob->affected_rows == 1 ? true : false;
		
	}

	public static function count_all() {

		global $database;

		$sql        = "SELECT COUNT(*) FROM " . static::$db_table;
		$result_set = $database->query_db($sql);
		$row        = $result_set->fetch_array();

		return array_shift($row);

	}

}


?>