<?php 

class App{
    
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    
    public function __construct()
    {
        //zmienna przechowująca adres url
        $url=$this->parseUrl();
        function refresh($time = 5, $url = ''){
            header('refresh: ' . $time . ($url == '' ? '' : '; url=' . $url));
        }
        
       
        //sprawdz czy istnieje kontroler
        if(file_exists('../app/controllers/' . $url[0] . '.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            }
        
        
        //stwórz obiekt kontrolera    
        require_once '../app/controllers/'.$this->controller.'.php';    
        $this->controller=new $this->controller;
        
        
        //jeśli istnieje metoda
        if(isset($url[1]))
            {
                if(method_exists($this->controller, $url[1]))
                {
                    $this->method=$url[1];
                    unset($url[1]);
                }
            }
        //przekonwertuj parametry na tablice
        $this->params = $url ? array_values($url) : [];
        
        
        //wywołaj meode z parametrami
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    
    
    public function parseUrl()
        {
            if(isset($_GET['url']))
            {
                return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
        
        }
}