<?php

class Notificacion
{
	public $idnotificacion;
	public $emisor;
	public $titulo;
	public $mensaje;

	function __construct($idnotificacion=NULL,$emisor,$titulo,$mensaje){
		$this ->idnotificacion = $idnotificacion;
		$this ->emisor = $emisor;
		$this ->titulo = $titulo;
		$this ->mensaje = $mensaje;
	}


	public function getIdnotificaion (){
		return $this ->idnotificacion;
	}

	public function getEmisor (){
		return $this ->emisor;
	}

	public function getTitulo (){
		return $this ->titulo;
	}

	public function getMensaje(){
		return $this ->mensaje;
	}

}

?>
