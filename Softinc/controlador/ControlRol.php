<?php

include '../modelo/File.php';
include '../modelo/cnx.php';
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$contenedor=new File();
$cadena="";

$arr = array(); // en este arreglo se va a guardar la $k (key o indice) que estamos revisando
$id = ''; // En este se guarda el id del usuario como tal
foreach ($_POST as $k => $v) {
$cadena=$cadena.$v;
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
 





