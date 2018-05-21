<?php

include('class.password.php');

class User extends Password{

    private $db;

	function __construct($db){
		parent::__construct();

		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
			return true;
		}
	}



	public function login($username,$password){

		$user = $this->get_user_hash($username);

		if($this->password_verify($password,$user['password']) == 1){

		    $_SESSION['logged'] = true;
		    $_SESSION['memberID'] = $user['memberID'];
		    $_SESSION['username'] = $user['username'];
		    return true;
		}
	}


	public function logout(){
		session_destroy();
	}

}


?>
