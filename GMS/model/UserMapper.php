	<?php
	require_once(__DIR__."/../core/ConnectionBD.php");

	class UserMapper {

		public static function find($nombreusuario){
			global $connect;
			$consulta = "SELECT * FROM Usuario WHERE nombreusuario='". $nombreusuario ."'";
			$resultado = $connect->query($consulta);

			return mysqli_fetch_assoc($resultado);
		}

		public function findByUsername($nombreusuario){
			global $connect;
			$consulta = "SELECT * FROM Usuario WHERE nombreusuario='". $nombreusuario ."'";
			$resultado = $connect->query($consulta);
			$current = mysqli_fetch_assoc($resultado);
			$entrenador = new Usuario($current["nombreusuario"],$current["nombre"],$current["contraseña"],$current["correo"],$current["tipousuario"]);
			return $entrenador;
		}

		function listarEntrenadores (){
			global $connect;
			$consulta ="SELECT * FROM Usuario WHERE tipousuario = 'entrenador' ORDER BY nombre";
			$resultado = $connect->query($consulta);
			$listaEntrenadores = array();
			while ($actual = mysqli_fetch_assoc($resultado)) {

				$entrenador = new Usuario($current["nombreusuario"],$current["nombre"],$current["contraseña"],$current["correo"],$current["tipousuario"]);
				array_push($listaEntrenadores, $entrenador);
			}
			return $listaEntrenadores;

		}

		public function save(User $user) {
			global $connect;
			$consulta= " INSERT INTO Usuario (nombreusuario, nombre, Usuario_nombreusuario, contraseña, correo, tipousuario) VALUES ('". $usuario->getUsername() ."',
			'". $_SESSION["nombreusuario"] ."', '". $usuario->getName() ."', '". $usuario->getPassword() ."' ,'". $usuario->getMail() ."' ,'". $usuario->getUserType() ."')";
			$connect->query($consulta);	}

			public function update($user, $nombreAntiguo) {
				global $connect;
				$consulta= "UPDATE Usuario SET nombreusuario='". $usuario->getUsername() ."' ,nombretabla='". $usuario->getName() ."', contraseña='". $usuario->getPassword() ."', correo='". $usuario->getMail(). "' WHERE Dni='". $nombreAntiguo ."'";
				$connect->query($consulta);
			}

			public function delete($nombreusuario) {
				global $connect;
	    $consulta = "DELETE FROM Usuario WHERE nombreusuario='". $nombreusuario ."'" ;
	    $connect->query($consulta);
			}

			public function usernameExists($nombreusuario)
				{
					global $connect;
					$consulta = "SELECT * FROM Usuario WHERE nombreusuario='". $nombreusuario ."'";
					$resultado = $connect->query($consulta);
			 		$filas = mysqli_num_rows($resultado);
			 		if($filas > 0)
			  			return true;
				}

				public function isValidUser($nombreusuario, $contraseña)
				{
					global $connect;
					$consulta = "SELECT COUNT(nombreusuario) FROM Usuario WHERE nombreusuario='". $nombreusuario ."' , Usuario_nombreusuario='". $contraseña ."'";
					$connect->query($consulta);

					if($connect->fetchColumn() > 0)
						return true;

				}


		}
