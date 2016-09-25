<?php 

class Usuario extends Controller{
    function __construct() {
        parent::__construct();
    }

    public function index(){
        header('location:'.URL.Session::getValue('tipoUsuario'));
    }

    public function registroAspirante(){
        if(Session::exist()){
            header("location:".URL."Usuario/");
        }else{
           $this->view->render($this,'registro');
        }
    }

    public function iniciarSesion(){
        if(isset($_POST["username"], $_POST["password"]) ){
            echo $this->model->iniciarSesion($_POST["username"], $_POST["password"]);            
        }
    }

     public function comprobarPass(){
        if( isset($_POST["password"]) ){
            echo $this->model->comprobarPassword($_POST["password"]);
        }
    }

    public function informacionGeneral(){
        if(Session::exist()){
            $this->view->informacionGeneral = $this->model->getInformacionGeneral( Session::getValue('idUsuario') );
            $this->view->render($this,'informacionGeneral');
        } else {
            header('location:'.URL);
        }
    }

    public function cerrarSesion(){
        Session::destroy();
        header("location:".URL);
    }
}

?>