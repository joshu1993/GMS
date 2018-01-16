<?php
require_once("../core/ConnectionBD.php");


class NotificacionMapper {

	public static function find($idnotificacion){
		global $connect;
		$consulta = "SELECT * FROM Notificacion WHERE idnotificacion='". $idnotificacion ."' ";
		$res = $connect->query($consulta);
		$resultado = mysqli_fetch_assoc($res);

		if($resultado != null) {
      return new Notificacion($resultado["idnotificacion"],$resultado["Usuario_nombreusuario"],$resultado["titulo"],$resultado["mensaje"]);
    } else {
      return NULL;
    }
	}

	public static function listaNotificaciones(){
		global $connect;
		$consulta = "SELECT * FROM Notificacion ";
		$resultado = $connect->query($consulta);
		$listaNotificaciones = array();
		while ($current = mysqli_fetch_assoc($resultado)) {
        $notificacion = new Notificacion($current["idnotificacion"],$current["Usuario_nombreusuario"],$current["titulo"],$current["mensaje"]);
				array_push($listaNotificaciones, $notificacion);
		}
		return $listaNotificaciones;
	}

	public static function findLastId(){
		global $connect;
		$consulta = "SELECT * FROM Notificacion ORDER BY `idnotificacion` DESC LIMIT 1;";
		$res = $connect->query($consulta);
		$resultado = mysqli_fetch_assoc($res);

    if($resultado != null) {
      return $resultado["idnotificacion"];
    } else {
      return NULL;
    }
	}

	public function save(Notificacion $notificacion)
	{
		global $connect;
	    $consulta= " INSERT INTO Notificacion (Usuario_nombreusuario, titulo, mensaje) VALUES ('". $notificacion->getEmisor() ."', '". $notificacion->getTitulo() ."', '". $notificacion->getMensaje() ."')";
	    $connect->query($consulta);
	}

	public function delete($idnotificacion)
	{
		global $connect;
	    $consulta = "DELETE FROM Notificacion WHERE idnotificacion='". $idnotificacion ."' " ;
	    $connect->query($consulta);
	}




}
 ?>
