<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <h2>COMPETENCIAS QUE USTED PUEDE PARTICIPAR</h2>
        <form action="../controlador/Equipo.php" method="post">
                <?php 
                    require '../modelo/ConsultaCompetencia.php';
                    $consul     =   new ConsultaCompetencia();
                    echo    $consul->ListaCompetenciaDeUsuario();
                ?>
        </form>
    </body>
</html>