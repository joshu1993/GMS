<?php
require_once("../core/connectionBD.php");
require_once("../controller/UsersController.php");
require_once("../controller/EjerciciosController.php");


if(!isset($_SESSION)) session_start();
$econtroler = new EjerciciosController();
$ucontroler = new UsersController();
$usuarioActual =  $ucontroler->getcurrentUser($_SESSION['nombreusuario']);
if($_SESSION['tipousuario'] != "administrador" && $_SESSION['tipousuario'] != "entrenador" && $_SESSION['tipousuario'] != "deportista"){
	header("Location: error.php");
	exit();
}

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
           $lang="es";
       }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Ejercicios - Ufitness</title>

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

    <!--JavaScript-->
    <script src="js/desplegarMenu.js"></script>
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
			include("Menuppl.php");
			?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-bicycle" aria-hidden="true"></i>
              <strong><?php echo __('Ejercicios',$lang); ?></strong>
            </div>
            <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1><?php echo __('Lista de Ejercicios',$lang); ?> </h1>
                </div>
								<?php if($_SESSION['tipousuario'] == "administrador" || $_SESSION['tipousuario'] == "entrenador"){?>
                <div class="anadir">
                  <a id="btn_anadir" href="addejercicio.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Añadir Ejercicio',$lang); ?></a>
                </div>
								<?php } ?>
              </div>
              <div class="body_pagina">
              
						<?php
								$ejercicios = $econtroler->listaEjercicios();
								 foreach ($ejercicios as $ejercicio) {
						?>
						<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> <?php echo $ejercicio->getnombreejercicio(); ?> <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción: <?php echo $ejercicio->getdescripcionejercicio(); ?></p>
                           
                          </div>
                         <?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                          <div class="opciones_bloque">
								<a id="btn_edit_bloque" href="../view/editejercicio.php?lang=<?php echo $lang; ?>&idejercicio=
								<?php echo $ejercicio->getidejercicio(); ?>" class="btn btn-primary" type="button">
								<i class="fa fa-edit" aria-hidden="true" title="<?php echo __('modificar',$lang); ?>"></i></a>
								<a id="btn_eliminar" href="deleteejercicio.php?lang=<?php echo $lang; ?>&idejercicio=
								<?php echo $ejercicio->getidejercicio(); ?>" class="btn btn-primary" type="button" title="
								<?php echo __('Eliminar',$lang); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
                        	</div>
					<?php } ?>
                      </ul>
                      <?php } ?>
              			</li>
              		</ul>
                </nav>
							


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
