<?php

if(!isset($_SESSION)) session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Index  - Ufitness</title>

    <link href="view/css/style.css" rel="stylesheet">

    <link href="view/css/carousel.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="view/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="view7css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="view/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="view/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="menuppl">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-logo" href="index.php"><img class="img-logo" src="view/img/logo.png" alt="logo"/></a>
            </div>
            <!-- Top Menu Items -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"> Entrar <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Entrar</b></h3></div>
                                    <div class="form-group">
                                      <form action="controller/controller.php?controller=UsersController&amp;accion=login" method="post">
                                        <label for="username">Nombre de usuario</label>
                                        <input type="text" name="nombreusuario" id="nombreusuario" tabindex="1" class="form-control" placeholder="nombre del usuario" value="" autocomplete="off">
                                        <label for="password">Contraseña</label>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña" autocomplete="off">
                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In">
                                      </form>
                                    </div>

                                   

                                    <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6">
                            </div>
                        </ul>
                    </li>
                </ul>
        </nav>
    </div>

    
    <!-- jQuery -->
    <script src="view/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="view/js/bootstrap.min.js"></script>



</body>


</html>



