<?php

session_start();
?>


<html>
    <head>
        <title></title>
		<link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/layout.css">
    </head>
    <body>
        <form method="post" action="../controlador/CambiarDatos.php">
        <?php
             require  '../Modelo/Consulta.php';
                $p=new Consulta();
                echo $p->datos();
        ?>
            <input type="submit" value="Actualizar">
        </form>
    </body>
</html>
