<?php
require_once("../core/ConnectionBD.php");


class NotificacionDeportistaMapper {

	public function save(Notificacion_deportista $notificacion_deportista)
	{
		global $connect;
	    $consulta= " INSERT INTO Notificacion_deportista (notificacion_idnotificacion, deportista_nombreusuario) VALUES ('". $notificacion_deportista->getId() ."', '". $notificacion_deportista->getReceptor() ."')";
	    $connect->query($consulta);
	}

	function listarNotificacionesReceptor($nombreusuario_deportista){
		global $connect;
		$consulta ="SELECT * FROM Notificacion_deportista WHERE deportista_nombreusuario = '".$nombreusuario_deportista."'";
		$resultado = $connect->query($consulta);
		$listaNotificaciones = array();
		while ($current = mysqli_fetch_assoc($resultado)) {

				$notificacion_deportista = new NotificacionDeportista ($current["notificacion_idnotificacion"],$current["deportista_nombreusuario"]);
				array_push($listaNotificaciones, $notificacion_deportista);
		}
		return $listaNotificaciones;
	}

	public function notificacionVista($idnotificacion_deportista,$nombreusuario_deportista)
	{
		global $connect;
		$consulta= "UPDATE Notificacion_deportista SET  Visto='1' WHERE notificacion_idnotificacion='". $idnotificacion_deportista ."' AND deportista_nombreusuario = '".$nombreusuario_deportista."' ";
			 $connect->query($consulta);
	}

	public function delete($idnotificacion)
	{
		global $connect;
	    $consulta = "DELETE FROM Notificacion_deportista WHERE notificacion_idnotificacion='". $idnotificacion ."' " ;
	    $connect->query($consulta);
	}




}
 ?>
