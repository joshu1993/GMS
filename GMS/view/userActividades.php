<?php
require_once("../controller/ActividadesController.php");

$acontroler = new ActividadesController();

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

    <title> Actividades - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/desplegarMenu.js"></script>
		<script src="js/confirmacionEliminar.js"></script>

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

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-logo" href="../index.php"><img class="img-logo" src="img/logo.png" alt="logo"/></a>
                <?php
                if($lang == "es"){
					echo '<a class="idiomaEN" href="userActividades.php?lang=en"><img class="img-ID" src="img/EN.png" alt="Ingles"/></a>';
				}else{
					echo '<a class="idiomaESP" href="userActividades.php?lang=es"><img class="img-ID" src="img/ES.png" alt="Español"/></a>';
				}
				?>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"> <?php echo __('Entrar',$lang); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                        <div class="col-lg-12">
                            <div class="text-center"><h3><b><?php echo __('Entrar',$lang); ?></b></h3></div>
                                <div class="form-group">
                                  <form action="../controller/controller.php?lang=<?php echo $lang; ?>&controller=UsersController&amp;accion=login" method="post">
                                    <label for="nombreusuario">nombreusuario</label>
                                    <input type="text" name="nombreusuario" id="nombreusuario" tabindex="1" class="form-control" placeholder="<?php echo __('nombre del usuario',$lang); ?>" value="" autocomplete="off">
                                    <label for="password"><?php echo __('Contraseña',$lang); ?></label>
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="<?php echo __('Contraseña',$lang); ?>" autocomplete="off">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In">
                                  </form>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <input type="checkbox" tabindex="3" name="remember" id="remember">
                                            <label for="remember"> <?php echo __('Recordarme',$lang); ?> </label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6">
                        </div>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>


        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                <strong><?php echo __('Actividades',$lang); ?></strong>
            </div>
            <div class="listado">
                <div class="header_lista">
                    <div class="titulo_lista">
                    <h1><?php echo __('Lista de Actividades',$lang); ?> </h1>
                    </div>
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="<?php echo __('Buscar Actividad',$lang); ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
				<?php

				$arrayActividades = $acontroler->listarActividades();
				foreach ($arrayActividades as $actividad ){
				?>
				<ul>
					<div class="bloque_lista">
						<div class="titulo_bloque">
								<h1> <?php echo $actividad->getnombreActividad(); ?><h1>
							</a>
						</div>
						<div class="info_bloque">
							<p> <?php echo __('Horario',$lang); ?> : <?php echo $actividad->gethorario(); ?></p>
							<p> <?php echo __('Tipo de actividad',$lang); ?> : <?php echo $actividad->gettipoActividad(); ?></p>
							<p> <?php echo __('Capacidad',$lang); ?>: <?php echo $actividad->getcapacidad(); ?></p>

						</div>

					</div>
                 </ul>
				<?php }	?>
            </div>
        </div>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
