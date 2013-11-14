<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action="../controlador/CrearEquipo.php" method="post">
        <h1>Agregue usuarios a su grupo</h1>
       
        <?php
        echo '<input type="hidden" value='.$nombreEquipo.' name="nombreEquipo" >';
        echo $consulta->generarTablaUsuariosEquipos();
        ?>
        <input type="submit" value="agregar" name="agregar">
        </form>
    </body>
</html>