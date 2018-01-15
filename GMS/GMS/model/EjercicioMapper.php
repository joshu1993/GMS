<?php
// file: model/ExerciseMapper.php
require_once(__DIR__."/../core/ConnectionBD.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Ejercicio.php");


class EjercicioMapper {

public function isValidUser($nombreusuario, $contraseña) {
    $stmt = $this->db->prepare("SELECT count(nombreusuario) FROM users where nombreusuario=? and contraseña=?");
    $stmt->execute(array($nombreusuario, $contraseña));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  public function registrarEjercicio($ejercicio) {
    global $connect;
	  
	    $consulta= " INSERT INTO Ejercicio (Usuario_nombreusuario, nombreejercicio, descripcionejercicio)
      VALUES ('". $ejercicio->getusuarionombreusuario() ."','". $ejercicio->getnombreejercicio() ."', '". $ejercicio->getdescripcionejercicio() ."')";
	    $connect->query($consulta);

	}

  

  public function listarEjercicios() {
    global $connect;
		$consulta = "SELECT * FROM Ejercicio";
    $resultado = mysqli_query($connect, $consulta) or die (mysqli_error($connect));
		$listaEjercicios = array();
		while ($current = mysqli_fetch_assoc($resultado)) {
        $ejercicio = new Ejercicio($current["nombreejercicio"],$current["Usuario_nombreusuario"],$current["descripcionejercicio"], $current["idejercicio"]);
				array_push($listaEjercicios, $ejercicio);
		}
		return $listaEjercicios;
	}

  public function modificarEjercicio($ejercicio, $idejercicio){
		global $connect;
		$consulta= "UPDATE Ejercicio set usuario_nombreusuario='".$ejercicio->getusuarionombreusuario()."',nombreejercicio='".$ejercicio->getnombreejercicio()."',
		descripcionejercicio='".$ejercicio->getdescripcionejercicio()."'
    WHERE idejercicio='".$idejercicio."'";
		$connect->query($consulta);
		
	}

  public function eliminarEjercicio($ejercicio) {
    global $connect;
    $consulta = "DELETE FROM Ejercicio WHERE idejercicio ='".$ejercicio->getidejercicio()."' ";
    $connect->query($consulta);
   /* $consulta = "DELETE FROM Entrenamiento_has_Ejercicio WHERE idEjercicio ='".$ejercicio->getIdEjercicio()."' ";
    $connect->query($consulta);
   */
  }


  public function buscarId($id){
    global $connect;
		$consulta = "SELECT * FROM Ejercicio WHERE idejercicio ='". $id ."'";
		$resultado = $connect->query($consulta);
		$current = mysqli_fetch_assoc($resultado);
		$ejercicio = new Ejercicio($current["nombreejercicio"],$current["Usuario_nombreusuario"],$current["descripcionejercicio"], $current["idejercicio"]);
		return $ejercicio;
  }
}
?>
