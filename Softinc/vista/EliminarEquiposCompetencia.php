<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <div id="formulario">
        <h2>SELECCIONE LOS EQUIPOS A ELIMINAR</h2>
        <form action="../controlador/Competencia.php" method="post">
                <?php 
                    echo '<input type="hidden" value='.$nombre_competencia.' name="nombre_competencia" >';
                    echo '<input type="hidden" value='.$id_competencia.' name="idcompetencia" >';
                    echo "<strong>Problema: $nombre_competencia <strong>";
                    require '../modelo/ConsultaCompetencia.php';
                    $consul     =   new ConsultaCompetencia();
                    echo    $consul->ListaEquiposDeCompetencia($id_competencia);     
                ?>
                <input type="submit" value="eliminar"  name="deleteEquipo">
        </form>
        </div>
    </body>
</html>
