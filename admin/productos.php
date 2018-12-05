<?php
session_start();
if(!isset($_SESSION['usario'])) {
  header('Location: ../login.php?error=acceso denegado');
}
$datosSesion = $_SESSION['usario'];
include '../php/conexion.php';
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
      <h2>Lista de productos</h2>
      <div class="cols60">

      </div>
      <div class="cols30">
        <h3>Agregar productos</h3>
        <form id="miForm" action="../php/insprod.php" method="post" enctype="multipart/form-data" >
            <fieldset>
              <label for="name">Nombre</label>
              <input type="text" name="nombre" value="" id="name" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="price">Precio</label>
              <input type="number" name="precio" id="price" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="img">Imagen</label>
              <input type="file" name="img" value="" id="img" onchange="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="stock">Stock</label>
              <input type="number" name="stock" value="" onkeypress="quitarBorde(this)" id="stock">

            </fieldset>
            <fieldset>
              <label for="cate">Categoria</label>
              <select onchange="quitarBorde(this)" class="" name="cate" id="cate">
                <?php
                $re=$db->query("select * from Categorias") or die($db->error);
                while($f=$re->fetch_assoc()){
                  echo '<option values="'.  $f['id'].'">'.$f['nombre'].'</option>';
                }
                 ?>
              </select>
            </fieldset>
            <fieldset>
              <label for="desc">Descripcion</label>
              <textarea onkeypress="quitarBorde(this)" name="desc" rows="8" cols="80" id="desc"></textarea>
            </fieldset>
            <fieldset>
              <button type="submit" name="button">
                Insertar
              </button>
            </fieldset>

        </form>

      </div>

    </main>
    <script type="text/javascript">
        var miForm = document.getElementById('miForm');
        var label = document.getElementById("error");
        var inputs = document.querySelectorAll("fieldset > input, fieldset > textarea");
        miForm.addEventListener("submit", function (e) {
          for (var i = 0; i < inputs.length; i++) {
          n = inputs[i];
          if(n.value.trim() == ''){
            n.style.border ="1px solid red";
            e.preventDefault();
          }
          }
        });

      function quitarBorde(obj) {
          obj.style = 'border: 1px solid #555555aa'
          label.style = "display:none";
        }
    </script>
  </body>
</html>
