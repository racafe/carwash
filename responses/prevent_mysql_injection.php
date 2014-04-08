<?php 
	if($_SERVER["HTTP_HOST"] == "ipb.technit.com.mx"){ 
		$mysqli = new mysqli("localhost","tuquinie_ipb","Ipb#2911!","tuquinie_ipb");
	}else{
		$mysqli = new mysqli("localhost","root","","tuquinie_ipb");
	}
  foreach ($_GET as $key => $value) { 
    //$_GET[$key] = mysql_real_escape_string($value); 
	$_GET[$key] = mysqli_real_escape_string($mysqli, $value);
  } 
	/*
	$get = "";
	foreach ($_GET as $key => $value) { 
		if($get == ""){
			$get=" WHERE ";
		}else{
			$get.=" AND ";
		}
		if(get_magic_quotes_gpc()) $_GET[$key]=stripslashes($value); 
		$_GET[$key] = mysql_real_escape_string($value); 
		$get.= $key."=".$_GET[$key];
	 } */
?>