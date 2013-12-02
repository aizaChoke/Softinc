
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <div id="formulario">
        <?php
            $con=new Consulta();
            echo $con->generarArchivosSubidosComite();
        ?>
        </div>
    </body>
</html>