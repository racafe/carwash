<?php  
date_default_timezone_set('America/Mexico_City');
if(!isset($_SESSION)){session_start();}
class MySQL{ 

	private $showErrors = true;
	private $conexion;  
	private $total_consultas;
	private $consulta;
	private $resultado;

	/*
		Constructor de la clase
	 */
	public function MySQL(){  
		if(!isset($this->conexion)){ 
		if($_SERVER["HTTP_HOST"] == "ipb.technit.com.mx"){ 
			$this->conexion = (mysql_connect("localhost","tuquinie_ipb","Ipb#2911!")) or die(mysql_error());
		}else{
			$this->conexion = (mysql_connect("localhost","tuquinie_ipb","Ipb#2911!")) or die(mysql_error());
//			$this->conexion = (mysql_connect("localhost","root","")) or die(mysql_error());
		}
//		mysql_set_charset ("utf8",  $this->conexion) or die(mysql_error());
//		mysql_query("SET character_set_results = @@character_set_system", $this->conexion);
		mysql_select_db("tuquinie_ipb",$this->conexion) or die(mysql_error()); 
		}  
	}

	/*
		Función que determina la query en memoria
		$consulta			Consulta que se guarda en memoria (string)
		$run [opcional]		1 permite que la query se ejecute en ese mismo momento
		return void
	 */
	public function setquery($consulta, $run = 1){
		$this->consulta = $consulta;
		if($run)
			$this->query();
	}

	/*
		Función que regresa la query que se tiene en memoria
		return string, consulta en memoria
	 */
	public function getquery(){
		return $this->consulta;
	}

	
	/*
		Función que imprime la query que se tiene en memoria
		return void, imprime la respuesta
	 */
	public function printquery(){
		echo $this->consulta.";";
	}
	
	/*
		Función que ejecuta una query
		$consulta [opcional]	Consulta que se va a ejecutar (string <> NONEE), de no especificarse se ejecuta la query en memoria
		return ResultSet, el resultado de la query ejecutada
	 */ 
	public function query($consulta = "NONEE"){
		if($update = $consulta === "NONEE")
			$consulta = $this->consulta;  
		$this->total_consultas++; 
		$resultado = $this->showErrors ? mysql_query($consulta,$this->conexion) : @mysql_query($consulta,$this->conexion);  
		if(!$resultado && $this->showErrors){  
			echo 'MySQL Error: ' . mysql_error();
			echo $consulta;
			exit;  
		}
		if($update)
			$this->resultado = $resultado;
		return $resultado;   
	}

	/*
		Funcion que regresa el arreglo resultado de una consulta
		Esta funcion se utiliza cuando la query regresa solo una tupla
		$consulta [opcional]	Consulta que se va a ejecutar (string <> NONEE), de no especificarse se ejecuta la query en memoria
		return array, arreglo con la primera (única) tupla del resultado
	 */
	public function query_array($consulta = "NONEE"){
		$result1 = $this->query($consulta);
		return $this->fetch($result1);
	}

	/*
		Función que regresa una variable con el resultado de una consulta
		Esta funcion se utiliza cuando la query regresa solo una tupla con solo un atributo
		$consulta [opcional]	Consulta que se va a ejecutar (string <> NONEE), de no especificarse se ejecuta la query en memoria
		return var, primer (único) atributo de la primera (única) tupla del resultado
	 */
	public function query_value($consulta = "NONEE"){
		$arr = $this->query_array($consulta);
		return $arr[0];
	}
	
	/*
		Función que regresa el id de la última tupla insertada
		return var, id de la última query identificada con "INSERT"
	 */
	public function query_id()
	{
		return @mysql_insert_id();
	}

	/*
		Función que regresa la siguiente tupla de un ResultSet
		$resultado [opcional]	ResultSet (var <> NONEE) del que se quieren obtener las tuplas, de no especificarse se obtiene la siguiente tupla del ResultSet en emoria
		return array, la siguiente tupla del ResultSet
	 */
	public function fetch($resultado = "NONEE"){
		if($resultado === "NONEE")
			$resultado = $this->resultado;
		return @mysql_fetch_array($resultado);  
	}
	
	/*
		Función que cuenta el número de tuplas de un ResultSet
		$resultado [opcional]	ResultSet (var <> NONEE) del que se quieren contar las tuplas, de no especificarse se cuentan las tuplas del ResultSet en memoria
		return int, número de tuplas del ResultSet
	 */
	public function num_rows($resultado = "NONEE"){
		if($resultado === "NONEE")
			$resultado = $this->resultado;  
		return @mysql_num_rows($resultado);  
	}

	/*
		Función que regresa el número de tuplas afectadas por la última query
		return int, número de tuplas afectadas por la última query ejecutada
	 */
	public function affected_rows(){ 
		return @mysql_affected_rows();  
	}

	/*
		Función que obtiene el número de querys que han sido ejecutadas por el programa
		return int, número de querys ejecutadas
	 */
	public function count_query(){  
		return $this->total_consultas;  
	}

	/*
		Función que libera los resultados de un ResultSet
		$resultado [opcional] ResultSet (var <> NONEE) que se quiere liberar de la bdd, de no especificarse se libera el ResultSet en memoria
		return bool, true/false dependiendo del éxito de la operación
	 */
	public function free($resultado = "NONEE"){
		if($resultado === "NONEE")
			$resultado = $this->resultado;
		@mysql_free_result($resultado); 
	}
}
?>