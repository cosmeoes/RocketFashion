<?php
  session_start();
  include './conexion.php';
  if(isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $pass =  $_POST['pass'];
    $res = $db->query("select * from Usarios where email = '$email' and  pass = sha1('$pass')");
    // mysqli_num_rows($re) > 0
    if(mysqli_num_rows($res) > 0){
      //mysqli_fetch_array($res)
      while($f = $res->fetch_assoc()) {
        echo 'Bienvenido '.$f['nombre'].' '.$f['ap'];
        $_SESSION['usario'] =array('Id' => $f['id'],'email' => $f['email'], 'Nombre' => $f['nombre'], 'Ap' => $f['ap'],'Img_perfil' => $f['img_perfil'], 'Nivel' => $f['nivel']);
        header("Location: ../admin/");
      }
    } else {
      header("Location: ../login.php?error=Usuario o contraseña invalida");
    }
  } else {
    header("Location: ../login.php?error=favor de llenar los campos");
  }
?>
