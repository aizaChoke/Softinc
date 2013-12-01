<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <form action="../controlador/Equipo.php" method="post">
       
        <?php
        echo "<h3>Agregue Usuarios a su Equipo: $nombreEquipo </h3>";
        echo '<input type="hidden" value='.$nombreEquipo.' name="nombreEquipo" >';
        echo $consulta->generarTablaUsuariosEquipos();
        ?>
        <input type="submit" value="agregar" name="agregar">
        </form>
    </body>
</html>