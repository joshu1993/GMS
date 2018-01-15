<?php

require_once(__DIR__."/../core/ValidationException.php");


class User {

	private $nombreusuario;

	private $nombre;

	private $contraseña;

	private $correo;

	private $tipousuario;



	public function __construct($nombreusuario=NULL, $nombre=NULL, $contraseña=NULL, $correo=NULL, $tipousuario=NULL) {
		$this->nombreusuario = $nombreusuario;
		$this->nombre = $nombre;
		$this->contraseña = $contraseña;
		$this->correo = $correo;
		$this->tipousuario = $tipousuario;
	}

	public function getUsername() {
		return $this->nombreusuario;
	}

	public function getName(){
		return $this->nombre;
	}

	public function getPassword() {
		return $this->contraseña;
	}

	public function getMail() {
		return $this->correo;
	}

	public function getUserType() {
		return $this->tipousuario;
	}

	public function setUsername($nombreusuario) {
		$this->nombreusuario = $nombreusuario;
	}

	public function setName(){
		$this->nombre = $nombre;
	}

	public function setPassword($contraseña) {
		$this->contraseña = $contraseña;
	}

	public function setMail($correo) {
		$this->correo = $correo;
	}

	public function setUserType($tipousuario) {
		$this->tipousuario = $tipousuario;
	}

	public static function getbyUsername($nombreusuario){
			  $mapper = UserMapper::find($nombreusuario);

			  return new User($mapper["nombreusuario"],$mapper["nombre"],$mapper["contraseña"],$mapper["correo"],$mapper["tipousuario"]);

		  }
/*
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->nombreusuario) < 5) {
			$errors["nombreusuario"] = "username is not valid";

		}

		if (strlen($this->nombre) < 5) {
			$errors["nombre"] = "name is not valid";
		}
		if (strlen($this->contraseña) < 5) {
			$errors["contraseña"] = "password is not valid";
		}
		if (strlen($this->correo) <3) {
			$errors["correo"] = "email is not valid";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "User is not valid");
		}
	}

	public function checkIsValidForUpdate() {
		$errors = array();

		if (!isset($this->nombreusuario)) {
			$errors["nombreusuario"] = "username is not valid";
		}

		try{
			$this->checkIsValidForRegister();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "username is not valid");
		}
	}
	*/

}
