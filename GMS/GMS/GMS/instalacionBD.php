<?php
$gymGMS = file_get_contents("gymGMS.sql");
$servername = "localhost";
$username = "root";
$password = "root";
// Create connection
global  $conection;
$conection = new mysqli($servername, $username, $password);
// Check connection
if ($conection->connect_error) {
    die("Connection failed: " . $conection->connect_error);
}
// Create database
$sql = "DROP DATABASE gymGMS";
$conection->query($sql);
$sql = "CREATE DATABASE gymGMS";
if ($conection->query($sql) === TRUE) {
    echo "La base de datos ha sido creada correctamente";
    $gymGMS .= $data;
    doQuery($gymGMS);
} else {
    echo "Error al crear la BD: " . $conection->error;
}
$conection->close();

function doQuery($query){
  global $conection;
  $result =$conection->multi_query($query);
  if(!$result){
    die("Error en la consulta: ".$conection->error);
  }
  return $result;
}

?>
