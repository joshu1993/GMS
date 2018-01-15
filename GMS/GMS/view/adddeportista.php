<?php
require_once("../core/connectionBD.php");
require_once("../controller/UsersController.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new UsersController();
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

    <title> Nuevo Deportista - Ufitness</title>

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
    <div id="wrapper">
			<?php
			include("navbar.php");
			include("wrapper.php");
			?>

      <h1><?= i18n("Registro")?></h1>
<div class=crearEjercicio>
<form action="index.php?controller=users&amp;action=register" method="POST">
	<?= i18n('Nombre de usuario', $lang)?>: <input type="text" name="nombreusuario"
	value="<?= $user->getUsername() ?>">
	<?= isset($errors["nombreusuario"])?i18n($errors["nombreusuario"]):"" ?><br>
  <?= i18n("Contraseña")?>: <input type=password name="contraseña" required="true"
	value="<?= $user->getPassword() ?>">
	<?= isset($errors["contraseña"])?i18n($errors["contraseña"]):"" ?><br>
              <?php echo __('Tipo Deportista',$lang); ?>: <select name="tipo" class="select">
			                                            <option value="tdu" selected>TDU</option>
			                                            <option value="pef">PEF</option>
            																	 </select>
							<div class="form_submit">
								<input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Registrar',$lang); ?>">
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
