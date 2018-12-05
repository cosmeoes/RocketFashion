<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/login.css">
  </head>
  <body>
    <section>

    </section>
    <section>
      <h1>Iniciar Sesión</h1>

      <div class="buttons">
        <button type="button" name="button">
          <i class="fab fa-facebook"></i> Facebook
        </button>
        <button type="button" name="button">
          <i class="fab fa-google"></i> Google
        </button>

      </div>

      <div class="registro">
        <?php if(isset($_GET['success'])) { ?>
          <div style="background:#007d0a; color:white;">
            <b>Se ha registrado correctamente</b>
            <br>
            Ahora puede iniciar sessión
          </div>
        <?php } ?>
        <form action="./php/login.php" method="post">
          <input type="text" name="email" value="" placeholder="Ingresar email">
          <br>
          <input type="password" name="pass" value="" placeholder="***">
          <br>
          <button type="submit" name="button" onclick="alerta()">LOGIN</button>
        </form>
        <button type="button" onclick="alerta()" name="button">
          Registrar
        </button>
      </div>
    </section>
    <div id="alerta">
      <button type="button" id="btnCerrar">
      <i class="fas fa-times"></i>
      </button>
      <h2>Registro:</h2>
      <form id="miForm" action="./php/registro.php" method="post">
        <?php if(isset($_GET['error'])) { ?>
            <div style="background-color: red">
              <b>Error: </b><?php echo $_GET['error']; ?>
            </div>
        <?php } ?>
        <fieldset>
          <label for="name">Nombre:</label>
          <input type="text" name="name" value="" id="name" onkeyup="quitarBorde(this)">
        </fieldset>
        <fieldset>
          <label for="ap">Apellido</label>
          <input type="text" name="ap" value="" id="ap" onkeyup="quitarBorde(this)">
        </fieldset>
        <fieldset>
          <label for="email">Email</label>
          <input type="email" name="email" value="" id="email" onkeyup="quitarBorde(this)">
        </fieldset>
        <fieldset>
          <label for="pass">Password</label>
          <input type="password" name="pass" value="" id="pass" onkeyup="quitarBorde(this)">
        </fieldset>
        <fieldset>
          <label for="pass2">Confirmar password</label>
          <input type="password" name="pass2" value="" id="pass2" onkeyup="quitarBorde(this)">
        </fieldset>
        <label id="error" style="display:none">Las contraseñas no coinciden</label>
        <fieldset>
          <button type="submit" name="button" id="btnIngresar">Ingresar</button>
        </fieldset>
      </form>
    </div>
    <script type="text/javascript">
      function alerta() {
        var divAlerta = document.getElementById('alerta');
        divAlerta.style = "display: block;";
      }
      document.getElementById('btnCerrar').addEventListener("click", function() {
        document.getElementById('alerta').style = "display: none;";
      });

      var miForm = document.getElementById('miForm');
      var inputs = document.querySelectorAll("fieldset > input");
      var label = document.getElementById("error");
      miForm.addEventListener("submit", function (e) {
        for (var i = 0; i < inputs.length; i++) {
          n = inputs[i];
          console.log(n);
          if(n.value.trim() == ''){
            n.style.border ="1px solid red";
            e.preventDefault();
          }
        }
        var pass = document.getElementById("pass");
        var pass2 = document.getElementById("pass2");
        if(pass.value !== pass2.value) {
          label.style = "color: red; display:inline;font-weight:bold";
          pass.style.border ="1px solid red";
          pass2.style.border ="1px solid red";
          e.preventDefault();
        }
      });
      function quitarBorde(obj) {
        obj.style = 'border: 1px solid #555555aa'
        if(obj.id == "pass" || obj.id=="pass2") {
          label.style = "display:none";
        }
      }

    </script>
  </body>
</html>
