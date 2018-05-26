<?php

include('class.password.php');

class User extends Password{

    private $_db;

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
    
    //check if email already exist in database
    public function check_email($email){
    try {

			$stmt = $this->_db->prepare('SELECT email FROM users WHERE email = :e_mail');
			$stmt->execute(array('e_mail' => $email));
            $count = $stmt->rowCount();
			if($count>0)
                return false;
            else 
                return true;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
    
    }
    
    
    //check if username already exist in database
    public function check_username($username){
    try {

			$stmt = $this->_db->prepare('SELECT username FROM users WHERE username = :u_sername');
			$stmt->execute(array('u_sername' => $username));
            $count = $stmt->rowCount();
			if($count>0)
                return false;
            else 
                return true;

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
    
    }
    
    
    public function add_user($haslo, $username, $email){
                    //dodajemy uzytkownika do bazy
					$hashedpassword = password_hash($haslo, PASSWORD_BCRYPT);

                    try {

                        //insert into database
                        $stmt = $this->_db->prepare('INSERT INTO users(username,password,email) VALUES (:username, :password, :email)') ;
                        $stmt->execute(array(
                            ':username' => $username,
                            ':password' => $hashedpassword,
                            ':email' => $email
                        ));

                    } 
                    catch(PDOException $e) {
                        echo $e->getMessage();
                    }
    
    }
    //wyciągnij z bazy
    public function select($select='*', $from, $other=NULL, $order=NULL, $limit=NULL) {
        $query='SELECT '.$select.' FROM '.$from;
        if($order!=NULL)
            $query=$query.' ORDER BY '.$order;
        if($limit!=NULL)
            $query=$query.' LIMIT '.$limit;
        try {
            if($other!=NULL)
            {
            $stmt = $this->_db->prepare($query);
			$stmt->execute(array(':id_post' => $other));
            }
            else{
            $stmt = $this->_db->prepare($query);
			$stmt->execute();
            }
            
            } 
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    
        return $stmt;
    }

	public function logout(){
		session_destroy();
	}

}


?>
