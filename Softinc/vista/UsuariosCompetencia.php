<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action="../controlador/CrearEquipo.php" method="post">
            <h1>Elija a los usuarios</h1>

           <?php  
           echo '<input type="hidden" value='.$id_competencia.' name="idCompetencia" >';
                echo $consul->generarUsuariosCompetencia();
           ?>     
            
            <input type="submit" value="agregar" name="agregar_usuario">
            <input type="submit" value="Inscribir a Equipos" name="inscribir_equipos">


        </form>
    </body>
</html>