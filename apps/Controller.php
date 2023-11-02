<?php
class Controller{
    //mengecek keberadaan file model
    public function loadmodel($model){
        if(file_exists('apps/models/' . $model . '.php')){
            require_once('apps/models/' . $models . '.php');
            $model = new $model;
        }
        return $model;
    }

    public function loadview($view, $data=null){
        if(file_exists('apps/views/' . $view . '.php')){
            require_once('apps/views/' . $view . '.php');
        }
    }
}