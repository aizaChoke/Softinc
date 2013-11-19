<?php


?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">


    </head>
    <body>  
        <form method="post" action="buscarArchivo.php">
            <div id="menuCompetencia">
                <?php
                    include '../Modelo/Consulta.php';
                    $con=new Consulta();
                    echo "<h2>Elija la olimpiada</h2> <br>".$con->generaListaCompetenciaPermitidosComite(); 
                    echo "<br>";
                    echo "<h2>Elija los problemas</h2><br>".$con->generarArchivos();     
                ?>
            </div>
                <div id="cambioCompetencia">
                <h2>Que desea hacer?</h2><br>
                <input type="submit" value="agregar" name="agregar">
                <input type="submit" value="terminar" name="terminar"><br>
                </div>
        </form>

    </body>
    
</html>