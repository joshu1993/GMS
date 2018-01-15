<?php

require_once("../core/connectionBD.php");
//require_once("../resources/languages.php");

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
	   }

     switch($_SESSION['tipoUsuario']){
				case "administrador":
				echo '
			<div id="menuppl">
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="menu_lat">
                        <a href="adminActividades.php?lang='.$lang.'"><i class="fa fa-futbol-o" aria-hidden="true"></i> '.__('Actividades',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminTablas.php?lang='.$lang.'"><i class="fa fa-trophy" aria-hidden="true"></i> '.__('Tablas',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminEjercicios.php?lang='.$lang.'"><i class="fa fa-bicycle" aria-hidden="true"></i></i> '.__('Ejercicios',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminEntrenadores.php?lang='.$lang.'"><i class="fa fa-users" aria-hidden="true"></i> '.__('Entrenadores',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminDeportistas.php?lang='.$lang.'"><i class="fa fa-users" aria-hidden="true"></i> '.__('Deportistas',$lang).' </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>



    </div>';
    break;

    case "entrenador":

    echo '
				<div id="wrapper">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="menu_lat">
                        <a href="adminActividades.php?lang='.$lang.'"><i class="fa fa-futbol-o" aria-hidden="true"></i> '.__('Actividades',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminTablas.php?lang='.$lang.'"><i class="fa fa-trophy" aria-hidden="true"></i> '.__('Tablas',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminEjercicios.php?lang='.$lang.'"><i class="fa fa-bicycle" aria-hidden="true"></i></i> '.__('Ejercicios',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminDeportistas.php?lang='.$lang.'"><i class="fa fa-users" aria-hidden="true"></i> '.__('Deportistas',$lang).' </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


    </div>';
    break;

    case "deportista":

    echo '
				<div id="menuppl">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="menu_lat">
                        <a href="adminActividades.php?lang='.$lang.'"><i class="fa fa-futbol-o" aria-hidden="true"></i> '.__('Actividades',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="deportistaEntrenamientos.php?lang='.$lang.'"><i class="fa fa-trophy" aria-hidden="true"></i> '.__('Entrenamientos',$lang).' </a>
                    </li>
                    <li id="menu_lat">
                        <a href="adminEjercicios.php?lang='.$lang.'"><i class="fa fa-bicycle" aria-hidden="true"></i></i> '.__('Ejercicios',$lang).' </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->



    </div>';
    break;


    } ?>
