<?php

class User extends Db_object {

	protected static $db_table = "users";
	protected static $db_table_fields = array('usr_username','usr_password','usr_firstname','usr_lastname','usr_pic');
	protected static $pk_field = "usr_id";

	public $usr_id;
	public $usr_username;
	public $usr_password;
	public $usr_firstname;
	public $usr_lastname;
	public $usr_pic;

	public $tmp_path;
	public $upload_dir = "images";

	public $image_placeholder = "http://placehold.it/400x400&text=image";

	public $errors = array();
	public $upload_const_err = array(
		UPLOAD_ERR_OK         => "There is no Error", 
		UPLOAD_ERR_INI_SIZE   => "Uploaded file exceeds upload_max_filesize of php.ini",
		UPLOAD_ERR_FORM_SIZE  => "Uploaded file exceeds more then ", //{$max_file_size}",
		UPLOAD_ERR_PARTIAL    => "Uploaded file was only partialy upload",
		UPLOAD_ERR_NO_FILE    => "No File was uploaded",
		UPLOAD_ERR_NO_TMP_DIR => "Missing Temporary folder",
		UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
		UPLOAD_ERR_EXTENSION  => "a php extension stopped the upload process"
	);


	/**
	*  Passing $_FILE['uploaded_file'] as an argument
	*  $_FILE['uploaded_file'] == $file
	**/
	public function set_file($file) {

		if(empty($file) || !$file || !is_array($file)) {

			$this->errors[] = "There is no uploaded file here";
			return false;

		} elseif ($file['error'] != 0) {

			$this->errors[] = $this->upload_const_err[$file['error']];
			return false;

		} else {

			$this->usr_pic = basename($file['name']); //passing only filename without dir or ext
			$this->tmp_path = $file['tmp_name'];

		}

	}

	public function image_path_placehold() {

		return empty($this->usr_pic) ? $this->image_placeholder : $this->upload_dir . DS . $this->usr_pic;
	}
	
	//verify login detail from table user
	public static function verify_user($username, $password) {
		global $database;

		$usr_username = $database->escape_string_query($username);
		$usr_password = $database->escape_string_query($password);

		$sql = "SELECT * FROM " . self::$db_table;
		$add_where = " WHERE usr_username = '{$usr_username}' AND usr_password = '{$usr_password}'";
		$filters = " LIMIT 1";

		$array_result = self::find_by_query($sql . $add_where . $filters);

		return !empty($array_result) ? array_shift($array_result) : false;

	}

	//saving to DB and move uploaded file to specific dir
	public function upload_photo() {

		if(!empty($this->errors)) return false;

		//check if file has been carefully uploaded
		if(empty($this->usr_pic) || empty($this->tmp_path)) {
			
			$this->errors[] = "The file was not available";
			return false;
		}

		$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->usr_pic;

		//check if the file already existed
		if (file_exists($target_path)) {

			$this->errors[] = "The file {$this->usr_pic} already exists";
			return false;
		}

		//moving file from tmp_path to target_path
		if(move_uploaded_file($this->tmp_path, $target_path)) {
			
			unset($this->tmp_path);
			return true;

		} else {

			$this->errors[] = "Permission could be denied";
			return false;
		}

	} //End of save func

	//guid (general unique identifier) generator
	private function guid($pad_left = '', $pad_right = ''){
		mt_srand((double)microtime()*10000); //rng algho
        return md5($pad_left . uniqid(mt_rand(), TRUE) . $pad_right); //md5 hasing
	}

} //End of User class

?>