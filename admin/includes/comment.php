<?php

class Comment extends Db_object {

	protected static $db_table = "comments";
	protected static $db_table_fields = array('cmt_id','cmt_photo','cmt_user','cmt_body','cmt_dateadded');
	protected static $pk_field = "cmt_id";

	public $cmt_id;
	public $cmt_photo;
	public $cmt_user;
	public $cmt_body;
	public $cmt_dateadded;

	
	public static function create_comment($cmt_photo,$cmt_user=1,$cmt_body="") {

		if(!empty($cmt_photo) && !empty($cmt_user) && !empty($cmt_body)) {
			
			$comment = new Comment();

			$comment->cmt_photo = (int)$cmt_photo;
			$comment->cmt_user = $cmt_user;
			$comment->cmt_body = $cmt_body;
			$comment->cmt_dateadded = date("Y-m-d H:i:s");

			return $comment;
		} else 
			return false;

	}

	public static function find_comment($cmt_photo=1) {

		global $database;

		$sql  = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE cmt_photo = " . $database->escape_string_query($cmt_photo);
		$sql .= " ORDER BY cmt_photo ASC";

		if($cmt_photo != "") return self::find_by_query($sql);

	}



} //End of User class

?>