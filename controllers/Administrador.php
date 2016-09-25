<?php

class Administrador extends Controller{

    function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        if(Session::exist()){
            $this->view->render($this,'principal');
        } else {
            header('location:'.URL);
        }
    }
}

 ?>