<?php
require_once("../resources/ConnectionBD.php");
require_once("../controller/UsersController.php");
require_once("../controller/ActividadesController.php");

if(!isset($_SESSION)) session_start();
global $id;

if(isset($_GET['idactividad'])){
  $id = $_GET['idactividad'];
}
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

<h1><?= i18n("Eliminar Actividad") ?></h1>

<?php
			include("default.php");
			
				 $actividad = $acontroler->getActividad($id);
				}
			?>


	  <strong>¿<?php echo __('¿Está seguro que quiere eliminar esta actividad?', $lang);?></strong>
       
          <form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Actividad&amp;accion=eliminarActividad" method="post" >
	<div class='form'>
			  <label><?php echo __('Nombre',$lang);?>: <?php echo $actividad->getombreActividad(); ?></label>
               <br/>
              <label><?php echo __('descripcion',$lang);?>: <?php echo $actividad->getdescripcionactividad(); ?></label>
               <br/>
              <label><?php echo __('Horario',$lang);?>: <?php echo $actividad->getHorario(); ?></label>
               <br/>
              <label><?php echo __('capacidad',$lang);?>: <?php echo $actividad->getcapacidad(); ?></label>
              <br/>
              <label><?php echo __('Tipo de actividad',$lang);?>: <?php echo $actividad->gettipoActividad(); ?></label>
              <br/>
            
	</div>
	
		<input type="submit" name="submit" value="<?= i18n("EliminarActividad actividad") ?>">
	</form>
