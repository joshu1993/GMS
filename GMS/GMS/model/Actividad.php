
<?php

require_once(__DIR__."/../core/ValidationException.php");

class Actividad {

    private $idactividad;
    private $nombreactividad;
    private $descripcionactividad;
	private $horario;
    private $capacidad;
	private $tipoActividad;
	

    public function __construct($nombreactividad, $descripcionactividad,$horario,
		$capacidad, $tipoActividad,$idactividad=NULL) {

		$this->idactividad = $idactividad;
        $this->nombreactividad = $nombreactividad;
        $this->descripcionactividad = $descripcionactividad;
        $this->horario = $horario;
        $this->capacidad = $capacidad;
		$this->tipoActividad= $tipoActividad;

    }

		/*-------------------------- GET DE CADA ATRIBUTO ----------------------------------------*/


		/* FALTAN LOS GETTERS DE LOS IDS*/
	public function getidactividad (){
       
        return $this->idactividad;
    }

	public function getnombreactividad (){
      
        return $this ->nombreactividad;
    }
	
	public function setnombreactividad ($nombreactividad){
      
        $this ->nombreactividad= $nombreactividad;
    }

    public function getdescripcionactividad (){
       

        return $this ->descripcionactividad;
    }
	
	public function setdescripcionactividad ($descripcionactividad){
       
		$this ->descripcionactividad= $descripcionactividad;
    }

	
    public function gethorario (){
       
        return $this ->horario;
    }
	

    public function getcapacidad (){

        return $this ->capacidad;
    }
	
	public function setcapacidad ($capacidad){

        $this ->capacidad=$capacidad;
    }
	 public function gettipoActividad (){

        return $this ->tipoActividad;
    }
	
	//comprueba los datos nuevos
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->nombreactividad)) == 0 ) {
			$errors["nombreactividad"] = "la actividad tiene que tener nombre";
		}
		if (strlen(trim($this->descripcionactividad)) == 0 ) {
			$errors["descipcionactividad"] = "la actividad tiene que tener descripcion";
		}
		if ($this->capacidad == 0 ) {
				$errors["numPlazas"] = "La actividad debe tener al menos 1 plaza.";
		}
		if (strlen(trim($this->tipoActividad)) == 0 ) {
				$errors["tipoActividad"] = "La actividad debe tener tipo.";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, " actividad no es valida");
		}
	}
	
	
	//comprobar datos de modificacion
	public function checkIsValidForUpdate() {
		$errors = array();

		if (!isset($this->idactividad)) {
			$errors["idactividad"] = "idactividad is mandatory";
		}

		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "actividad no es valida");
		}
	}

		
}

?>
