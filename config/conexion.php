<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host="localhost";
$user="root";
$pass="";
$DDBB="restauranteReservas";
  
$conexion=new mysqli($host,$user,$pass,$DDBB);
if ($conexion->connect_error) {
die("error de conexion ". $conexion->connect_error);
}
?>
