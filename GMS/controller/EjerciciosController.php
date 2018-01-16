<?php

require_once(__DIR__."/../model/Ejercicio.php");
require_once(__DIR__."/../model/EjercicioMapper.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
//require_once(__DIR__."/../controller/Controller.php");


class EjerciciosController  {


	private $ejercicioMapper;

	public function __construct() {
		parent::__construct();

		$this->ejercicioMapper = new EjercicioMapper();
	
	}


 public function registrarEjercicio() {
	if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
	   }

    $ucontroler = new UsersController();
    $econtroler = new EjerciciosController();
    $usuarioActual =  $ucontroler->getcurrentUser($_SESSION['nombreusuario']);

    $ejercicioMapper = new EjercicioMapper();
   
    $nombreejercicio = $_POST["nombreejercicio"];
    if ($nombreejercicio == ""){
      $nombreejercicio = "Nombre por defecto";
    }
    $ejercicio = new Ejercicio($nombreejercicio, $usuarioActual->getnombreusuario(), $_POST["descripcion"]);

    $ejercicioMapper->registrarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php?lang=$lang");

  }
	
}
