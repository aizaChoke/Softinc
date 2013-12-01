<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <form action="../controlador/Equipo.php" method="post">
            <h1>Elija a los Equipos</h1>
           <?php     
                    echo "<strong> Competencia:  $nombre_competencia </strong>"; 
                    echo '<input type="hidden" value='.$nombre_competencia.' name="nombre_competencia" >';
                    echo '<input type="hidden" value='.$id_competencia.' name="idCompetencia" >';
                    echo $consul->generarEquiposCompetencia();
           ?>   
           
            <input type="submit" value="Agregar" name="agregar_usuarios_competencia">
            <input type="submit" value="Terminar" name="terminar_creacion_equipo">
        </form>
    </body>
</html>
