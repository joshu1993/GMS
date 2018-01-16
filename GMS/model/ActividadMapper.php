<?php
// file: model/ExerciseMapper.php
require_once(__DIR__."/../core/ConnectionBD.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Actividad.php");


class ActividadMapper {


	public function listarActividades() {
		
		global $connect;
		
		$consulta= $connect->query("SELECT * FROM actividad");
	

		$listaActividades = array();
		while ($current = mysqli_fetch_assoc($consulta)) {

      $actividad = new Actividad ($current["nombreactividad"], $current["descripcionactividad"], $current["horario"], $current["capacidad"],
      $current["tipoActividad"], $current["idactividad"]);
			array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}
	
	 public function listarActividadesIndividuales (){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad where tipoActividad='Individual'");
		$listaActividades = array();
		while ($current = mysqli_fetch_assoc($consulta)) {

       $actividad = new Actividad ($current["nombreActividad"], $current["descripcionActividad"], $current["horario"], $current["capacidad"],
	   $current["tipoActividad"], $current["idActividad"]);
			array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}

	public function listarActividadesGrupo (){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad where tipoActividad='Grupo'");
		$listaActividades = array();
		while ($current = mysqli_fetch_assoc($consulta)) {

       $actividad = new Actividad ($current["nombreActividad"], $current["descripcionActividad"], $current["horario"], $current["capacidad"],
       $current["tipoActividad"], $current["idActividad"]);
			array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}
	
	public function getActividad ($idActividad){
			global $connect;
			$consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad = $idActividad");
      $current = mysqli_fetch_assoc($consulta);

      $actividad = new Actividad ($current["nombreActividad"], $current["descripcionActividad"], $current["horario"], $current["capacidad"],
       $current["tipoActividad"], $current["idActividad"]);

		return $actividad;
	}
	/*
	 public function registrarActividad ($actividad, $idactividad){
		global $connect;
		$consulta = $connect->query("SELECT idactividad FROM Actividad WHERE idactividad ='" .$idactividad. "'");
		$resultado = mysqli_fetch_assoc($consulta);
		$sql = " INSERT INTO Actividad ( nombreactividad, descripcionactividad, horario, capacidad, tipoActividad)
		VALUES ('". $resultado['idactividad'] ."','". $actividad->getnombreactividad() ."', '". $actividad->getdescripcionactividad() ."', '". $actividad->gethorario() ."', '". $actividad->getcapacidad() ."', '". $actividad->gettipoActividad() ."')";
		$connect->query($sql);
			
	}
	
	*/
	
	public function eliminarActividad ($idActividad){
    global $connect;
		$connect->query("DELETE FROM Actividad WHERE idActividad = $idActividad");
	}
	
	
	public function findAllActividades() {
		$stmt = $this->db->query("SELECT * FROM Actividad");
		$actividades_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$actividades = array();
		foreach ($actividades_db as $actividad) {
			array_push($actividades, new Actividad($actividad["nombreActividad"], $actividad["descripcionActividad"], $actividad["horario"], $actividad["capacidad"], $actividad["tipoActividad"]));
		}
		return $actividades;
	}

	



	public function findActividadById($actividadid){
		
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad='" .$actividadid. "'");
		$actividad = mysqli_fetch_assoc($consulta);

		if($actividad != null) {
			return new Actividad(
			$actividad["idactividad"],
			$actividad["nombreactividad"],
			$actividad["descripcionactividad"],
			$actividad["dia"],
			$actividad["hora"],
			$actividad["capacidad"]
			);
		} else {
			return NULL;
		}
	}
	
	
	/*
	public function findByName($actividadName){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad WHERE nombreActividad='" .$actividadName. "'");
		$actividad = mysqli_fetch_assoc($consulta);

		if($actividad != null) {
			return new Actividad(
			$actividad["idactividad"],
			$actividad["nombreactividad"]);
		} else {
			return NULL;
		}
	}
	*/
	
	
	public function apuntarUsuarioActividad($nombreusuario,$actividadid){
		$stmt = $this->db->prepare("INSERT INTO Usuario_apunta_Actividades(Usuario_nombreusuario, Actividad_idactividad) values (?,?)");
		$stmt->execute(array($nombreusuario,$actividadid));
	}

	public function findUsuariosActividad($idActividad){
		$stmt = $this->db->prepare("SELECT Usuario_nombreusuario FROM Usuario_apunta_Actividades WHERE Actividad_idactividad=?");
		$stmt->execute(array($idActividad));
		$nombreusuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


		$usuarios_array = array();
		if(sizeof($nombreusuarios) > 0){
			foreach ($nombreusuarios as $usuarionombre) {

				$stmt = $this->db->prepare("SELECT * FROM usuario WHERE nombreusuario=?");
				$stmt->execute(array($nombreusuarios[0]["Usuario_nombreusuario"]));
				$user = $stmt->fetch(PDO::FETCH_ASSOC);

				if($user != null) {
					$user = new User(
					$user["nombreusuario"],
					$user["contraseña"],
					$user["correo"],
					$user["tipousuario"]);

					array_push($usuarios_array, $user);
				}
					array_splice($nombreusuarios , 0 ,1);
			}
		}

		return $usuarios_array;

	}





		public function save(Actividad $actividad) {
			$stmt = $this->db->prepare("INSERT INTO actividad(nombreactividad, descripcionactividad, horario, capacidad, tipoActividad) values (?,?,?,?,?)");
			$stmt->execute(array($actividad->getnombreactividad(), $actividad->getdescripcionactividad(), $actividad-> gethorario(), $actividad->getcapacidad(), $actividad->getipoActividad()));
			return $this->db->lastInsertId();
		}


		public function update(Actividad $actividad) {
			$stmt = $this->db->prepare("UPDATE actividad set nombreactividad=?, descripcionactividad=?, horario=?, capacidad=?, tipoActividad=? where idactividad=?");
			$stmt->execute(array($actividad->getnombreactividad(), $actividad->getdescripcionactividad(), $actividad-> gethorario(), $actividad->getcapacidad(), $actividad->getipoActividad(), $actividad->getidactividad()));
		}

		public function delete(Actividad $actividad) {
			$stmt = $this->db->prepare("DELETE from actividad WHERE idactividad=?");
			$stmt->execute(array($actividad->getIdactividad()));
		}
		
		public function deleteUsuariosFromActividad(Actividad $actividad) {
			$stmt = $this->db->prepare("DELETE from Usuario_apunta_Actividades WHERE Actividad_idactividad=?");
			$stmt->execute(array($actividad->getId()));
		}

		public function deleteUsuarioFromActividad(User $usuario, Actividad $actividad) {
			$stmt = $this->db->prepare("DELETE from Usuario_apunta_Actividades WHERE Usuario_nombreusuario=? AND Actividad_idactividad=?");
			$stmt->execute(array($usuario->getUsername(),$actividad->getidactividad()));
			
		}
		
		
		public function reservar($idActividad,$usuarioActual){
	   global $connect;
	   $consulta = "SELECT capacidad FROM Actividad WHERE idActividad ='" .$idActividad. "'" ;
	   $resultado= $connect->query($consulta);
	   $plazas = mysqli_fetch_assoc($resultado);
	   $query = "SELECT count(idReserva) FROM Reserva WHERE Usuario_nombreusuario = '".$usuarioActual."' and Actividad_idactividad ='".$idActividad."'";
	   $result = $connect->query($query);
	   $existe = mysqli_fetch_assoc($result);

		if($plazas['capacidad'] == 0){
				echo '<script language="javascript">alert("No quedan plazas disponibles para esta actividad");</script>';
		}else if($existe['count(idReserva)'] != 0 ){
			echo '<script language="javascript">alert("Ya tienes una plaza reservada en esta actividad");</script>';
			}else{
				$plazasRestantes = $plazas['capacidad'] - 1;
				$plazasOcupadas = 0;
				$plazasOcupadas++;
				mysqli_query($connect,"UPDATE Actividad SET capacidad = '" .$plazasRestantes. "' WHERE idactividad ='" .$idActividad. "'");
				mysqli_query($connect,"INSERT INTO Reserva(Usuario_nombreusuario,Actividad_idactividad,fecha,plazas_ocupadas) VALUES('" .$_SESSION['nombreusuario']."', '" .$idactividad."', '" .date("Y-m-d")."', '" .$plazasOcupadas."')");
				echo '<script language="javascript">alert("Has reservado plaza en esta actividad");window.location.href="../view/adminActividades.php";</script>';
			}
		
	}
		
		

	}
