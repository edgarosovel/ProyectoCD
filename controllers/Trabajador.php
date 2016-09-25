<?php

class Trabajador extends Controller{

    function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        if(Session::exist()){
            $this->view->render($this,'registroTrabajador');
        } else {
            header('location:'.URL);
        }
    }

    //Copiar lo mismo de arriba ------------------------!!!!!
    public function registro(){
        if(Session::exist()){
            $this->loadOtherModel('Nacionalidad');
            $this->loadOtherModel('Mexico');
            $this->loadOtherModel('UAQ');

            $this->view->facultades = $this->UAQ->getFacultadesActivas();
            $this->view->nacionalidades = $this->Nacionalidad->getNacionalidades();
            $this->view->estados = $this->Mexico->getEstados();
            $this->view->render($this,'registroTrabajador');
            unset($this); //-------------------------------------- Verificar como se trabajará el cierre de hilos.
        } else {
            header('location:'.URL);
        }
    }

    //Copiar lo mismo de arriba ------------------------!!!!!
    public function detalle( $folio ){
        if(Session::exist()){

            $this->loadOtherModel('Persona');

            $this->view->trabajador = $folio;
            $this->view->render($this,'detalleExpedienteTrabajador');
            unset($this); //-------------------------------------- Verificar como se trabajará el cierre de hilos.
        } else {
            header('location:'.URL);
        }
    }

    public function registrarTrabajador(){
        
        if( isset($_POST['curp'], $_POST['primerApellido'], $_POST['segundoApellido'], $_POST['nombre'], 
            $_POST['fecNac'], $_POST['edoNac'], $_POST['sexo'], $_POST['nacOrigen'], $_POST['folio'], 
                $_POST['edo'], $_POST['mun'], $_POST['loc'], $_POST['correo'], $_POST['telefono'], 
                    $_POST['adscripcion']) ){

            $this->loadOtherModel('Persona');
            echo $this->Persona->registrarPersona($_POST['curp'], $_POST['primerApellido'], $_POST['segundoApellido'], 
                $_POST['nombre'], $_POST['fecNac'], $_POST['edoNac'], $_POST['sexo'], $_POST['nacOrigen'], 
                    $_POST['folio'], $_POST['edo'], $_POST['mun'], $_POST['loc'], $_POST['correo'], 
                        $_POST['telefono'], $_POST['adscripcion']);
            unset($this->Persona);
        }
    }

    public function actualizarConfigInicial(){

        if(isset($_FILES['imagenPerfil'])){
            echo $nombreImagen = $_FILES['imagenPerfil']['name'];
        }

        /*if( isset($_POST['correo'], $_POST['telefono'], $_POST['telefonoEmergencia'], $_POST['idPregSeguridad'], 
            $_POST['respSeguridad'], $_POST['pass']) ){

            $this->loadOtherModel('Persona');
            echo $this->Persona->actualizarConfigInicial( Session::getValue('idUsuario'), $_POST['correo'], 
                $_POST['telefono'], $_POST['telefonoEmergencia'], $_POST['idPregSeguridad'], $_POST['respSeguridad'], $_POST['pass']);
            unset($this->Persona);
        }*/
    }

    public function consulta(){
        if(Session::exist()){
            $this->loadOtherModel('Persona');
            $this->view->trabajadores = $this->Persona->consultarPersonas( Session::getValue('adscripcion'), '', 'folio', true);
            $totalRegistros = count($this->Persona->consultarPersonas( Session::getValue('adscripcion'), '', ''));
            if ($totalRegistros==0) $totalRegistros = 'NA';
            $this->view->paginacion = $this->crearPaginacion( 1, $totalRegistros );
            $this->view->render($this,'consultaTrabajadores');
        } else {
            header('location:'.URL);
        }
    }

    /*private function crearPaginacion( $pagActiva = 1 , $totalRegistros = ''){

        if( $totalRegistros == '' && $pagActiva == 1 ){
            $this->loadOtherModel('Persona');
            $totalRegistros = count($this->Persona->consultarPersonas( Session::getValue('adscripcion'), '', ''));
        }

        if( $totalRegistros == 'NA' && $pagActiva == 1 ){
            $totalRegistros = 0;
        }

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
        unset($this->Persona);
        return $paginacion;
    }*/

    public function consultaFiltro(){
        if(Session::exist()){
            if( ( isset($_POST['whereAtt']) && $_POST['whereAtt'] != '' ) || 
                ( isset($_POST['whereValue']) && $_POST['whereValue'] != '' ) || 
                ( isset($_POST['order']) && $_POST['order'] != '' ) || 
                ( isset($_POST['page']) && $_POST['page'] != '' ) ) {
                
                if( isset($_POST['whereAtt']) && $_POST['whereAtt'] != '' ){
                    $where = $_POST['whereAtt']." LIKE '%".$_POST['whereValue']."%'";
                } else {
                    $where = '';
                }

                if( isset($_POST['order']) && $_POST['order'] != '' ){
                    $order = $_POST['order'];
                } else {
                    $order = 'folio';
                }


                if( isset($_POST['page']) && $_POST['page'] != '' ){
                    $page = $_POST['page'];
                    $limit = ( $page > 1) ? ($_POST['page'] - 1 ) * 15 : 1;
                }
                   

                $this->loadOtherModel('Persona');
                $trabajadores = ( $limit == 1 ) ?
                $this->Persona->consultarPersonas(Session::getValue('adscripcion'), $where, $order, 1) :
                $this->Persona->consultarPersonas(Session::getValue('adscripcion'), $where, $order, $limit) ;
                $totalRegistros = $this->Persona->consultarPersonas(Session::getValue('adscripcion'), $where, $order, false);

                $tabla ='<table width="95%">
                <tr class="a">
                    <th width="10%">Clave 
                        <div class="contenedor-acomodo">
                            <img class="icono-ordenar" src="'.IMG.'arriba.png" onclick="setOrder(9,\'ASC\')">
                            <img class="icono-ordenar" src="'.IMG.'abajo.png" onclick="setOrder(9,\'DESC\')">
                        </div>
                    </th>
                    <th width="20%">Apellido Paterno 
                        <div class="contenedor-acomodo">
                            <img class="icono-ordenar" src="'.IMG.'arriba.png" onclick="setOrder(2,\'ASC\')">
                            <img class="icono-ordenar" src="'.IMG.'abajo.png" onclick="setOrder(2,\'DESC\')">
                        </div>
                    </th>
                    <th width="20%">Apellido Materno 
                        <div class="contenedor-acomodo">
                            <img class="icono-ordenar" src="'.IMG.'arriba.png" onclick="setOrder(3,\'ASC\')">
                            <img class="icono-ordenar" src="'.IMG.'abajo.png" onclick="setOrder(3,\'DESC\')">
                        </div>
                    </th>
                    <th width="20%">Nombre 
                        <div class="contenedor-acomodo">
                            <img class="icono-ordenar" src="'.IMG.'arriba.png" onclick="setOrder(4,\'ASC\')">
                            <img class="icono-ordenar" src="'.IMG.'abajo.png" onclick="setOrder(4,\'DESC\')">
                        </div>
                    </th>
                    <th width="20%">Correo  
                        <div class="contenedor-acomodo">
                            <img class="icono-ordenar" src="'.IMG.'arriba.png"onclick="setOrder(13,\'ASC\')"> 
                            <img class="icono-ordenar" src="'.IMG.'abajo.png" onclick="setOrder(13,\'DESC\')">
                        </div>
                    </th>
                    <th width="20%"></th>
                </tr>';
                if(is_array($trabajadores)){
                    if (count($trabajadores)>0) {
                        foreach ($trabajadores as $trabajador) {
                            $tabla .= '<tr>
                                <td>'.$trabajador['folio'].'</td>
                                <td>'.$trabajador['primerApellido'].'</td>
                                <td>'.$trabajador['segundoApellido'].'</td>
                                <td>'.$trabajador['nombre'].'</td>
                                <td>'.$trabajador['correo'].'</td>
                                <td><a href="'.URL.'Trabajador/detalle/'.$trabajador['folio'].'" target="_blank">Ver detalle </a></td>
                            </tr>';
                        }
                    }
                    $totalRegistros = count($totalRegistros);
                } else {
                    $tabla .="<tr><td colspan='5'>$trabajadores</td></tr>";
                    $totalRegistros = 'NA';
                }
                $tabla.="</table>";

                if( $page > 1 ){
                    $paginacion = $this->crearPaginacion( $page, $totalRegistros );
                } else {
                    $paginacion = $this->crearPaginacion( 1, $totalRegistros );
                }
                echo $tabla.$paginacion;
            }
        } else {
            header('location:'.URL);
        }
    }
}

?>