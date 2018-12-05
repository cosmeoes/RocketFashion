<?php
session_start();
if(!isset($_SESSION['usario'])) {
  header('Location: ../login.php?error=acceso denegado');
}
$datosSesion = $_SESSION['usario'];
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Plantilla</title>
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="../css/all.css">
  </head>
  <body>
    <?php include "./layouts/header.php" ?>
    <?php include "./layouts/sidebar.php" ?>
    <main>
     <h2>Bienvenido <?php echo $datosSesion['Nombre'] . ' ' . $datosSesion['Ap']; ?></h2>
    </main>

  </body>
</html>
