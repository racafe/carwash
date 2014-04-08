<?php
// timeout Addition
// timeout.php
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['lastActivity'])){$_SESSION['lastActivity']=0;}
$current_time =  time(); // added; get current timestamp 
if(isset($_SESSION["tipo"])&& $_SESSION["tipo"]=="1" ){
	$timeout_min = 120;
}else{
	$timeout_min = 15; //minutes of inactivity to log out after
}
//echo "Tiempo a esperar $timeout_min";
$timeout_length = $timeout_min * 60;
if ($current_time - $_SESSION['lastActivity'] > $timeout_length) {
	session_unset();
	session_destroy();
	if(isset($_GET['refresh'])){
		echo '<script>window.alert("Ha pasado mas de 15 min sin actividad en el sitio. Favor de ingresar de nuevo.");</script><script>window.location.href = "index.php";	</script>';
		exit;
	}
?> 

					<div class="dialog" style="display:block; z-index:10000; color:#fcfcfc;" id="page_login">
						<div>
							<h1>SU SESIÓN HA EXPIRADO</h1>
							<p>
								Favor de volver a ingresar nuevamente<br />
							</p>
                            <form method="post" action="index.php" style="position:absolute; left:115px; top:36%;">
                                    <input type="text" name="usuario" placeholder="usuario" class="login_text" /><br /><br />
                                    <input type="password" name="password" placeholder="password" class="login_text" /><br /><br />
                                    <input type="submit" id="login_button" value="INICIAR" style="margin:0 7px;" />
                            </form>
						</div>
					</div>
<?php
	exit;
}else{
	$_SESSION['lastActivity'] = $current_time;	
}
?> 