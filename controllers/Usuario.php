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
    public function registrar(){
        $file = Session::getValue('file');
        if (isset($_POST['username'],$_POST['password'])){
            $dir = LP.'default.png';
            if(file_exists($file)){
                $dir = LP.$_POST['username'].'.jpg';
                rename($file, $dir);
            }
            $responce =  $this->model->registrar($_POST['username'],$_POST['apellidoP'],$_POST['apellidoM'],$_POST['password'],URL.$dir);
            echo $responce['consulta'].'|'.$responce['id'];
        }
    }
    public function setImg(){
        if (isset($_FILES['img'])) {
            $location = LP.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $location);
            Session::setValue('file',$location);
        }
    }
}

?>