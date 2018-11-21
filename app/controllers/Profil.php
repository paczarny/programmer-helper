<?php
class Profil extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //jesli zalogowany
        if($this->user->is_logged_in())
        {
            $id_user= $_SESSION['id_user'];
            $select='country, city, email, username, name, phone, surname, addresses.id_address';
            $from='users 
            INNER JOIN user_detail ON 
            users.id_user=user_detail.id_user_details and users.id_user ='.$id_user.' 
            INNER JOIN addresses ON
            user_detail.id_address=addresses.id_address
            ';
            $stmt=$this->user->select($select, $from);
            $row = $stmt->fetch();
      
            if($row['id_address']==null)
            {
                $row['country']='';
                $row['city']='';
            }
           
            
           
            
            $this->loadView($row, 'ProfilView');
            $this->view->render('profil');
            exit;
        }
        else
        {
            header('location: /programmer-helper3/public');
            exit;	
        }
    }
    

    
        //sprawdz wyniki
        public function validation()
        {
            if(isset($_POST['submit']))
            {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            if($this->user->login($username,$password))
            { 
			     header('location: /programmer-helper3/public'); 
			     exit;		
		    } 
            else  
            {     
                 //session_destroy();
                 $_SESSION['message'
                 ]= '<p class="error">Wrong username or password.</p';
                 header('location: /programmer-helper3/public/Login'); 
                 exit;	
		    }

	       }

        }
    
    public function logout()
    {
        $this->user->logout();
        $this->redirect(); 
        exit;
    }
}