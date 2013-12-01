<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../vista/js/1.js"></script>
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <form action="../controlador/Competencia.php" method="post" onsubmit="return fechas();">
        <h1>Cree una nueva competencia</h1>
        Nombre de la competencia:<input type="text"             name="nombre_competencia"><br>
        Fecha de inicio:<input type="date" id='fecha_inicio'    name="fecha_inicio"><br>
        Hora de inicio:<input type="text" id='hora_ini'             name="hora_ini" onKeyPress="return FormatoHora(event,this)"><br> 
        Fecha de fin:<input type="date" id='fecha_fin'          name="fecha_fin"><br>
        Hora de fin:<input type="text" id='hora_fin'            name="hora_fin" onKeyPress="return FormatoHora(event,this)"><br>
        
        
        Configuracion de lenguaje:<br> 
                        java:<input type="CHECKBOX" name="configurador[]" value='1'>
                        c:   <input type="CHECKBOX" name="configurador[]" value='2'>
                        c++: <input type="CHECKBOX" name="configurador[]" value='3'><br>
        <input type="submit" value="Crear Competencia" name="crear_competencia">
        </form>
    </body>
</html>