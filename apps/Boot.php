<?php

require "config.php";
require "Controller.php";
require "Database.php";
require "Model.php";

class Boot {
    //membuat default controller, action, dan parameter
    protected $controller = 'Index';
    protected $action = 'index';
    protected $params = [];

    public function __construct(){
        //mengembalikan string dari index.php?r=controller/action/param1/param2
        $url = $_GET['r'];

        //parsing URL
        $url = $this->parseUrl($url);

        //memilihkan controller sesuai request user
        if (file_exists('apps/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];
            //menghapus controller
            unset($url[0]);
        }
        require ('apps/controllers/' . $this->controller .'.php');
        $this->controller = new $this->controller;

        //mengecek apakah user memasukkan controller
        if (isset ($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->action=$url[1];
                unset($url[1]);
            }
        }

        //untuk memetakan parameter
        if (!empty($url)){
            $this->params = array_values($url);
        }

        //memanggil controller dan action (method dalam objek beserta parameternya)
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    //memecah url menjadi conrollers dan action dan melindungi URL dari string berbahaya
    public function parseUrl($url){
        //mengecek apakah user telah memasukkan parameter URL
        if(isset($_GET['r'])){
            //menghilangkan slash tambahan di sebelah kanan supaya parameter tidak NULL
            $url = rtrim($_GET['r'], '/');
            //melindungi URL dari string berbbahaya
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //memecah URL
            $url = explode('/', $url);
        }
        return $url;
    }
}