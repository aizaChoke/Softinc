<?php

  session_start();
  unset($_SESSION["nombre_usuario"]); 
  session_destroy();
  header("Location: ./pag-principal/index.php");
  exit;
?>
