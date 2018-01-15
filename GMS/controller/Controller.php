<?php

foreach(glob("*Controller.php") as $nombre)
	{
		include_once $nombre;
	}
	
if(isset($_GET["controller"]) && isset($_GET["accion"])){
	$objetivo = $_GET["controller"];
	$accion = $_GET["accion"];
	
	$objetivo::$accion();
	
}



?>
