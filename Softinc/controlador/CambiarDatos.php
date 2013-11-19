<?php
include '../modelo/cnx.php';
session_start();
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$nombre=$_POST['nombre'];
$user=$_POST['user'];
$contraseña1=$_POST['contra1'];
$contraseña2=$_POST['contra2'];
echo $user;

        $modificar=  'UPDATE usuario
                      SET    nombre_usuario='.$nombre.'
                             user_usuario='.$user.'
                      WHERE  id_usuario='.$_SESSION["id_usuario"].';';
        $result = pg_query($cnx, $modificar) or die('ERROR AL modificar DATOS: ' . pg_last_error());

header("Location: ../vista/principal.php");




?>
