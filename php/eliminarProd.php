<?php
session_start();
if(!isset($_SESSION['usario'])) {
  header('Location: ../login.php?error=acceso denegado');
}
include './conexion.php';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $db->query("delete from Productos where id = $id");
  if($db->error) {
    header("Location: ../admin/productos.php?error=".$db->error);
  }
  header("Location: ../admin/productos.php");
}
 ?>
