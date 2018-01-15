<?php
require_once("User.php");
require_once(__DIR__."/../core/ValidationException.php");
class Deportista extends User {

	public $tipo;

	function __construct($nombreusuario, $nombre,$contraseña,$correo,$tipousuario,$tipodeportista)
	{
		parent::__construct($nombreusuario, $nombre,$contraseña,$correo,$tipousuario);
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
