<?php
session_start();
if(!isset($_SESSION['usario'])) {
  header('Location: ../login.php?error=acceso denegado');
}
  include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['precio'])  && isset($_POST['stock'])  && isset($_POST['cate'])  && isset($_POST['desc'])) {
  if(!is_numeric($_POST['stock']) || !is_numeric($_POST['precio'])) {
    header("Location: ../admin/productos.php?error=El stock y precio deben ser valores numericos");
    exit();
  }
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
      $db->query("insert into Productos values (0,'".$_POST['nombre']."',".$_POST['precio'].",'".$nombreFinal."',".$_POST['cate'].",'".$_POST['desc']."',".$_POST['stock'].")");

      header("Location: ../admin/productos.php");
    } else {
      echo "ni maiz";
    }

  } else {
    header("Location: ../admin/productos.php?error=no se reconoce como imagen");
  }
} else {
  header("Location: ../admin/productos.php?error=campos no completados");
}
 ?>
