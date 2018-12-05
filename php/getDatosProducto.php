<?php
include "conexion.php";
$id = $_POST['id'];
$r = $db->query("select id, nombre, precio, id_categoria, descripcion, stock, imagen from Productos where id = $id");
while($row = $r ->fetch_assoc()){
  echo json_encode($row);

}

 ?>
