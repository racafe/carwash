<?php
	include_once("mysql.php");
	$db = new MySQL();
	if($_GET){
		if(trim($_GET["usuario"]) != "" && trim($_GET["password"]) != ""){
			$dato = $db->query_array("	SELECT 	u.idUsuario,
												u.username, 
												u.password, 
												u.name, 
												u.lastname,
												u.type,
												u.email
										FROM 	Usuario u
										WHERE 	u.usuario = '".$_GET['usuarios']."'");
			if((trim($_POST["usuario"])==$dato["usuario"])&&(md5(trim($_POST["password"]))==$dato["password"])){
			    $result["success"] = true;
			    $result["usuario"]["usuario"] = $dato['usuario'];
			    $result["usuario"]["password"] = $dato['password'];
			    $result["usuario"]["idUsuario"] = $dato['idUsuario'];
			    $result["usuario"]["name"] = $dato['nombre'];
			    $result["usuario"]["lastname"] = $dato['apellidos'];
			    $result["usuario"]["type"] = $dato['tipo'];
			    $result["usuario"]["email"] = $dato['email'];
			}else{
			    $result["success"] = false;
			}
		}else{
		    $result["success"] = false;
		}
	}
//	echo json_encode($result);
	if (isset($_REQUEST['callback'])) {
		header('Content-Type: application/javascript');
		echo $_REQUEST['callback'] . '(' . json_encode($result) . ');';
	} else {
		header('Content-Type: application/json');
		echo json_encode($result);
	}
?>