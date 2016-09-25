<?php

class Index extends Controller{
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if(Session::exist()){
            header("location:".URL."Usuario/");
        }else{
           $this->view->render($this,'index'); 
        }
    }
}
?>