<?php
require_once("../core/ConnectionBD.php");
require_once("../model/NotificacionMapper.php");
require_once("../model/DeportistaMapper.php");
require_once("../model/Notificacion.php");
require_once("../model/Deportista.php");
require_once("../model/notificacionDeportistaMapper.php");
require_once("../model/NotificacionDeportista.php");


class NotificacionesController{

	private $notificacionMapper;
	private $deportistaMapper;
	private $notificacionDeportistaMapper;

	public function __construct() {

		$this->notificacionDeportistaMapper = new NotificacionDeportistaMapper();
    $this->notificacionMapper = new NotificacionMapper();
		$this->deportistaMapper = new DeportistaMapper();
  }

	public function newNotificacion(){

		$notificacionDeportistaMapper = new NotificacionDeportistaMapper();
		$notificacionMapper = new NotificacionMapper();
		$deportistaMapper = new DeportistaMapper();

		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
		   $lang="es";
		}

    $receptor=$_POST['receptor'];
		$titulo = $_POST['titulo'];
		$mensaje = $_POST['mensaje'];


		if($receptor=="todos"){

			$notificacion = new Notificacion($_SESSION["nombreusuario"],$titulo,$mensaje);
			$notificacionMapper->save($notificacion);
			$idUltima = $notificacionMapper->findLastId();

			$deportistas = $deportistaMapper->listarDeportistas();
			foreach ($deportistas as $deportista) {
				$notificacion_deportista= new NotificacionDeportista($idUltima,$deportista->getUsername());
				$notificacionDeportistaMapper->save($notificacion_deportista);

			}
		}else{

			$receptores =$_POST['receptores'];

			if(empty($receptores))
			{
				echo "No has añadido usuarios";
			}
			else
			{
				$notificacion = new Notificacion($_SESSION["nombreusuario"],$titulo,$mensaje);
				$notificacionMapper->save($notificacion);
				$idUltima = $notificacionMapper->findLastId();

				$N = count($receptores);
				for($i=0; $i < $N; $i++)
				{
					$notificacion_deportista= new NotificacionHasDeportista($idUltima,$receptores[$i]);
					$notificacionDeportistaMapper->save($notificacion_deportista);
				}
			}
		}
		header ("Location: ../view/adminIndex.php?lang=$lang");

	}

	public function listaNotificacionesReceptor($nombreusuario_receptor){
		return $this->notificacionDeportistaMapper->listarNotificacionesReceptor($nombreusuario_receptor);
	}

	public function notificacionId($idnotificacion){
		return $this->notificacionMapper->find($idnotificacion);
	}

	public function listaNotificaciones(){
		return $this->notificacionMapper->listaNotificaciones();
	}


	public function deleteNotificacion(){
		$idnotificacion = $_REQUEST["idnotificacion"];
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
		   $lang="es";
		}
		$notificacionMapper = new NotificacionMapper();
		$notificacionHDMapper = new NotificacionDeportistaMapper();
		$notificacionMapper->delete($idnotificacion);
		header ("Location: ../view/adminIndex.php?lang=$lang");

	}







}


?>
