<?php
  include './conexion.php';
  if(isset($_POST['name']) && isset($_POST['ap']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
    $nombre = $_POST['name'];
    $ap = $_POST['ap'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if($pass == $pass2) {
      echo "sugoi desu ne";
      $db->query("insert into Usarios values(0,'$nombre', '$ap','$email','".sha1($pass)."', 'default.jpg', 0)") or die($db->error);
      header('Location: ../login.php?success');
    } else {
      header("Location: ../login.php?error=las contraseñas no coinciden.");
    }
  } else {
    //metod para redireccionar
    header("Location: ../login.php?error=los campos no fueron completados");
  }


 ?>

<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="">
      Gracias por registrarte <?php echo $nombre; ?>
    </div>
  </body>
</html>
