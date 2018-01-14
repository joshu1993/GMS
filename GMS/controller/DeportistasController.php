<?php
require_once("../model/Deportista.php");
require_once("../model/DeportistaMapper.php");
require_once("../model/UserMapper.php");

class DeportistasController{

  private $deportistaMapper;
  private $userMapper;

  public function __construct() {

    $this->deportistaMapper = new DeportistaMapper();
    $this->userMapper = new UserMapper();
  }


  public function register() {

    $deportistaMapper = new DeportistaMapper();
    $userMapper = new UserMapper();

    if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}

    if(isset($_POST["nombreusuario"])){ //Cogemos los datos de http

      $deportista = new Deportista($_POST["nombreusuario"],$_POST["contraseña"],$_POST["email"],"deportista",$_POST["tipo"]);
      $user = new User($_POST["nombreusuario"],$_POST["contraseña"],$_POST["email"],"deportista");

      try{

      	if (!$userMapper->usernameExists($deportista->getUsername())){

            $deportistaMapper->saveDeportista($deportista);
            $userMapper->save($user);

            echo '<script language="javascript">alert("'.__('Se ha creado el deportista.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';
      	} else {
      	  echo '<script language="javascript">alert("'.__('Ya existe un deportista con el mismo DNI.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';

      	}
      }catch(ValidationException $ex) {
	    // Get the errors array inside the exepction...
	     $errors = $ex->getErrors();
       print_r($errors);

      }
    }
  }

  public function listaDeportistas(){
    return $this->deportistaMapper->listarDeportistas();
  }

  public function listaDeportistasTipo($tipo){
    return $this->deportistaMapper->listarDeportistasTipo($tipo);
  }

  public function eliminarDeportista() {

    $deportistaMapper = new DeportistaMapper();
    $userMapper = new UserMapper();
    if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}

    if (!isset($_POST["nombreusuario"])) {
      throw new Exception("username is mandatory");
    }

    $nombredepor = $_REQUEST["nombreusuario"];
    echo $nombredepor;
    $deportista = $deportistaMapper->searchName($nombredepor);
    print_r($deportista);
    if ($deportista == NULL) {
      throw new Exception("No existe deportista con nobre: ".$nombredepor);
    }

    // Delete the Post object from the database
    $deportistaMapper->deleteDeportista($deportista);
    $usuarioMapper->delete($deportista->getUsername());

    header("Location: ../view/adminDeportistas.php?lang=$lang");
  }

  public function buscarDeportista($nombreusuario){
    return $this->deportistaMapper->searchName($nombreusuario);
  }

  public function modificarDeportista(){
    $deportistaMapper  = new DeportistaMapper();
    $userMapper  = new UserMapper();
        if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}
    $nombredepor = $_POST['nombreusuario'];
    $contraseñadepor = $_POST['contraseña'];
    $emaildepor = $_POST['email'];
    $tipodepor = $_POST['tipodeportista'];
    $nombreAntiguo = $_POST['nombreAntiguo'];



    $deportista= new Deportista($nombredepor, $contraseñadepor, $emaildepor,"deportista",$tipodepor);
    $usuario = new Usuario($nombredepor,$contraseñadepor, $emaildepor,"deportista");
    $deportistaMapper->updateDeportista($deportista,$nombreAntiguo);
    $usuarioMapper->update($usuario,$nombreAntiguo);
    echo '<script language="javascript">alert("'.__('Se ha modificado el deportista.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';
  }

}

?>
