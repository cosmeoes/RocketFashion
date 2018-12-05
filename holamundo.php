<?php
//Get peticiones desde la URL
if(isset($_GET['botones']) && isset($_GET['color1']) && $_GET['color2']) {
  $numero = $_GET['botones'];
  $c1 = $_GET['color1'];
  $c2 = $_GET['color2'];
  for ($i=0; $i <$numero ; $i++) {
    if($i % 2 == 0) {
      echo "<button style='background: $c1'> mi buton $i </button>";
      $cont++;
    } else {
      echo "<button style='background: $c2'> mi buton $i </button>";
    }
  }
  echo "Botones del color 1 son : $cont";
} else {
  echo "Pasa la merca";
}

?>
