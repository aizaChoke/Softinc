
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="../vista/js/1.js"></script>
        <title></title>
        <script type="text/javascript" src="jquery-1.10.2.js"></script>
        <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <h2>SELECCIONE LA COMPETENCIA QUE DESEA MODIFICAR</h2>
        <form action="../controlador/Competencia.php" method="POST">
        <?php 
        include '../modelo/ConsultaCompetencia.php';
        $competencia=new ConsultaCompetencia();
        echo $competencia->CompetenciaComite();
        ?>
        </form>
      
    </body>
</html>