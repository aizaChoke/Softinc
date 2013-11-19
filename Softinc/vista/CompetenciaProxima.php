<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
    </head>
        <title></title>
    </head>
    <body>
        <form method="post" action="../controlador/Competencia.php">
        <?php 
        include '../modelo/Competencia.php';
        $competencia=new Competencia();
        echo $competencia->siguienteCompetencia();
        ?>
        </form>

    </body>
</html>