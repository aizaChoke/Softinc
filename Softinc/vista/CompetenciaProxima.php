<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
  
        <title></title>
    </head>
    <body>
        <h2>COMPETENCIAS PROXIMAS</h2>
        <form method="post" action="../controlador/Competencia.php">
        <?php 
        include '../modelo/ConsultaCompetencia.php';
        $competencia=new ConsultaCompetencia();
        echo $competencia->siguienteCompetencia();
        ?>
        </form>

    </body>
</html>