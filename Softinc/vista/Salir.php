<?php

<<<<<<< HEAD
  session_start();
  unset($_SESSION["nombre_usuario"]); 
  session_destroy();
  header("Location: ./pag-principal/index.php");
  exit;
=======
 //session_start();
  unset($_SESSION["nombre_usuario"]);
  //session_destroy();
  echo '<script>window.location="../vista/pag-principal/index.php"</script>';
  //header("Location: ./pag-principal/index.php");
  //exit;
>>>>>>> f7ed457cfc720414636942d25f7b79ccd805baa3
?>
