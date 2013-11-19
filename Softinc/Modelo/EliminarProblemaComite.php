<?php

 include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$conten = $_POST['Contenedor'];
for($i=0;$i<count($_POST['Contenedor']);$i++){
    $eliminar="DELETE FROM problema WHERE id_problema=$conten[$i];";
$result = pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
}
?>
