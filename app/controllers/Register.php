<?php

class Register extends Controller{
    
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
            $this->loadView(null, 'RegisterView');
            $this->view->render('rejestracja');
            exit;
        }
    }
    
        //sprawdz wyniki
        public function validation()
        {
                if(isset($_POST['email']))
                {
                    //Udana walidacja? Załóżmy, że tak!
                    $wszystko_OK=true;

                    //Sprawdź poprawność nickname'a
                    $username = $_POST['username'];

                    //Sprawdzenie długości nicka
                    if ((strlen($username)<3) || (strlen($username)>20))
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
                    }

                    if (ctype_alnum($username)==false)
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
                    }

                    // Sprawdź poprawność adresu email
                    $email = $_POST['email'];
                    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

                    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
                    }

                    //Sprawdź poprawność hasła
                    $haslo1 = $_POST['haslo1'];
                    $haslo2 = $_POST['haslo2'];

                    if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
                    }

                    if ($haslo1!=$haslo2)
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
                    }	

                    //Czy zaakceptowano regulamin?
                    if (!isset($_POST['regulamin']))
                    {
                        $wszystko_OK=false;
                        $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
                    }				

                    //Zapamiętaj wprowadzone dane
                    $_SESSION['fr_nick'] = $username;
                    $_SESSION['fr_email'] = $email;
                    $_SESSION['fr_haslo1'] = $haslo1;
                    $_SESSION['fr_haslo2'] = $haslo2;
                    if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;


                            //Czy email już istnieje?
                            $rezultat = $this->user->check_email($email);


                            if(!$rezultat)
                            {
                                $wszystko_OK=false;
                                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                            }		

                            //Czy nick jest już zarezerwowany?
                            $rezultat =$this->user->check_username($username);


                            if(!$rezultat)
                            {
                                $wszystko_OK=false;
                                $_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
                            }

                            if ($wszystko_OK==true)
                            {

                                $this->user->add_user($haslo1, $username, $email);
                                session_destroy();
                                $_SESSION['message'
                                ]= '<p class="error">Teraz możesz się zalogować.</p';
                                header('location: /programmer-helper3/public/Login');
                                exit;		
                            }
                            else{
                                header('location: /programmer-helper3/public/Register'); 
                            }
                    }

        }
    
}