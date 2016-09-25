<?php 
	
	class Persona_model extends Model
	{

		function __construct() {
			parent::__construct();
		}

		/**
		*	registrarPersona($curp, $primerApellido, $segundoApellido, $nombre, $fecnac, $edonac,
		*		 $sexo, $nacorigen, $folio, $edo, $mun, $loc, $correo, $telefono, $adscripcion)
		*			
		*
		*	Función para registrar un trabajador
		*
		* @param String(18) $curp
		* @param String(50) $primerApellido
		* @param String(50) $segundoApellido
		* @param String(50) $nombre
		* @param integer(8) $fecnac
		* @param String(2) $edonac
		* @param Char(1) $sexo
		* @param String(3) $nacorigen 
		* @param String(18) $folio
		* @param String(2) $edo
		* @param String(3) $mun
		* @param String(4) $loc
		* @param String(100) $correo
		* @param integer(13) $telefono
		* @param String(3) $adscripcion
		*
		* @return 0: Error al registrar el éxito.
		* 	1: El registro ha sido registrado con éxito.
		*/
		public function registrarPersona($curp, $primerApellido, $segundoApellido, $nombre, $fecNac,
			 $edoNac, $sexo, $nacOrigen, $folio, $edo, $mun, $loc, $correo, $telefono, $adscripcion){
				
			$data = array( 'CURP' => mb_strtoupper($curp,'UTF-8'), 
				'primerApellido' => mb_strtoupper($primerApellido,'UTF-8'),
				'segundoApellido' => mb_strtoupper($segundoApellido,'UTF-8'),
				'nombre' => mb_strtoupper($nombre,'UTF-8'),
				'fecNac' => $fecNac,
				'edoNac' => $edoNac,
				'sexo' => $sexo,
				'nacOrigen' => $nacOrigen,
				'folio' => $folio,
				'edo' => $edo,
				'mun' => $mun, 
				'loc' => $loc, 
				'correo' => $correo, 
				'telefono' => $telefono, 
				'idAdscripcion' => $adscripcion);

			return $this->db->insert($data,'personas');
		}

		/**
		*	Función para actualizar la información de un trabajador
		*
		* @param String(18) $curp
		* @param String(50) $primerApellido
		* @param String(50) $segundoApellido
		* @param String(50) $nombre
		* @param integer(8) $fecnac
		* @param String(2) $edonac
		* @param Char(1) $sexo
		* @param String(3) $nacorigen 
		* @param String(18) $folio
		* @param String(2) $edo
		* @param String(3) $mun
		* @param String(4) $loc
		* @param String(100) $correo
		* @param integer(13) $telefono
		* @param String(3) $adscripcion
		*
		* @return 0: Error al registrar el éxito.
		* 	1: El registro ha sido registrado con éxito.
		*/
		public function actualizarPersona($Curp, $primerApellido, $segundoApellido, $nombre, 
			$fecnac, $edonac, $sexo, $nacorigen, $folio, $edo, $mun, $loc, $Correo, $Telefono, 
				$Adscripcion, $tipoPersona, $IdUsuario){
			
			$data = array( 'CURP' => $curp, 
				'primerApellido' => $primerApellido,
				'segundoApellido' => $segundoApellido,
				'nombre' => $nombre,
				'fecnac' => $fecnac,
				'edonac' => $edonac,
				'sexo' => $sexo,
				'nacOrigen' => $nacorigen,
				'folio' => $folio,
				'edo' => $edo,
				'mun' => $mun, 
				'loc' => $loc, 
				'correo' => $Correo, 
				'telefono' => $Telefono, 
				'adscripcion' => $Adscripcion);

			return $this->db->insert($data,'personas');
		}

		/**
		*	Función para actualizar la información de una cuenta cuando se ha accesado por primera vez
		*
		* @param String(50) $correo
		* @param int(13) $telefono
		* @param int(13) $telefonoEmergencia
		* @param int(2) $idPreguntaSeg
		* @param String(50) $respPreguntaSeg
		* @param String(20) $password
		*
		* @return 0: Error al actualizar el registro.
		* 	1: El registro ha sido actualizado con éxito.
		*/
		public function actualizarConfigIncial( $folio, $correo, $telefono, $telefonoEmergencia, $idPreguntaSeg, 
			$respPreguntaSeg, $password ){
			
			$dataPersona = array( 'correo' => $correo, 
				'telefono' => $telefono,
				'telefonoEmergencia' => $telefonoEmergencia);

			$dataUsuario = array( 'pass' => $password, 
				'idPregSeg' => $idPreguntaSeg,
				'resSeg' => $respPreguntaSeg);

			return ( $this->db->update($dataPersona,'personas'," folio = $folio ") && 
				$this->db->update($dataUsuario,'usuarios'," folio = $folio ") );
		}

		/**
		*	Función para registrar un trabajador
		*
		* @param String(18) curp
		*
		* @return 0: Error al registrar el éxito.
		* 	1: El registro ha sido registrado con éxito.
		*/
		public function eliminarPersona($Curp){
			
			return $this->db->update($data,'personas');
		}

		/**
		*	Función para consultar a una persona por su CURP
		*
		* @param String(18) $curp
		*
		* @return array $registro Contiene la información de la persona Consultada
		*/
		public function consultarPersonaByCURP($adscripcion, $curp){
			
			return $registro = $this->db->select("*","personas"," CURP like '{$curp}' AND idAdscripcion like '{$adscripcion}'");
		}

		/**
		*	Función para consultar a una persona por su Folio
		*
		* @param String $curp
		*
		* @return $registro Contiene la información de la persona Consultada
		*/
		public function consultarPersonasByFolio($adscripcion, $folio){
			
			return $registro = $this->db->select("*","personas"," folio like '{$folio}' AND idAdscripcion like '{$adscripcion}'");
		}

		/**
		*	Función para consultar a todas las personas
		*
		* @param String $curp
		* @param array $desde
		*
		* @return $registro Contiene la información de las personas Consultada
		*/
		public function consultarPersonas($adscripcion, $where = '', $orderBy = 'folio', $desde = '' ){
			
			if($where != ''){
				$where = "AND {$where}";
			}
			
			return $registro = $this->db->selectStrict("*","personas","idAdscripcion LIKE '{$adscripcion}' {$where} ", $orderBy, $desde);
		}

	}

 ?>

