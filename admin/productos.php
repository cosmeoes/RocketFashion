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
    <title>Productos</title>
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
  </head>
  <body>
    <?php include "./layouts/header.php" ?>
    <?php include "./layouts/sidebar.php" ?>
    <main>
      <?php if(isset($_GET['error'])) {?>
        <div class="error">
          Error: <?php echo $_GET['error']; ?>
        </div>
      <?php } ?>
      <h2>Lista de productos</h2>

      <div class="">

      </div>
      <div class="cols60">
        <table class="datos">
          <thead>
            <tr>
              <td>Nombre</td>
              <td>Precio</td>
              <td>Categoria</td>
              <td>Descripcion</td>
              <td>Stock</td>
              <td>Imagen</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>

        <?php
          $r = $db->query("select P.id, P.nombre, precio, C.nombre cate, descripcion, stock, imagen from Productos P, Categorias C where C.id = P.id_categoria");
          // echo $db->error;
          while($row = $r->fetch_assoc()) {
            ?>
            <tr>
              <td><?php echo $row['nombre'] ?></td>
              <td><?php echo $row['precio'] ?></td>
              <td><?php echo $row['cate'] ?></td>
              <td><?php echo $row['descripcion'] ?></td>
              <td><?php echo $row['stock'] ?></td>
              <td>
                <img src="../img/productos/<?php echo $row['imagen'] ?>" style="width: 50px" alt="">
              </td>
              <td>
                <button type="button" name="button" onclick="actualizar(<?php echo $row['id'] ?>)"> <i class="fas fa-pen"></i> </button>
                <button type="button" name="button" onclick="eliminar(<?php echo $row['id'] ?>)"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            <?php
          }
          ?>
          </tbody>
            </table>
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
                  echo '<option value="'.  $f['id'].'">'.$f['nombre'].'</option>';
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
      <div id="modal">
        <h3>Modificar producto</h3>
        <form id="formAct" action="../php/actprod.php" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="id" value="" id="idUpdate">
            <fieldset>
              <label for="name">Nombre</label>
              <input type="text" name="nombre" value="" id="nameUpdate" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="price">Precio</label>
              <input type="number" name="precio" id="priceUpdate" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="img">Imagen</label>
              <input type="file" name="img" value="" id="imgUpdate" onchange="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="stock">Stock</label>
              <input type="number" name="stock" value="" onkeypress="quitarBorde(this)" id="stockUpdate">

            </fieldset>
            <fieldset>
              <label for="cate">Categoria</label>
              <select onchange="quitarBorde(this)" class="" name="cate" id="cateUpdate">
                <?php
                $re=$db->query("select * from Categorias") or die($db->error);
                while($f=$re->fetch_assoc()){
                  echo '<option value="'.  $f['id'].'">'.$f['nombre'].'</option>';
                }
                 ?>
              </select>
            </fieldset>
            <fieldset>
              <label for="desc">Descripcion</label>
              <textarea onkeypress="quitarBorde(this)" name="desc" rows="8" cols="80" id="descUpdate"></textarea>
            </fieldset>
            <fieldset>
              <button type="submit" name="button">
                Actualizar
              </button>
            </fieldset>
            <fieldset>
              <button type="button" name="button" onclick="cerrarModal()">Cancelar</button>
            </fieldset>

        </form>
      </div>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        var miForm = document.getElementById('miForm');

        miForm.addEventListener("submit", function (e) {
          let label = document.getElementById("error");
          let inputs = document.querySelectorAll("#miForm > fieldset > input, #miForm > fieldset > textarea");
          let selects = document.querySelectorAll("#miForm > fieldset > select");

          for (let i = 0; i < inputs.length; i++) {
            n = inputs[i];
            if(n.value.trim() == ''){
              n.style.border ="1px solid red";
              console.log('aqui');
              e.preventDefault();
            }
          }
          for(let i = 0; i < selects.length; i++){
            n = selects[i];
            if(n.value == -1){
              n.style.border ="1px solid red";
              console.log('aqui 3');
              e.preventDefault();
            }
          }
        });

        var formAct = document.getElementById('formAct');

        formAct.addEventListener("submit", function (e) {
          let inputs = document.querySelectorAll("#formAct > fieldset > input,#formAct > fieldset > textarea");
          let selects = document.querySelectorAll("#formAct > fieldset > select");
          for (let i = 0; i < inputs.length; i++) {
            n = inputs[i];
            if(n.type != 'file' && n.value.trim() == ''){
              n.style.border ="1px solid red";
              e.preventDefault();
            }
          }
          for(let i = 0; i < selects.length; i++){
            n = selects[i];
            if(n.value == -1){
              n.style.border ="1px solid red";
              e.preventDefault();
            }
          }
        });

        function quitarBorde(obj) {
          obj.style = 'border: 1px solid #555555aa'
        }
        function actualizar(id){
          $.post('../php/getDatosProducto.php',{id: id}, function (d) {
            document.getElementById('modal').style.display = "block";
            let datos = JSON.parse(d);
            $("#idUpdate").val(datos.id);
            $("#nameUpdate").val(datos.nombre);
            $("#priceUpdate").val(datos.precio);
            $("#stockUpdate").val(datos.stock);
            $("#cateUpdate").val(datos.id_categoria);
            $("#descUpdate").val(datos.descripcion);

          });
        }
        function eliminar(id){
          window.location = "../php/eliminarProd.php?id="+id;
        }
        function cerrarModal(){
          document.getElementById('modal').style.display = "none";
        }
    </script>
  </body>
</html>
