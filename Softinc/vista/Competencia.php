<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <div id="formulario">
        <h2>COMPETENCIAS</h2>
        <form action="../controlador/Competencia.php" method="post">
                <?php 
                    require '../modelo/ConsultaCompetencia.php';
                    $consul     =   new ConsultaCompetencia();
                    echo    $consul->ListaCompetencia();
                ?>
        </form>
        </div>
    </body>
</html>
