<?php

require_once(__DIR__."/../model/Actividad.php");
require_once(__DIR__."/../model/ActividadMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../core/ConnectionBD.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ActividadesController extends BaseController {


	private $actividadMapper;
	private $userMapper;

	public function __construct() {
		//parent::__construct();

		$this->actividadMapper = new ActividadMapper();
		$this->userMapper = new UserMapper();
	}
	public function listarActividades (){
		return $this->actividadMapper->listarActividades();
	}

	public function listarActividadesIndividuales (){
		return $this->actividadMapper->listarActividadesIndividuales();
	}

	public function listarActividadesGrupo (){
		return $this->actividadMapper->listarActividadesGrupo();
	}
	
	public function getActividad ($idActividad){
		return $this->actividadMapper->getActividad($idActividad);
	}

	public function buscarActividadById($idActividad){
		return $this->actividadMapper->findActividadById($idActividad);
	}



	
		public function registrarActividad (){
		
		$actividadMapper = new ActividadMapper();
		global $connect;
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
		
		//Obtener el nombre de la actividad
		$nombreactividad = $_POST['nombreactividad'];
		//Obtener la descripcion de la actividad
		$descripcionactividad = $_POST['descripcionactividad'];
		//Obtener la fecha y la hora de la actividad
		$date = $_POST['horario'];
		$horario = date("Y-m-d H:i:s", strtotime($date));
		//Obtener el numero de plazas de la actividad
		$capacidad= $_POST['capacidad'];
		//Obtener el tipo de la actividad
		$tipoActividad = $_POST['tipoActividad'];
		
		$actividad = new Actividad ($nombreactividad,$descripcionactividad,$horario,$capacidad,$tipoActividad);
		$actividadMapper->registrarActividad($actividad, $nombreactividad);
		header ("Location: ../view/adminActividades.php?lang=$lang");

	}
	
	public function eliminarActividad (){
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
		
		if (!isset($_POST["idActividad"])) {
			throw new Exception("id is mandatory");
	   	 }
		$idActividad = $_REQUEST["idActividad"];
		$actividadMapper = new ActividadMapper();
		$actividadMapper->eliminarActividad($idActividad);
		header ("Location: ../view/adminActividades.php?lang=$lang");


	}
	
	public function modificarActividad (){
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
		
		if (!isset($_POST["id"])) {
			//Esta excepcion habría que capturarla en algun lado
			//throw new Exception("id is mandatory");
	   	 }
		
		$actividadMapper = new ActividadMapper();
		
		
		//Obtener el id de  la actividad
		$idactividad = $_POST['idactividad'];
		//Obtener el nombre de la actividad
		$nombreactividad = $_POST['nombreactividad'];
		//obtener la descripcion de la actividad
		$descripcionactividad = $_POST['descripcionactividad'];
		//Obtener la fecha y la hora de la actividad
		$horario = $_POST['horario'];
		//Obtener la capacidad de la actividad
		$capacidad = $_POST['capacidad'];
		//Obtener el tipo de la actividad
		$tipoActividad = $_POST['tipoActividad'];
		
		$actividad = new Actividad ($nombreactividad,$descripcionactividad,$horario,$capacidad,$tipoActividad);
		$actividadMapper->updateActividad($actividad,$idactividad);
		header ("Location: ../view/adminActividades.php?lang=$lang");
	}
	
	public function getReserva($idActividad){
		global $connect;
		$consulta = "SELECT plazas_ocupadas FROM Reserva WHERE Actividad_idactividad ='" .$idactividad."'";
		$resultado = $connect->query($consulta);
		$reserva = mysqli_fetch_assoc($resultado);
		return $reserva;
	}

	public function reservarPlaza($idActividad,$usuarioActual){
		return $this->actividadMapper->reservar($idActividad,$usuarioActual);

		}

	


	
}
	
	
	?>