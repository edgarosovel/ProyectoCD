 <?php 
	
	class Usuario_model extends Model
	{
		function __construct() {
			parent::__construct();
		}

		/**
		*	Función para verificar el estado de los valores para el inicio de sesión.
		*
		* @param String $idUsuario 
		* @param String $password 
		*
		* @return 0: La cuenta esta bloqueada.
		* 	1: Inicio de sesión exitoso.
		*	2: Inicio de sesión fallido.
		*	3: No se encontró el registro.
		*	4: Hay una sesión iniciada.
		*/
		public function iniciarSesion($idUsuario,$password){
			
			$registro = $this->db->select('*', 'usuarios', "idUsuario='".$idUsuario."'");
			if(is_array($registro)){
				if($registro['pass'] == Hash::create(ALGOR,$password,KEY)){
					$yaHaySesion = $this->revisarLogs($idUsuario);
					if($yaHaySesion==0){
						return 4;
					}
					else{
						$this->crearSesion($idUsuario);
						return 1;
					}	
				} else {
					return 2;
				}
			} else {
				return 3;
			}
		}

		/**
		*	Función para verificar si ya existe una sesión en otro dispositivo.
		*
		* @param String $idUsuario 
		*
		* @return 0: Hay una sesion ya iniciada
		*	1: Se puede iniciar sesion
		*/
		public function revisarLogs($idUsuario){
			$maxEntrada = $this->db->select('MAX(idLog) as RES', 'Logs', "idUsuario=".$idUsuario." AND idTipo=1");
			if(!is_null($maxEntrada['RES'])){
				$maxSalida = $this->db->select('MAX(idLog) as RES', 'Logs', "idUsuario=".$idUsuario." AND idTipo=2");
				if(!is_null($maxSalida['RES'])){
					$ultimaEntrada = $this->db->select('tiempo as RES', 'Logs', "idUsuario=".$idUsuario." AND idLog=".$maxEntrada['RES']);
					$ultimaSalida = $this->db->select('tiempo as RES', 'Logs', "idUsuario=".$idUsuario." AND idLog=".$maxSalida['RES']);
					if($ultimaEntrada['RES']>$ultimaSalida['RES']){
						return 0;
					}
					else{
						return 1;
					}
				}
				else{
					return 0;
				}
			}
			else{
				return 1;
			}
		}

		/**
		*	Función para comprobar la contraseña de un usuario
		*
		* @param String $password 
		*
		* @return false: Contraseña invalida
		* 	true: Contraseña valida
		*/
		public function comprobarPassword($password){
			
			$registro = $this->db->select('pass', 'usuarios', "folio='".Session::getValue('idUsuario')."'");

			if( $registro['pass'] == Hash::create(ALGOR, $password,KEY) ){
				return true;
			} else {
				return false;
			}
		}

		/**
		*	Función para actualizar la información de un trabajador
		*
		* @param String(18) $idUsuario
		*
		* @return 0: Error al registrar el éxito.
		* 	1: El registro ha sido registrado con éxito.
		*/
		public function actualizarPassword($idUsuario, $password){
			
			$data['IdUsuario'] = $curp;

			return $this->db->insert($data,'persona');
		}

		/**
		*	Función para que devuelve la información general de la persona
		*
		* @param String $idUsuario 
		*
		* @return array $informacionGeneral Contiene la información General de la persona consultada
		*
		*/
		public function getInformacionGeneral($idUsuario){
			
			$registro = $this->db->select('*', 'usuario_p', "idUsuario='".$idUsuario."'");

			if( is_array($registro) ) {
				$informacionGeneral = array(
				'Usuario' => array($registro['idUsuario'],false),
	   			'Nombre' => array(ucwords(mb_strtolower($registro['nombreUsuario'].' '.$registro['apellidoP'].' '.$registro['apellidoM'])),false),
	   			'Título' => array($registro['titulo'],false),
	   			'Fecha de nacimiento' => array($registro['fechaNac'],false),
	   			'Correo electronico' => array($registro['correo'],true),
	   			'Teléfono' => array($registro['telefono'],true),
	   			'Contraseña' => array("*********",true),
	   			'Tipo de usuario' => array( Session::getValue('tipoUsuario'),false),
	   			'Foto de perfil' => array("",true)
	   			);
	   			
	   			return $informacionGeneral;
			}
		}

		private function crearSesion($idUsuario){

        	$registro = $this->db->select('*', 'Usuarios', "idUsuario = '$idUsuario'");
        	$tipoUsuario = $this->db->select('*', 'tipoUsuarios', "idTipoUsuario = ".$registro['idTipoUsuario']);

        	Session::setValue('idUsuario', $idUsuario);
        	Session::setValue('idTipoUsuario', $registro['idTipoUsuario']);
        	Session::setValue('imagenPerfil', ($registro['foto']!=null) ? $registro['foto'] : "default.png" );
        	//Session::setValue('correo', $registro['correo'] );
        	Session::setValue('nombreUsuario', $registro['nombre'].' '.$registro['apellidoP'].' '.$registro['apellidoM']);
        	Session::setValue('tipoUsuario', ucwords($tipoUsuario['descripcion']));

        	$this->crearMenu($registro['idTipoUsuario']);
    	}

    	/*Tipos de usuario:
		/	3: Aspirante
		/	2: Evaluador
		/	1: Coordinador
		*/
    	private function crearMenu($idTipo){

    		if($idTipo == 3) {
	        	$menu = array( 
		        array('status' => 1, 
		          'nombre' => 'Documentación', 
		          'ubicacion' => "Aspirante/documentacion", 
		          'icono' => "abajo.png"),
		        array('status' => 1, 
		          'nombre' => 'Oferta de educativa', 
		          'ubicacion' => "Aspirante/oferta", 
		          'icono' => "abajo.png"),
		        array('status' => 1, 
		          'nombre' => 'Seguimiento', 
		          'ubicacion' => "Aspirante/seguimiento", 
		          'icono' => "abajo.png")
		      );
	     	} elseif ($idTipo == 2) {
	     		$menu = array( 
		        array('status' => 1, 
		          'nombre' => 'Aspirantes', 
		          'ubicacion' => "Evaluador/aspirantes", 
		          'icono' => "abajo.png"),
		      ); 
	     	} elseif ($idTipo == 1) {
	     		$menu = array( 
		        array('status' => 1, 
		          'nombre' => 'Aspirantes', 
		          'ubicacion' => "Coordinador/aspirantes", 
		          'icono' => "abajo.png"),
		        array('status' => 1, 
		          'nombre' => 'Evaluadores', 
		          'ubicacion' => "Coordinador/evaluadores", 
		          'icono' => "abajo.png"),
		        array('status' => 1, 
		          'nombre' => 'Oferta educativa', 
		          'ubicacion' => "Coordinador/oferta", 
		          'icono' => "abajo.png")
		      ); 
	     	} else {
				$menu = array( 
		        array('status' => 1, 
		          'nombre' => 'No hay accesos', 
		          'ubicacion' => "", 
		          'icono' => "abajo.png"));
	     	}
	     	
	     	Session::setValue('menu',$menu);
    	}
	}

 ?>