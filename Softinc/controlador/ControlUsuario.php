<?php

$accion=$_POST['accionUsuario'];
if($accion=="subir"){
   include '../vista/suvirProblemaJuez.php';
}
if($accion=="descargar"){
   include '../vista/descargar_archivo.php';
}

?>
