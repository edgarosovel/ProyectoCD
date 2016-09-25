<?php

class Controller {

    protected $view;
    protected $model;
    protected $idTipoUsuario;

    function __construct() {
        Session::init();
        $this->loadModel();
        $this->view = new View();
        $this->view->menu = (Session::existVar('menu') ) ? Session::getValue('menu') : null ;
    }

    function loadModel() {
        $model = get_class($this) . '_model';
        $path = 'models/' . $model . '.php';

        if (file_exists($path)) {
            require_once($path);
            $this->model = new $model();
        }
    }

    function loadOtherModel($model) {
        $nameModel = $model;
        $model = $model. '_model';
        $path = 'models/' . $model . '.php';

        if (file_exists($path)) {
            require_once($path);
            $this->$nameModel = new $model;
        }
    }

    protected function setTipoUsuario($tipoUsuario){
        $this->idTipoUsuario = $tipoUsuario;
    }

    protected function tipoUsuario($tipoUsuario){
        return ($this->idTipoUsuario == $tipoUsuario) ? true : false;
    }

    protected function pageNotFound(){
        $this->view->render('Default', 'pageNotFound', true); 
    }

    protected function crearPaginacion( $pagActiva = 1 , $totalRegistros = ''){

        $primerRegMostrada = ($totalRegistros != 'NA ') ? ( $pagActiva * 15 - 14 ) : $totalRegistros;
        $ultimoRegMostrado = ( ($pagActiva * 15) <= $totalRegistros ) ? $pagActiva * 15 : $totalRegistros ;
        $paginacion = '<p class="div3" >Resultado: '.$primerRegMostrada.' - '.$ultimoRegMostrado.' de '.$totalRegistros.' Registros</p>';

        if($totalRegistros > 15){

            //------------Obtiene el número de paginas que se podrán utilizar.
            $totalPaginas = floor($totalRegistros / 15);
            $registrosSobrantes = $totalRegistros - ($totalPaginas * 15); 
            if($registrosSobrantes != 0) $totalPaginas++;

            $pagInicial = ($pagActiva <= 10) ? 1 : (floor( ($pagActiva-1) / 10) * 10)+1;

            $paginacion .='<div class="numeros div7">';

            //------------Agrega el botón para ver las siguientes páginas.
            if( ($pagInicial+9) < $totalPaginas) { 
                $paginacion.= '<button class="div1 btn-opciones" onclick="setPage('.$totalPaginas.')">>|</button>
                <button class="div1 btn-opciones" onclick="setPage('.($pagActiva+1).')">></button>';
            }
            
            //------------Agrega las páginas que se mostrarán.
            $paginaFinal = (($totalPaginas-$pagInicial) >= 10) ? $pagInicial+9 : $totalPaginas ;
            for ( $pagina = $paginaFinal ; $pagina >= $pagInicial ; $pagina-- ) {
                $pagActiva == $pagina ? 
                $paginacion.='<button class="div1 btn-numero-activo" onclick="setPage('.$pagina.')">'.$pagina.'</button>' :
                $paginacion.='<button class="div1 btn-numero" onclick="setPage('.$pagina.')">'.$pagina.'</button>' ;
            }

            //------------Agrega el botón para ver las páginas anteriores.
            if( $pagInicial != 1) { 
                $paginacion.= '<button class="div1 btn-opciones" onclick="setPage('.($pagActiva-1).')"><</button>
                <button class="div1 btn-opciones" onclick="setPage(1)">|<</button>';
            }
        }
        $paginacion .= '</div>';
        return $paginacion;
    }
}

?>