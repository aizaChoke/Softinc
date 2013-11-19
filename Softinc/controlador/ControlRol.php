<?php

include '../modelo/File.php';
include '../modelo/cnx.php';
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$contenedor=new File();
$recuperado   =$_POST['rol'];
$cadena="";

for($i=0;$i<count($recuperado);$i++){
    $cadena=$cadena.$recuperado[$i];
}

$arrayDatos=$contenedor->getCadena($cadena);
//print_r($arrayDatos);
//echo var_dump($arrayDatos);
for($i=0;  $i<count($arrayDatos);  $i=$i+2){
        $modificar=
        'UPDATE usuario_rol
   SET  id_rol='.(integer)$arrayDatos[$i+1].'
 WHERE id_usuario='.(integer)$arrayDatos[$i].';';
        $result = pg_query($cnx, $modificar) or die('ERROR AL modificar DATOS: ' . pg_last_error());
        echo "Permisos cambiados con exito.";

}
?>
