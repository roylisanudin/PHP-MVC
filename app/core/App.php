<?php 

class App {
    //Membuat controller dan method default
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        
        //mengambil dan membuat controller dari url
        //controller
        if(file_exists ('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
            
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
    
        //method
        if(isset ($url[1])) {
            if (method_exists ($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //params (parameter)
        if (! empty($url)){
            $this->params = array_values($url);
        }

        //jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    
    
    }

    //parsing url
    public function parseURL() {
        if (isset($_GET['url'])) {
            //rtrim untuk menghapus tanda / di akhir url
            $url = rtrim($_GET['url'], '/');
            
            //fungsi dan parameter filter untuk membersihkan url dr tulisan aneh
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //explode = dipecah url , yg dihilangkan (delimeter) yaitu tanda /
            $url = explode('/',$url);
            return $url;
        }
    }

}

?>