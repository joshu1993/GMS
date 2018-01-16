<?php
require_once("../core/ConnectionBD.php");
require_once("../controller/UsersController.php");
require_once("../controller/DeportistasController.php");

if(!isset($_SESSION)) session_start();
global $nombreusuario;

if(isset($_GET['nombreusuario'])){
  $nombreusuario = $_GET['nombreusuario'];
}
$ucontroler = new UsersController();
$usuarioActual =  $ucontroler->getcurrentUser($_SESSION['nombreusuario']);
if($_SESSION['tipousuario'] != "administrador"){
  header("Location: error.php");
  exit();
}

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
           $lang="es";
       }

?>

<h1><?= i18n("Eliminar Entrenador") ?></h1>

<?php
			include("default.php");

				 $user = $acontroler->buscarDeportista($nombreusuario);
				}
			?>


	  <strong>¿<?php echo __('¿Está seguro que quiere eliminar a este usuario?', $lang);?></strong>

          <form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=DesportistasController&amp;accion=eliminarDeportista" method="post" >
	<div class='form'>
			  <label><?php echo __('nombreusuario',$lang);?>: <?php echo $deportista->getUsername(); ?></label>
               <br/>
               <label><?php echo __('nombre',$lang);?>: <?php echo $deportista->getName(); ?></label>
                <br/>
              <label><?php echo __('correo',$lang);?>: <?php echo $deportista->getMail(); ?></label>
               <br/>
              <label><?php echo __('Tipo Deportista',$lang);?>: <?php echo $deportista->getTipo(); ?></label>
               <br/>

	</div>

		<input type="submit" name="submit" value="<?= i18n("Eliminar Deportista") ?>">
	</form>
