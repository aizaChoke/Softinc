<?php


include("../modelo/cnx.php");
include("../modelo/File.php");
$f=new File();
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$conten = $_POST['Contenedor'];


for($i=0;$i<count($_POST['Contenedor']);$i++){
    
    $eliminar   =   "DELETE FROM archivo WHERE id_problema=$conten[$i];";
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    
    $eliminar   =   "DELETE FROM problema WHERE id_problema=$conten[$i];";
    $f->eliminarCarpeta("../archivo_comite/$conten[$i]");
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
}

header("Location: ../vista/EliminarProblema.php");	
?>
