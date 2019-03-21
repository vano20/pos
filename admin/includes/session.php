<?php

class Session {

	private $signed_in = false;
	public  $user_id;
	public  $message;
	public  $count;

	function __construct() {

		//starting session on inits
		session_start();
		$this->visitor_count();
		$this->check_login();
		$this->check_message();
	}

	public function visitor_count() {

		if(isset($_SESSION['count'])) 
			return $this->count = $_SESSION['count']++;
		else
			return $_SESSION['count'] = 1;
	}

	public function message($string="") {
		
		if(!empty($string)) $_SESSION['message'] = $string;
		else return $this->message;
	}

	public function check_message() {

		if(isset($_SESSION['message'])) {
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else $this->message = "";
	}

	//get login value
	public function is_login() {
		return $this->signed_in;
	}

	//login method
	public function login($user) {

		if($user) {
			$this->user_id = $_SESSION['user_id'] = $user->usr_id;
			$this->signed_in = true;

			redirect("index.php");
		}
	}

	public function logout() {
		unset($_SESSION['user_id']);
		$this->check_login();
	}

	private function check_login() {

		//check session object
		if (isset($_SESSION['user_id'])) {

			//set prop with session obj value
			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;
		} else {
			//unset innate prop
			unset($this->user_id);
			$this->signed_in = false;
		}
	}
}

$session = new Session();

?>