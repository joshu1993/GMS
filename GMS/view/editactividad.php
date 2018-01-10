


<?php
require_once("../core/ConectionBD.php");
require_once("../controller/UsersController.php");
require_once("../controller/ActividadesController.php");


if(!isset($_SESSION)) session_start();
$ucontroler = new UsersController();
$acontroler = new ActividadesController();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['nombreusuario']);
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

<h1><?= i18n("Modificar Actividad") ?></h1>

<?php
			include("default.php");
			
				if(isset($_GET['idactividad'])){
				$idactividad = $_GET['idactividad'];
				$actividad = $acontroler->buscarActividadById($idActividad);
				}
			?>


	<form action="index.php?controller=actividades&amp;action=edit" method="POST">
	<div class='form'>
		<?= i18n("Nombre") ?>: <input type="text" name="nombreactividad"
		value="<?= isset($_POST["nombreactividad"])?$_POST["nombreactividad"]:$actividad->getnombreactividad() ?>">
		<?= isset($errors["nombreactividad"])?i18n($errors["nombreactividad"]):"" ?><br>

		<?= i18n("Descripcion") ?>: <br>
		<textarea name="descripcionactividad" rows="4" cols="50"><?=
		isset($_POST["descripcionactividad"])?
		htmlentities($_POST["descripcionactividad"]):
		htmlentities($actividad->getdescripcionactividad())
		?></textarea>
		<?= isset($errors["descripcionactividad"])?i18n($errors["descripcionactividad"]):"" ?><br>
		
		<?= i18n("horario") ?>: <input type="text" placeholder = "YYYY-MM-DD HH:MM:SS" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}" name="horario" class="input" required="true"
		value="<?= isset($_POST["horario"])?$_POST["horario"]:$actividad->gethorario() ?>">
		<?= isset($errors["horario"])?i18n($errors["horario"]):"" ?><br>

		<?= i18n("capacidad") ?>: <input type="text" name="capacidad"
		value="<?= isset($_POST["capacidad"])?$_POST["capacidad"]:$actividad->getcapacidad() ?>">
		<?= isset($errors["capacidad"])?i18n($errors["capacidad"]):"" ?><br>
		
		<?= i18n("tipoActividad") ?>: <input type="text" name="tipoActividad"
		value="<?= isset($_POST["tipoActividad"])?$_POST["tipoActividad"]:$actividad->gettipoActividad() ?>">
		<?= isset($errors["tipoActividad"])?i18n($errors["tipoActividad"]):"" ?><br>
	</div>
	
		<input type="submit" name="submit" value="<?= i18n("Modificar actividad") ?>">
	</form>
