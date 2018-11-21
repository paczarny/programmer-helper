<?php

include('Password.php');
class User extends Password{

    protected $_db;

	function __construct($host='localhost', $name='paidb', $user='root', $pass='')
    {
		parent::__construct();
        
        $this->_db = new PDO("mysql:host=".$host.";dbname=".$name, $user, $pass);
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
    
    public function getDB()
    {
            return $this->_db;
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
                          $this->_db->beginTransaction();
  
                        //insert into database
                        $stmt = $this->_db->prepare('INSERT INTO users(username,password,email) VALUES (:username, :password, :email)') ;
                        $stmt->execute(array(
                            ':username' => $username,
                            ':password' => $hashedpassword,
                            ':email' => $email
                        ));
                          $this->_db->commit();
                    } 
                    catch(PDOException $e) {
                        $this->_db->rollback();
                        echo $e->getMessage();
                    }
    
    }
    
    public function edit_user($name, $surname, $phone, $country, $city){
                        try {
                            
                         if((strlen($nsme)>0) || (strlen($surname)>0) || (strlen($phone)>0))
                         {
                        
                        //insert into database
                        $stmt = $this->_db->prepare('UPDATE user_detail SET name= :name, surname= :surname, phone=:phone
                        WHERE id_user_details = :id;') ;
                        $stmt->execute(array(
                            ':name' => $name,
                            ':surname' => $surname,
                            ':id' => $_SESSION['id_user'],
                            ':phone' => $phone
                        ));
                             
                         }
                            
                    
                                //sprawdz czy istnieje dany adres w bazie danych
                                $stmt = $this->_db->prepare('SELECT `GetIdAdress`(:country, :city) AS `GetIdAdress`');
                                $stmt->execute(array(
                                        ':country' => $country,
                                        ':city' => $city
                                    ));

                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if($result['GetIdAdress']!=null)
                                    {
                                        //przypisz id do user_detail
                                    $stmt = $this->_db->prepare('UPDATE user_detail SET id_address=:id
                                    WHERE id_user_details = :id_user') ;
                                    $stmt->execute(array(
                                    ':id' => $result['GetIdAdress'],
                                    ':id_user' => $_SESSION['id_user']
                                ));
                                    }
                                    else
                                    {

                                        //dodaj nowy wpis
                                        $stmt = $this->_db->prepare('INSERT INTO addresses (country, city) VALUES (:country, :city)') ;
                                        $stmt->execute(array(
                                        ':country' => $country,
                                        ':city' => $city
                                    ));
                                        
                                        
                                        $stmt = $this->_db->prepare('SELECT `GetIdAdress`(:country, :city) AS `GetIdAdress`');
                                        $stmt->execute(array(
                                        ':country' => $country,
                                        ':city' => $city
                                        ));
                                        $results = $stmt->fetch(PDO::FETCH_ASSOC);
                                        
                                        $stmt = $this->_db->prepare('UPDATE user_detail SET id_address=:id
                                        WHERE id_user_details = :id_user') ;
                                        $stmt->execute(array(
                                        ':id' => $results['GetIdAdress'],
                                        ':id_user' => $_SESSION['id_user']
                                        ));
                                    }
                        

                    } 
                    catch(PDOException $e) {
                        echo $e->getMessage();
                    }
    
    }
    
    //dodaj post 
     public function add_post($title, $desc, $cont, $iduser){
                    //dodajemy uzytkownika do bazy
					$hashedpassword = password_hash($haslo, PASSWORD_BCRYPT);
                    try {
                        
                        //insert into database
                        $stmt = $this->_db->prepare('INSERT INTO posts (id_user, postTitle,postDesc,postCont) VALUES (:id_user, :postTitle, :postDesc, :postCont)') ;
                        $stmt->execute(array(
                            ':id_user' => $iduser,
                            ':postTitle' => $title,
					       ':postDesc' => $desc,
					       ':postCont' => $cont
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
