<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../vista/js/1.js"></script>
    </head>
    <body>
        <form action="../controlador/CrearCompetencia.php" method="post">
        <h1>Cree una nueva competencia</h1>
        Nombre de la competencia:<input type="text"             name="nombre_competencia"><br>
        Fecha de inicio:<input type="date" id='inputField'      name="fecha_inicio"><br>
        Hora de inicio:<input type="text" id='hora'         name="hora" onKeyPress="return FormatoHora(event,this)"><br>
        Duracion:<input type="text" id='duracion'         name="duracion" onKeyPress="return FormatoHora(event,this)"><br>
        <input type="submit" value="Crear Competencia">
        </form>
    </body>
</html>