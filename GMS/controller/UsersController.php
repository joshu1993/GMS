<?php
require_once("../model/User.php");
require_once("../model/UserMapper.php");
require_once("../core/connectionBD.php");

class UsersController{

		private $userMapper;

		public function __construct()
		{
			$this->userMapper = new UserMapper();
	}


public static function login(){
	
		global $connect;
		$usuario = $_POST['nombreusuario'];
		$contraseña = $_POST['contraseña'];
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		} else {
			$lang = "es";
		}
		if(empty($usuario) || empty($contraseña)){
			header("Location: ../index.php?lang=$lang");
			
			exit();
		}
		$consulta = "SELECT * FROM Usuario WHERE nombreusuario='". $usuario."'";
		$resultado = $connect->query($consulta);
		if($row = mysqli_fetch_assoc($resultado)){
			if($row['contraseña'] == $contraseña){
			session_start();
			$_SESSION['nombreusuario'] = $usuario;
			$_SESSION['tipousuario'] = $row['tipousuario'];
			
			header("Location: ../view/adminIndex.php?lang=$lang");
			
			}else{
				header("Location: ../index.php?lang=$lang");
			
				exit();
			}
		}else{
			header("Location: ../index.php?lang=$lang");
		
			exit();
		}
	}

	public static function logout(){
			if(!isset($_SESSION)) session_start();
			session_destroy();
			if (isset($_SESSION['lang'])) {
				$lang = $_SESSION['lang'];
			} else {
				$lang = "es";
			}
			header("Location: ../index.php?lang=$lang");
		}

		public static function getcurrentUser($nombreusuario){
			return User::getbyUsername($nombreusuario);
		}

		public function listarEntrenadores()
		{
			return $this->usuarioMapper->listarEntrenadores();
		}

		public static function searchByUsername($nombreusuario){
			return $this->userMapper->findByUsername($nombreusuario);
		}

//REGISTRO
public static function register()
		{
    		$userMapper = new UserMapper();
    		if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
			} else {
				$lang = "es";
			}

		    if(isset($_POST["nombreusuario"]))
		    {

			    $user = new User($_POST["nombreusuario"],$_POST["nombre"],$_POST["contraseña"],$_POST["correo"],"entrenador");

			     	try{
			     		if (!$userMapper->usernameExists($user->getUsername()))
			     		{
				      		$userMapper->save($user);
				      		header("Location: ../view/adminEntrenadores.php?lang=$lang");
						}
						else
						{
							echo '<script language="javascript">alert("'.__('Ya existe un entrenador con el mismo nombre.',$lang).'"); window.location.href="../view/adminEntrenadores.php?lang=$lang";</script>';
				      	}

		      	}catch(ValidationException $ex)
		      	{
		      		$errors = $ex->getErrors();
		     	}
			}
		}



	public function edit() {
			$usuarioMapper = new UserMapper();
			$nombreusuario = $_POST["nombreusuario"];
			$nombre = $_POST["nombre"];
			$nombreadmin = $_POST["nombreAdmin"];
			$nombreAntiguo = $_POST["nombreAntiguo"];
			$contraseña = $_POST["contraseña"];
			$correo = $_POST["correo"];

		    if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
			} else {
				$lang = "es";
			}

			$user = new User($nombreusuario,$nombre,$contraseña,$correo,"entrenador");

			$userMapper->update($user,$nombreAntiguo);
			header("Location: ../view/adminEntrenadores.php?lang=$lang");
		}


	public function delete() {
		$nombreusuario = $_POST["nombreusuario"];
		//$nombreusuario = $this->usuarioMapper->find($nombreusuario);
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		} else {
			$lang = "es";
		}

		$userMapper = new UserMapper();
		$userMapper->delete($nombreusuario);

	    header("Location: ../view/adminEntrenadores.php?lang=$lang");
	}
}
