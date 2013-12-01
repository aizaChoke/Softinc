<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <h2>COMPETENCIAS</h2>
        <form action="../controlador/Competencia.php" method="post">
                <?php 
                    require '../modelo/ConsultaEquipo.php';
                    $consul     =   new ConsultaEquipo();
                    echo    $consul->ListaUsuariosDeEquipos($id_equipo);
                ?>
        </form>
    </body>
</html>