<?php
session_start();
if(!isset($_SESSION['usario'])) {
  header('Location: ../login.php?error=acceso denegado');
}
include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['precio'])  && isset($_POST['stock'])  && isset($_POST['cate'])  && isset($_POST['desc'])) {
  if(isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
    $temp=explode(".",$_FILES['img']['name']);
    $extension = end($temp);
    $mime = $_FILES['img']['type'];
    if($mime == 'image/jpg' || $mime == 'image/jpeg' || $mime == 'image/pjpg' || $mime == 'image/png' || $mime == 'image/x-png' || $mime == 'image/gif') {
      if(!is_dir('../img/productos/')) {
        mkdir('../img/productos/',0755, true);
      }
      $random1 = rand(1,999999999);
      $random2 = rand(1,999999999);
      $fecha = date("Y_m_d_H_i_s");
      $nombreFinal = $random1."_".$random2."_".$fecha.".".$extension;
      if(move_uploaded_file($_FILES['img']['tmp_name'], "../img/productos/".$nombreFinal)) {
        $db->query("update Productos set nombre = '".$_POST['nombre']."', precio = ".$_POST['precio'].", id_categoria = ".$_POST['cate'].", descripcion = '".$_POST['desc']."',stock = ".$_POST['stock'].", imagen = '$nombreFinal' where id =".$_POST['id']);
        // echo $db->error;
        header("Location: ../admin/productos.php");
      } else {
        header("Location: ../admin/productos.php?error=al subir la imagen");
      }
    } else {
      header("Location: ../admin/productos.php?error=El archivo no es una imagen");
    }
  }else {
    $db->query("update Productos set nombre = '".$_POST['nombre']."', precio = ".$_POST['precio'].", id_categoria = ".$_POST['cate'].", descripcion = '".$_POST['desc']."',stock = ".$_POST['stock']." where id =".$_POST['id']);
    // echo $db->error;
    header("Location: ../admin/productos.php");
  }
} else {
  header("Location: ../admin/productos.php?error=No se pueden dejar campos vacios");
}
?>
