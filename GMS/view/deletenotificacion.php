<?php
require_once("../core/ConnectionBD.php");
require_once("../controller/UsersController.php");
require_once("../controller/NotificacionesController.php");

if(!isset($_SESSION)) session_start();
global $id;

if(isset($_GET['idnotificacion'])){
  $id = $_GET['idnotificacion'];
}
$ucontroler = new UsersController();
$ncontroler = new NotificacionesController();
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

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Eliminar Notificacion - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Rubik|Quattrocento+Sans" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="Menuppl">
      <?php
      include("navbar.php");
      include("Menuppl.php");

      $notificacion = $ncontroler->notificacionId($id);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-futbol-o" aria-hidden="true"></i>
          <strong><?php echo __('¿Está seguro que quiere eliminar esta notificacion?',$lang); ?></strong>
        </div>
        <div >
          <form action="../controller/controller.php?lang=<?php echo $lang; ?>&controller=NotificacionesController&amp;accion=deleteNotificacion" method="post" class="formulario">
              <label><?php echo __('Título',$lang); ?>: <?php echo $notificacion->getTitulo(); ?></label>
               <br/>
              <label><?php echo __('Mensaje',$lang); ?> : <?php echo $notificacion->getMensaje(); ?></label>
               <br/>
              <input type="text" hidden="true" name="idNotificacion" value="<?php echo $id; ?>" />
              <div class="form_submit">
                <input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('SI',$lang); ?>">
                <a id="submit" href="adminIndex.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('NO',$lang); ?></a>
              </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
