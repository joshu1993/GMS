<?php
require_once("../core/connectionBD.php");
require_once("../model/Deportista.php");
if(!isset($_SESSION)) session_start();

class DeportistaMapper {

  public function __construct(){}

    public function saveDeportista($deportista) {
    global $connect;
    $consulta= " INSERT INTO Deportista (nombreusuario, Usuario_nombreusuario, tipodeportista) VALUES ('". $deportista->getUsername() ."',
     '". $_SESSION["nombreusuario"] ."', '". $deportista->getTipo() ."')";
    $connect->query($consulta);
  }

    public function isValidUser($nombreusuario, $contraseña) {
    $stmt = $this->db->prepare("SELECT count(nombreusuario) FROM usuario where nombreusuario=? and contraseña=?");
    $stmt->execute(array($nombreusuario, $contraseña));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  public function listarDeportistas() {
    global $connect;
	$consulta = "SELECT * FROM Usuario U, Deportista D  WHERE U.nombreusuario = D.nombreusuario";
    $resultado = $connect->query($consulta);
	$listaDeportistas = array();
	while ($current = mysqli_fetch_assoc($resultado)){
      $deportista = new Deportista($current["nombreusuario"],$current["nombre"],$current["contraseña"],$current["correo"],$current["tipousuario"],$current["tipodeportista"],NULL);
	  array_push($listaDeportistas, $deportista);
	}
	return $listaDeportistas;
}

  public function listarDeportistasTipo($tipo) {
    global $connect;
		$consulta = "SELECT * FROM Usuario U, Deportista D  WHERE U.nombreusuario = D.nombreusuario AND tipodeportista ='$tipo'";
    $resultado = $connect->query($consulta);
		$listaDeportistas = array();
		while ($current = mysqli_fetch_assoc($resultado)) {
        $deportista = new Deportista($current["nombreusuario"],$current["nombre"],$current["contraseña"],$current["correo"],$current["tipousuario"],$current["tipodeportista"]);
				array_push($listaDeportistas, $deportista);
		}
		return $listaDeportistas;
	}

  public function deleteDeportista(Deportista $deportista) {
    global $connect;
    $consulta = "DELETE FROM Deportista WHERE nombreusuario='".$deportista->getUsername()."' ";
    $connect->query($consulta);
  }

  public function searchUsername($nombreusuario){
    global $connect;
    $consulta = "SELECT * FROM Usuario U, Deportista D WHERE U.nombreusuario = D.nombreusuario AND U.nombreusuario='$nombreusuario' ";
    $res = $connect->query($consulta);
    $resultado = mysqli_fetch_assoc($res);

    if($resultado != null) {
      return new Deportista($resultado["nombreusuario"],$resultado["nombre"],$resultado["contraseña"],$resultado["correo"],$resultado["tipousuario"],$resultado["tipodeportista"]);
    } else {
      return NULL;
    }
  }

	public function updateDeportista($deportista,$nombreAntiguo){
		global $connect;
		$consulta= "UPDATE Deportista set nombreusuario='".$deportista->getUsername()."', tipodeportista='".$deportista->getUserType()."' WHERE nombreusuario='".$nombreAntiguo."'";
		$connect->query($consulta);
    $consulta2= "UPDATE Usuario SET nombreusuario='".$deportista->getUsername()."',nombre='". $deportista->getName() ."' , contraseña='". $deportista->getPassword() ."', correo='". $deportista->getMail() ."' WHERE nombreusuario='". $nombreAntiguo ."'";
    $connect->query($consulta2);
	}
}
?>
