
<?php

class Add extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        
        //jesli zalogowany
        if($this->user->is_logged_in())
        {
            $this->loadView(null, 'AddView');
            $this->view->render('dodawanie');
            exit;

        }
        else
        {
            $this->redirect(); 
            exit;
        }
    }
    
     public function validation()
    {
	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {
                
                
                $this->user->add_post($postTitle, $postDesc, $postCont, $_SESSION['id_user']);

				//redirect to index page
				$this->redirect(); 
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}
        else
        {
            header('location: /programmer-helper3/public/Add');
        }

	}

    
     }
    
}