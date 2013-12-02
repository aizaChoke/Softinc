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
        echo "<h3>SELECCIONE A LOS USUARIOS QUE DESEA ELIMINAR DEL EQUIPO:  $nombreEquipo </h3>"; 
        echo '<input type="hidden" value='.$nombreEquipo.' name="nombreEquipo" >';
        echo '<input type="hidden" value='.$id_equipo.' name="id_equipo" >';
        echo $consulta->generarTablaUsuariosEquipos2($id_equipo);
        ?>
        <input type="submit" value="Eliminar" name="eliminar_usuario">
        </form>
    </body>
</html>