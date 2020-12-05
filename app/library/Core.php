<?php

class Core{
    protected $currentController = 'Index';
    protected $currentMethod = 'index';
    protected $parameters = [];

    public function __construct(){

        $url = $this->getUrl();

        // Obtenemos nuestro controlador
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

        }
        // Cargar nuestro controlador
        require_once('../app/controllers/' . $this->currentController . '.php') ;
        $this->currentController = new $this->currentController;

        // Obtenemos nuestro método
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]); 
            }
        }

        // Obtenemos nuestros parámetros
        $this->parameters = ($url) ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
    }

    public function getUrl(){
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            return $url = explode('/', $url);
        }
    }
}

?>