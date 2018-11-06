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
        <form id="miForm">
            <fieldset>
              <label for="name">Nombre</label>
              <input type="text" name="" value="" id="name" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="price">Precio</label>
              <input type="number" name="" id="price" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="img">Imagen</label>
              <input type="file" name="" value="" id="img" onchange="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="stock">Stock</label>
              <input type="number" name="" value="" onkeypress="quitarBorde(this)" id="stock">

            </fieldset>
            <fieldset>
              <label for="cate">Categoria</label>
              <select onchange="quitarBorde(this)" class="" name="" id="cate">
                <option value="0">Categoria 1</option>
                <option value="1">Categoria 2</option>
              </select>
            </fieldset>
            <fieldset>
              <label for="desc">Descripcion</label>
              <textarea onkeypress="quitarBorde(this)" name="name" rows="8" cols="80" id="desc"></textarea>
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
