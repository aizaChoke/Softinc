<!DOCTYPE html>
<html>
    <head>
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
  
        <title></title>
    </head>
    <body>
        <form method="post" action="../controlador/Competencia.php">
        <?php 
       
        echo $consultaEquipo->listaUsuariosEquipo($id_equipo);
        ?>
        </form>

    </body>
</html>