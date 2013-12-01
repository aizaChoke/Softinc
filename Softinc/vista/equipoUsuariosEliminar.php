<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <form action="../controlador/Equipo.php" method="post">
        <h1>Usuarios</h1>
       
        <?php
        echo '<input type="hidden" value='.$nombreEquipo.' name="nombreEquipo" >';
        echo $consulta->generarTablaUsuariosEquipos2($nombreEquipo);
        ?>
        <input type="submit" value="Eliminar" name="eliminar_usuario">
        </form>
    </body>
</html>