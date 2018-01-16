<?php

require_once(__DIR__."/../model/Ejercicio.php");
require_once(__DIR__."/../model/EjercicioMapper.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User.php");


//require_once(__DIR__."/../controller/Controller.php");


class EjerciciosController  {


	private $ejercicioMapper;

	public function __construct() {
		

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
  
   public function listaEjercicios(){
    return $this->ejercicioMapper->listarEjercicios();
  }
/*
  public function listaEjerciciosGrupo($grupo){
    return $this->ejercicioMapper->listarEjerciciosGrupo($grupo);
  }
*/
  public function buscarId($id){
    return $this->ejercicioMapper->buscarId($id);
  }

  public function modificarEjercicio(){

    $econtroler = new EjerciciosController();
    $ejercicioMapper  = new EjercicioMapper();
    $nombreejercicio = $_POST['nombreejercicio'];
    $descripcionejercicio = $_POST['descripcionejercicio'];
    $idejercicio = $_POST['idejercicio'];
  
    
    if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
	   }
	   
    

    $ejercicio= new Ejercicio($nombreejercicio, $descripcion);
    $ejercicioMapper->modificarEjercicio($ejercicio, $idejercicio);
    header("Location: ../view/adminEjercicios.php?lang=$lang");
  
  }
  
  public function eliminarEjercicio() {
	 if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
	   }
	   
    if (!isset($_POST["idejercicio"])) {
   
    }

    $idejercicio = $_REQUEST["idejercicio"];
    $ejercicioMapper = new EjercicioMapper();

    $ejercicio = $ejercicioMapper->buscarId($idejercicio);

    if ($ejercicio == NULL) {
      throw new Exception("no such post with id: ". $idejercicio);
    }

    $ejercicioMapper->eliminarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php?lang=$lang");
  }

}

?>