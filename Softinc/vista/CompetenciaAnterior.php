<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
  
        <title></title>
    </head>
    <body>
        <div id="formulario">
        <h2>COMPETENCIAS PASADAS</h2>
        <form method="post" action="../controlador/Competencia.php">
        <?php 
        include '../modelo/ConsultaCompetencia.php';
        $competencia=new ConsultaCompetencia();
        echo $competencia->anteriorCompetencia();
        ?>
        </form>
        </div>
    </body>
</html>