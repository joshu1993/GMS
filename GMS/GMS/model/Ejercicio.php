<?php

require_once(__DIR__."/../core/ValidationException.php");


class Ejercicio {


	private $idejercicio;

	private $nombreejercicio;

	private $usuario_nombreusuario;

	private $descripcionejercicio;



	function __construct($nombreejercicio, $usuario_nombreusuario, $descripcionejercicio, $idEjercicio = null)
	{
		$this ->idejercicio = $idejercicio;
		$this ->nombreejercicio = $nombreejercicio;
		$this ->usuario_nombreusuario = $usuario_nombreusuario;
		$this ->descripcionejercicio = $descripcionejercicio;
	

	}

	public function getidejercicio() {
		return $this->idejercicio;
	}


	public function getnombreejercicio() {
		return $this->nombreejercicio;
	}


	public function getusuarionombreusuario() {
		return $this->usuario_nombreusuario;
	}

	public function getdescripcionejercicio (){
		return $this ->descripcionejercicio;
	}

  	public function setdescripcionejercicio ($descripcionejercicio){
		$this ->descripcionejercicio = $descripcionejercicio;
	}
	


	public function checkIsValidForCreate() {
		$errors = array();

      if (strlen(trim($this->idejercicio)) == 0 ) {
				$errors["idejercicio"] = "El ID no es válido";
      }

      if (strlen(trim($this->nombreejercicio)) == 0 ) {
				$errors["nombreejercicio"] = "El Ejercicio debe tener nombre.";
      }

      if (strlen(trim($this->descripcionejercicio)) == 0 ) {
				$errors["descripcionejercicio"] = "El Ejercicio debe tener una descripcion.";
      }

      if (sizeof($errors) > 0){
				throw new ValidationException($errors, "Existen errores. No se puede crear el ejercicio.");
      }
  }


	public function checkIsValidForUpdate() {
		$errors = array();

		if (strlen(trim($this->idEjercicio)) == 0 ) {
			$errors["idejercicio"] = "id is mandatory";
		}

		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "exercise is not valid");
		}
	}
}
