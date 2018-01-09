<?php
require_once("../core/connectionBD.php");
require_once("../controller/ActividadController.php");
require_once("../controller/UsuarioController.php");


if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['nombreactividad']);
if($_SESSION['tipousuario'] != "administrador" && $_SESSION['tipousuario'] != "entrenador"){
	header("Location: error.php");
	exit();
}

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
           $lang="es";
       }

?>
<h1><?= i18n("Crear actividad")?></h1>

<form action="index.php?controller=actividades&amp;action=add" method="POST">
<div class='form'>
	<?= i18n("Nombre") ?>: <input type="text" name="nombreactividad"
	value="<?= $actividad->getnombreactividad() ?>">
	<?= isset($errors["nombreactividad"])?i18n($errors["nombreactividad"]):"" ?><br>

	<?= i18n("Descripcion") ?>: <br>
	<textarea name="descripcionactividad" rows="4" cols="50"><?=
	htmlentities($actividad->getdescripcionactividad()) ?></textarea>
	<?= isset($errors["descripcionactividad"])?i18n($errors["descripcionactividad"]):"" ?><br>

	<?= i18n("Horario") ?>:<input type="text" name="horario" value="<? =$actividad->gethorario() ?>">
    <input type="text" placeholder = "YYYY-MM-DD HH:MM:SS" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}" name="horario" class="input" required="true"/>
	<?= isset($errors["horario"])?i18n($errors["horario"]):"" ?><br>
	
	<?= i18n("capacidad") ?>: <input type="text" name="capacidad"
	value="<?= $actividad->getcapacidad() ?>">
	<?= isset($errors["capacidad"])?i18n($errors["capacidad"]):"" ?><br>
	
	<?= i18n("tipoActividad") ?>: <input type="text" name="tipoActividad"
	value="<?= $actividad->gettipoActividad() ?>">
	<?= isset($errors["tipoActividad"])?i18n($errors["tipoActividad"]):"" ?><br>
	

</div>
	<input type="submit" name="submit" value="crear">
</form>


