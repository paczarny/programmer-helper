<?php

class Contact extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
            //załaduj widok
        /*$rows=$rows->fetch();
        $this->loadView($rows);
        $this->view->render('concretePost');*/
        
        if(!isset($_SESSION['id_post']))
            $this->redirect(); 
            
        
        //jesli zalogowany
        if($this->user->is_logged_in())
        {
            $select='id_post, email, username, name, phone, surname, country, city';
            $from='posts 
            INNER JOIN users ON 
            posts.id_user=users.id_user and id_post =:id_post
            INNER JOIN user_detail ON 
            users.id_user=user_detail.id_user_details
            INNER JOIN addresses ON 
            user_detail.id_address=addresses.id_address';
            $other=$_SESSION['id_post'];
            $stmt=$this->user->select($select, $from, $other);
            $row = $stmt->fetch();
            
            
            
            $this->loadView($row, 'ContactView');
            $this->view->render('kontakt');
            exit;
        }
        else
        {
            $_SESSION['message']='Musisz być zalogowany aby skontaktować się z wybranym użytkownikiem!';
            header('location: /programmer-helper3/public/Home/getConcretePost/'.$_SESSION["id_post"]);
            unset($_SESSION['id_post']);
            exit;	
        }
    }
    
}