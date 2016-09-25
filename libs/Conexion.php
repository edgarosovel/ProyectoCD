<?php
	class Conexion{

		private $link, $host, $user, $password, $database, $charset;

		public function __construct() {

	        require_once ('config.php');
	        $this->host=DB_HOST;
	        $this->user=DB_USER;
	        $this->password=DB_PASS;
	        $this->database=DB_NAME;
	        $this->charset=DB_CHARSET;

	        $this->link = new mysqli($this->host, $this->user, $this->password, $this->database);
	        $this->link->query("SET NAMES '"+$this->charset+"'");
	    }
     
     	/**
     	*	select($attr, $table, $where = null, $orderBy = null)
     	*
     	*	Realiza la consulta a la base de datos.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $attr: Atributos de la tabla que se consultaran. Ej "IdUsuario, NombreUsuario".
     	* @param String $table: Tabla de la cual se consultarán los atributos.
     	* @param String $where: Condición que cumplirán los registros consultados. Ej "IdUsuario = 5 AND Tipo like 'admin'". [opcional]
     	* @param String $orderBy: Ordenamiento de los registros consultados. [opcional]
     	*
     	* @return $reponse: El (los) registro(s) devueltos de la consulta realizada:
     	*	array $response: Se encontró solo un registro.
     	*	array(array()) $response: Se encontraron varios registros.
     	*	String $response: No se encontró ningún registro.
     	*/
	    public function select($attr, $table, $where = '', $orderBy = '', $limit = false ){

			$where = ($where != '' &&  $where != null) ? "WHERE ".$where : '';
			$orderBy = ($orderBy != '' &&  $orderBy != null) ? $orderBy : '1';
			$limit = ( $limit != false  &&  $limit != null && $limit != '' ) ? 
			($limit == 1) ? "LIMIT 0,15" : "LIMIT {$limit},15" : '';

			$stmt = "SELECT {$attr} FROM {$table} {$where} ORDER BY {$orderBy} {$limit};";

			$result = $this->link->query($stmt);

			if($result->num_rows > 0) {
				if($result->num_rows == 1){
					$response = $result->fetch_assoc();
				} else {
		            while($row = $result->fetch_assoc()){
		                $response[] = $row;
		            }
		        }
	            return $response;
			} else {
				return $response = 'No se encontró ningún registro';
			}
		}

		/**
     	*	selectStrict($attr, $table, $where = null, $orderBy = null)
     	*
     	*	Realiza la consulta a la base de datos.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $attr: Atributos de la tabla que se consultaran. Ej "IdUsuario, NombreUsuario".
     	* @param String $table: Tabla de la cual se consultarán los atributos.
     	* @param String $where: Condición que cumplirán los registros consultados. Ej "IdUsuario = 5 AND Tipo like 'admin'". [opcional]
     	* @param String $orderBy: Ordenamiento de los registros consultados. [opcional]
     	*
     	* @return $reponse: El (los) registro(s) devueltos de la consulta realizada:
     	*	array(array()) $response: Se encontraron varios registros.
     	*	String $response: No se encontró ningún registro.
     	*/
	    public function selectStrict($attr, $table, $where = '', $orderBy = '', $limit = false ){

			$where = ($where != '' &&  $where != null) ? "WHERE ".$where : '';
			$orderBy = ($orderBy != '' &&  $orderBy != null) ? $orderBy : '1';
			$limit = ( $limit != false  &&  $limit != null && $limit != '' ) ? 
			($limit == 1) ? "LIMIT 0,15" : "LIMIT {$limit},15" : '';

			$stmt = "SELECT {$attr} FROM {$table} {$where} ORDER BY {$orderBy} {$limit};";

			$result = $this->link->query($stmt);

			if($result->num_rows > 0) {
	            	while($row = $result->fetch_assoc()){
	                $response[] = $row;
		        }
	            return $response;
			} else {
				return $response = 'No se encontró ningún registro';
			}
		}

		/**
     	*	printSelect($attr, $table, $where = null, $orderBy = null)
     	*
     	*	Imprime la consulta a la base de datos.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $attr: Atributos de la tabla que se consultaran. Ej "IdUsuario, NombreUsuario".
     	* @param String $table: Tabla de la cual se consultarán los atributos.
     	* @param String $where: Condición que cumplirán los registros consultados. Ej "IdUsuario = 5 AND Tipo like 'admin'". [opcional]
     	* @param String $orderBy: Ordenamiento de los registros consultados. [opcional]
     	*
     	* @return $reponse: Query
     	*/
	    public function printSelect($attr, $table, $where = '', $orderBy = '', $limit = false ){

			$where = ($where != '' &&  $where != null) ? "WHERE ".$where : '';
			$orderBy = ($orderBy != '' &&  $orderBy != null) ? $orderBy : '1';
			$limit = ( $limit != false  &&  $limit != null && $limit != '' ) ? 
			($limit == 1) ? "LIMIT 0,15" : "LIMIT {$limit},15" : '';

			$stmt = "SELECT {$attr} FROM {$table} {$where} ORDER BY {$orderBy} {$limit};";

			return $stmt;
		}
		
		/**
     	*	insert($data, $table)
     	*
     	*	Inserta un nuevo registro a la tabla indicada.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param array $data: Atributos del nuevo registro. Ej "{ 'IdUsuario' => 230989, 'Nombre' = 'J. Pablo' }".
     	* @param String $table: Tabla a la cual se insertara el registro.
     	*
     	* @return bool $reponse: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function insert($data, $table){

			$columns = null;
			$values = null;

			foreach ($data as $key => $value) {
				$columns.=$key.',';
				$values.='"'.$value.'",';
			}

			$columns = substr($columns, 0,-1);
			$values = substr($values, 0, -1);

			$stmt = "INSERT INTO $table ({$columns}) VALUES({$values});";

			$result = $this->link->query($stmt) or die($this->link->error);

			return $result;
		}

		/**
     	*	insert($data, $table)
     	*
     	*	Imprime la sentencia INSERT con los valores recibidos.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param array $data: Atributos del nuevo registro. Ej "{ 'IdUsuario' => 230989, 'Nombre' = 'J. Pablo' }".
     	* @param String $table: Tabla a la cual se insertara el registro.
     	*
     	* @return String $reponse: Regresa el DML que se ejecutaría
     	*/
		public function printInsert($data, $table){

			$columns = null;
			$values = null;

			foreach ($data as $key => $value) {
				$columns.=$key.',';
				$values.='"'.$value.'",';
			}

			$columns = substr($columns, 0,-1);
			$values = substr($values, 0, -1);

			$stmt = "INSERT INTO $table ({$columns}) VALUES({$values});";

			return $stmt;
		}

		/**
     	*	update(array $data, string $table, string $where)
     	*
     	*	Actualiza la información de los registros en la tabla y con la condición indicada.  
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param array $data: Atributos que serán actualizados. Ej "{ 'IdUsuario' => 230989, 'Nombre' = 'J. Pablo' }".
     	* @param String $table: Tabla a la cual se actualizarán los registros.
     	* @param String $where: Condición que cumplirán los registros para ser actualidos. Ej "IdUsuario = 5 AND Tipo like 'admin'".
     	*
     	* @return bool $reponse: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function update($data, $table, $where){

			$values = null;

			foreach ($data as $key => $value) {
				$values.= $key.' = "'.$value.'",';
			}

			$values = substr($values, 0, -1);

			$stmt = "UPDATE {$table} SET {$values} WHERE {$where};";

			$result = $this->link->query($stmt) or die($this->link->error);
			
			return $result;
		}

		/**
     	*	update(array $data, string $table, string $where)
     	*
     	*	Imprime la sentencia UPDATE con los valores recibidos.    
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param array $data: Atributos que serán actualizados. Ej "{ 'IdUsuario' => 230989, 'Nombre' = 'J. Pablo' }".
     	* @param String $table: Tabla a la cual se actualizarán los registros.
     	* @param String $where: Condición que cumplirán los registros para ser actualidos. Ej "IdUsuario = 5 AND Tipo like 'admin'".
     	*
     	* @return String $reponse: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function printUpdate($data, $table, $where){

			$values = null;

			foreach ($data as $key => $value) {
				$values.= $key.' = "'.$value.'",';
			}

			$values = substr($values, 0, -1);

			$stmt = "UPDATE {$table} SET {$values} WHERE {$where};";

			return $stmt;
		}

		/**
     	*	delete(string $table, string $where)
     	*
     	*	Elimina la información en la tabla de la BD de acuerdo a la condición indicada.
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $table: Tabla en la cual se eliminaran los registros.
     	* @param String $where: Condición que cumplirán los registros que serán eliminados. Ej "IdUsuario = 5 AND Tipo like 'admin'".
     	*
     	* @return bool $reponse: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function delete( $table, $where){

			$stmt = "DELETE FROM {$tabla} WHERE {$where};";

			$result = $this->link->query($stmt) or die($this->link->error);
			
			return $result;
		}

		/**
     	*	deleteByStatus(string $table, string $where)
     	*
     	*	Modificara el campo de estatus a 0 de los registros en la tabla de la BD de acuerdo a la condición indicada.
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $table: Tabla en la cual se modifira el estatus los registros.
     	* @param String $where: Condición que cumplirán los registros que serán actualizados. Ej "IdUsuario = 5 AND Tipo like 'admin'".
     	*
     	* @return bool $reponse: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function deleteByStatus($table, $where, $statusRow = "status"){

			$stmt = "UPDATE {$tabla} SET {$statusRow} = 0 WHERE {$where};";

			$result = $this->link->query($stmt) or die($this->link->error);
			
			return $result;
		}

		/**
     	*	function query($stmt)
     	*
     	*	Realiará un DML en la BD.
     	*
     	* @author Juan Pablo Gutiérrez
     	* @version 1.0
     	* @category DataBase
     	* @param String $stmt: DML que será ejecutado. Ej "SELECT * FROM usuarios WHERE IdUsuario = 1 AND...".
     	*
     	* @return $reponse: El (los) registro(s) devueltos de la consulta realizada:
     	*	array $response: Se encontró solo un registro.
     	*	array(array()) $response: Se encontraron varios registros.
     	*	String $response: No se encontró ningún registro.
     	*	bool $response: Resultado de la ejecución del Data Manipulation Lenguaje.
     	*/
		public function query($stmt){
			$result = $this->link->query($stmt) or die($this->link->error);

			if( is_bool($result) ){
				return $response = $result;
			} else {
				if($result->num_rows > 0) {
					if($result->num_rows == 1){
						$response = $result->fetch_assoc();
					} else {
			            while($row = $result->fetch_assoc()){
			                $response[] = $row;
			            }
			        }
		            return $response;
				} else {
					return $response = 'No se encontró ningún registro';
				}
			}
		}

		public function __destruct(){
			$idThread = $this->link->thread_id;
			$this->link->kill($idThread);
			$this->link->close();
		}
	}
?>
