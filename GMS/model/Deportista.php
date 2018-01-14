<?php
require_once("User.php");
require_once("../resources/ValidationException.php");
class Deportista extends User {

	public $tipo;

	function __construct($nombreusuario,$contraseña,$email,$tipousuario,$tipodeportista)
	{
		parent::__construct($nombreusuario,$contraseña,$email,$tipousuario);
		$this ->tipo = $tipodeportista;
	}

	public function getTipo (){
		return $this ->tipo;
	}

	public function setTipo ($tipodeportista){
		$this ->tipo = $tipodeportista;
	}

	public function checkIsValid() {
			$errors = array();

			if(!(strcasecmp ($this->tipo , "PEF" )==0) || !(strcasecmp ($this->tipo , "TDU" )==0)){
				$errors["tipo"] = "Error. El tipo debe ser TDU o PEF.";
			}

			if (sizeof($errors)>0){
				throw new ValidationException($errors, "Existen errores. No se puede registrar el deportista.");
			}
	}

}

?>
