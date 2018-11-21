<?php
class Edit extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
            
        if(!$this->user->is_logged_in())
        {
            //set message
            $this->redirect(); 
            exit;
        }
        else
        {
            $this->loadView(null, 'EditView');
            $this->view->render('aktualizacja');
            exit;
        }
       
    }
    

    
        //sprawdz wyniki
        public function validation()
        {
                    
                    //Udana walidacja
                    $wszystko_OK=true;
                    $name='';
                    $surname='';
                    $phone=0;
                    $country='';
                    $city='';
                    if (isset($_POST['name']) && (strlen($_POST['name'])>0))
                    {
                        //Sprawdź poprawność name'a
                        $name = $_POST['name'];

                        //Sprawdzenie długości nicka
                        if ((strlen($name)<3) || (strlen($name)>20))
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_name']="Imię musi posiadać od 3 do 20 znaków!";
                        }

                        if (ctype_alnum($name)==false)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_name']="Imię może składać się tylko z liter i cyfr (bez polskich znaków)";
                        }
                    }
            
            
            
                    if (isset($_POST['surname'])&& (strlen($_POST['surname'])>0))
                    {
                        //Sprawdź poprawność name'a
                        $surname = $_POST['surname'];

                        //Sprawdzenie długości nicka
                        if ((strlen($surname)<3) || (strlen($surname)>20))
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_surname']="Nazwisko musi posiadać od 3 do 20 znaków!";
                        }

                        if (ctype_alnum($surname)==false)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_surname']="Nazwiko może składać się tylko z liter i cyfr (bez polskich znaków)";
                        }
                    }
            
            
            
            
                    if (isset($_POST['phone'])&& (strlen($_POST['phone'])>0))
                    {
                        //Sprawdź poprawność name'a
                        $phone = $_POST['phone'];

                        //Sprawdzenie długości nicka
                        if ((strlen($phone)<9) || (strlen($phone)>18))
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_phone']="Telefon musi posiadać od 9 do 18 cyfr!";
                        }

                        if (is_numeric($phone)==false)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_phone']="Telefon może składać się tylko z cyfr";
                        }
                    }
            
                    
            
            
                    if (isset($_POST['country'])&& (strlen($_POST['country'])>0))
                    {
                        //Sprawdź poprawność name'a
                        $country = $_POST['country'];

                        //Sprawdzenie długości nicka
                        if ((strlen($country)<3) || (strlen($country)>20))
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_country']="Państwo musi posiadać od 3 do 20 znaków!";
                        }

                        if (ctype_alnum($country)==false)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_country']="Państwo może składać się tylko z liter i cyfr (bez polskich znaków)";
                        }
                    }
            
            
                    
                    if (isset($_POST['city'])&& (strlen($_POST['city'])>0))
                    {
                        //Sprawdź poprawność name'a
                        $city = $_POST['city'];
                        //Sprawdzenie długości nicka
                        if ((strlen($city)<3) || (strlen($city)>20))
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_city']="Miasto musi posiadać od 3 do 20 znaków!";
                        }

                        if (ctype_alnum($city)==false)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_city']="Miasto może składać się tylko z liter i cyfr (bez polskich znaków)";
                        }
                    }
                    
            
            
                            if ($wszystko_OK==true)
                            {
                                $this->user->edit_user($name, $surname, $phone, $country, $city);
                                header('location: /programmer-helper3/public/Profil');
                                exit;		
                            }
                            else{
                                header('location: /programmer-helper3/public/Edit'); 
                                exit;	
                            }
        }
    
}