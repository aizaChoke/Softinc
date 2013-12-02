<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <h2>SUBIR ACHIVOS DE ENTRADA Y SALIDA A SUS PROBLEMAS</h2>
        <form action="../controlador/Problema.php" method="post">
<?php 
require '../modelo/Consulta.php';
$consul=new Consulta();
echo $consul->generarArchivosSubidosComite2();
?>
        </form>
    </body>
</html>