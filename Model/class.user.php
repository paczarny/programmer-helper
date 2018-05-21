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
        else 
        {
            return false;
        }
	}
    
    private function get_user_hash($username){

		try {

			$stmt = $this->_db->prepare('SELECT id_user, username, password FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}


	public function login($username,$password){

		$user = $this->get_user_hash($username);

		if($this->password_verify($password,$user['password']) == 1){

		    $_SESSION['logged'] = true;
		    $_SESSION['id_user'] = $user['id_user'];
		    $_SESSION['username'] = $user['username'];
		    return true;
		}
        else{
            return false;
        }
	}


	public function logout(){
		session_destroy();
	}

}


?>
