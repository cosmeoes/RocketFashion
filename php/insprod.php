<?php
if(isset($_POST['nombre']) && isset($_POST['precio'])  && isset($_POST['stock'])  && isset($_POST['cate'])  && isset($_POST['desc'])) {
  $temp=explode(".",$_FILES['img']['name']);
  $extension = end($temp);
  $mime = $_FILES['img']['type'];
  if($mime == 'image/jpg' || $mime == 'image/jpeg' || $mime == 'image/pjpg' || $mime == 'image/png' || $mime == 'image/x-png' || $mime == 'image/gif') {
    if(!is_dir('../img/productos/')) {
      mkdir('../img/productos',0777);
    }
    $random1 = rand(1,999999999);
    $random2 = rand(1,999999999);
    $fecha = date("Y_m_d_H_i_s");
    $nombreFinal = $random1."_".$random2."_".$fecha.".".$extension;
    if(move_uploaded_file($_FILES['img']['tmp_name'], "../img/productos/".$nombreFinal)) {
      echo "se subio";
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
