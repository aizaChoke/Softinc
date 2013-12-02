<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <div id="formulario">
        <h2>SELECCIONE UN EQUIPO</h2>
        <form action="../controlador/Equipo.php" method="post">
                <?php 
                    require '../modelo/ConsultaEquipo.php';
                    $consul     =   new ConsultaEquipo();
                    echo    $consul->generarEquiposAgregar();
                ?>
        </form>
        </div>
    </body>
</html>