<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <script type="text/javascript" src="../vista/js/1.js"></script>
                <link rel="StyleSheet" href="../vista/css/1.css" type="text/css">
                <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>  
        <form method="post" action="../controlador/Equipo.php">
            <div id="menuCompetencia">
                <h2>Elija los problemas</h2><br>
                <input type="submit" value="agregar"    name="agregar_problema">
                <input type="submit" value="siguiente"  name="siguiente_problema"><br>
                
                <?php
                
                    include '../Modelo/Consulta.php';
                    $con=new Consulta();
                    echo '<input type="hidden" value='.$id_competencia.' name="idCompetencia" >';
                    echo $con->generarArchivos();     
                ?>
            </div>

        </form>

    </body>
    
</html>