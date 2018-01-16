<?php

class NotificacionDeportista{

	public $idnotificacion;
	public $receptor;

	function __construct($idnotificacion, $receptor){
		$this ->idnotificacion = $idnotificacion;
		$this ->receptor = $receptor;
	}


	public function getId (){
		return $this ->idnotificacion;
	}

	public function getReceptor (){
		return $this ->receptor;
	}

}

?>
