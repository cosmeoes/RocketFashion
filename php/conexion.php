<?php
  $usuario = "root";
  $pass = "";
  $servidor = "localhost";
  $database = "RocketFashion";

  $db = mysqli_connect($servidor, $usuario, $pass, $database);
  if(mysqli_connect_error()){
    die("No se pudo conectar: ".mysqli_connect_error());
  }


?>
