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
$acontroler = new DeportistasController();
$usuarioActual =  $ucontroler->getcurrentUser($_SESSION['nombreusuario']);
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

<h1><?= i18n("Eliminar Entrenador") ?></h1>

<?php
			include("default.php");

				 $user = $acontroler->searchByUsername($nombreusuario);
				}
			?>


	  <strong>¿<?php echo __('¿Está seguro que quiere eliminar a este deportista?', $lang);?></strong>

          <form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=UsersController&amp;accion=eliminarEntrenador" method="post" >
	<div class='form'>
			  <label><?php echo __('nombreusuario',$lang);?>: <?php echo $usuario->getUsername(); ?></label>
               <br/>
               <label><?php echo __('nombre',$lang);?>: <?php echo $usuario->getName(); ?></label>
                <br/>
              <label><?php echo __('correo',$lang);?>: <?php echo $usuario->getMail(); ?></label>
               <br/>

	</div>

		<input type="submit" name="submit" value="<?= i18n("Eliminar Entrenador") ?>">
	</form>
