<?php

/** Database object for inheritaing methods
 *  
 */
class Db_object {

	
	//query all from table users
	public static function find_all() {
		
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ORDER BY id ASC");
	}

	//query user by id
	public static function find_by_id($pk_id) {

		$array_result = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE " . static::$pk_field . " = $pk_id LIMIT 1 OFFSET 0");

		return !empty($array_result) ? array_shift($array_result) : false;
	}

	//query method
	public static function find_by_query($query) {
		global $database;

		$result_query = $database->query_db($query);
		$ob_array = array();

		while($row = $result_query->fetch(PDO::FETCH_ASSOC)) {

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
			
			$clean_properties[$key] = $value;
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
		$insert_query .= " VALUES (:" . implode(", :", array_keys($properties)) . ")";

		$prepared_query = $database->pgsql_ob->prepare($insert_query);

		foreach($properties as $k=>$v) {

			$prepared_query->bindValue(":{$k}", $v);
		}

		if($prepared_query->execute()) {

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
			$pairs[] = "{$key} = :{$key}";
		}

		$update_query = "UPDATE " . static::$db_table . " SET ";
		$update_query .= implode(", ", $pairs);
		$update_query .=  " WHERE ". static::$pk_field . " = " . $this->$pk_string;

		$prepared_query = $database->pgsql_ob->prepare($update_query);

		foreach($properties as $k=>$v) {

			$prepared_query->bindValue(":{$k}", $v);
		}

		$prepared_query->execute();

		return $prepared_query->rowCount() == 1 ? true : false;

	} // End of Update method

	public function delete() {
		global $database;

		$pk_string = static::$pk_field;

		$delete_query  = "DELETE FROM " . static::$db_table . " WHERE {$pk_string} = :{$pk_string}";
		// $delete_query .= " LIMIT 1 OFFSET 0";

		$prepared_query = $database->pgsql_ob->prepare($delete_query);

		$prepared_query->bindValue(":{$pk_string}", $this->$pk_string);

		$prepared_query->execute();

		return $prepared_query->rowCount() == 1 ? true : false;
		
	}

	public static function count_all() {

		global $database;

		$sql            = "SELECT COUNT(*) FROM " . static::$db_table;
		$prepared_query = $database->pgsql_ob->prepare($sql);
		$result_set     = $prepared_query->execute();
		$row            = $result_query->fetch(PDO::FETCH_ASSOC);

		return array_shift($row);

	}

}


?>