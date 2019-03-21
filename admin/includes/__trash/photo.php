<?php

/**
 * Photo class etending Db_object class
 */
class Photo extends Db_object {
	
	protected static $db_table = "photos";
	protected static $db_table_fields = array('pht_title','pht_description','pht_filename','pht_type','pht_size','pht_caption','pht_alternatetext','pht_dateadded');
	protected static $pk_field = "pht_id";

	public $pht_id;
	public $pht_title;
	public $pht_caption;
	public $pht_alternatetext;
	public $pht_description;
	public $pht_filename;
	public $pht_type;
	public $pht_size;
	public $pht_dateadded;

	public $tmp_path;
	public $upload_dir = "images";

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

		} elseif ($file['error'] = 0) {

			$this->errors[] = $this->upload_const_err[$file['error']];
			return false;

		} else {

			$this->pht_filename = basename($file['name']); //passing only filename without dir or ext
			$this->tmp_path = $file['tmp_name'];
			$this->pht_type = $file['type'];
			$this->pht_size = $file['size'];
			$this->pht_dateadded = date("Y-m-d H:i:s");

		}

	}

	public function file_path() {

		return $this->upload_dir . DS . $this->pht_filename;
	}


	//saving to DB and move uploaded file to specific dir
	public function save() {

		if($this->pht_id) {

			$this->update();

		} else {

			if(!empty($this->errors)) return false;

			//check if file has been carefully uploaded
			if(empty($this->pht_filename) || empty($this->tmp_path)) {
				
				$this->errors[] = "The file was not available";
				return false;
			}

			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->pht_filename;

			//check if the file already existed
			if (file_exists($target_path)) {

				$this->errors[] = "The file {$this->pht_filename} already exists";
				return false;
			}

			//moving file from tmp_path to target_path
			if(move_uploaded_file($this->tmp_path, $target_path)) {

				if($this->create()) {

					unset($this->tmp_path);
					return true;
				}

			} else {

				$this->errors[] = "Permission could be denied";
				return false;
			}

		}
	} //End of save func

	public function delete_photo() {

		if($this->delete()) {

			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->file_path();

			return unlink($target_path) ? true : false;
		} else 
			return false;
	}
	
}


?>