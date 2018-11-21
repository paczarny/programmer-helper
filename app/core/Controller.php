<?php 

require_once '../app/models/User.php';

class Controller{
    protected $user;
    protected $view;
    
    public function __construct()
    {
        $this->user=new User();
    }
    
    
    //przekierowanie
    public function redirect(){
        header('location: ../public');
    }
    
    //ładowanie obiektu widoku
    public function loadView($params=[], $name='HomeView', $path='../app/views/home/'){
        $path=$path.$name.'.php';   
        try{
            if(file_exists($path)){
                require_once $path;
                $this->view= new $name($params);
            } else {
                throw new Exception('Can not open view '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        }

}