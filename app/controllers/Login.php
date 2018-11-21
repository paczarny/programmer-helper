<?php

class Login extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //jesli zalogowany
        if($this->user->is_logged_in())
        {
            //set message
            $this->redirect(); 
            exit;
        }
        else
        {
            $this->loadView(null, 'LoginView');
            $this->view->render('logowanie');
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