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
        <h3>Agregar ofertas</h3>
        <form id="miForm">
            <fieldset>
              <label for="name">Producto</label>
              <select onchange="quitarBorde(this)" class="" name="" id="cate">
                <option value="-1">Selecciona un producto</option>
                <option value="0">Producto 1</option>
                <option value="1">Producto 2</option>
              </select>
            </fieldset>
            <fieldset>
              <label for="price">Descuento</label>
              <input type="number" name="" id="price" onkeypress="quitarBorde(this)">
            </fieldset>
            <fieldset>
              <label for="img">Imagen</label>
              <input type="file" name="" value="" id="img" onchange="quitarBorde(this)">
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
        var selects = document.querySelectorAll("fieldset > select");
        miForm.addEventListener("submit", function (e) {
          for (var i = 0; i < inputs.length; i++) {
            n = inputs[i];
            if(n.value.trim() == ''){
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
          label.style = "display:none";
        }
    </script>
  </body>
</html>
