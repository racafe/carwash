<?php  
date_default_timezone_set('America/Mexico_City');
if(!isset($_SESSION)){session_start();}
include("prevent_mysql_injection.php");
class MySQL{ 
	private $mysqli;
	private $mysqli_result;
		
	/* Connect to a MySQL server */
	public function MySQL(){  
		if($_SERVER["HTTP_HOST"] == "ipb.technit.com.mx"){ 
			$this->mysqli = new mysqli("localhost","tuquinie_ipb","Ipb#2911!","tuquinie_ipb");
		}else{
			$this->mysqli = new mysqli("localhost","root","","tuquinie_ipb");
		}
		
		if (!$this->mysqli) {
		   printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
		   exit;
		}
	}
	
	/* Send a query to the server */
	function setquery($consulta){
		$this->mysqli_result = mysqli_query($this->mysqli, $consulta);
	}
	
	function query_array($consulta){
		$this->setquery($consulta);
		return mysqli_fetch_array($this->mysqli_result);
		mysqli_free_result($this->mysqli_result);
	}
	
	function query_value($consulta){
		$row = query_array($consulta);
		return $row[0];
	}
	function fetch(){
		/* Fetch the results of the query */
		return mysqli_fetch_assoc($this->mysqli_result);
		/* Destroy the result set and free the memory used for it */
		mysqli_free_result($this->mysqli_result);
	}

	/* Close the connection */
//	mysqli_close($link);
	}
?>


