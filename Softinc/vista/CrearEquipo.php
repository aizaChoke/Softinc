<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
        <script type="text/javascript" src="js/funcion.js"></script>
        <script type="text/javascript" src="js/prototype.js"></script>
    </head>
    <body>
        <form action="../controlador/Equipo.php" method="post">
        <h1>Cree un nuevo Grupo</h1>
        Nombre de Grupo:<input type="text"            name="nombre_equipo"  id="nombre_equipo" onBlur="existeEquipoC(this)" placeholder="nombre equipo"><br>
        <samp id="conprobarEquipo"></samp><br>
        <input type="submit" value="Crear Nuevo Grupo" name="crear_equipo">
        </form>
    </body>
</html>