<?php
session_start();
?>
<html>
    <head>
        <title></title>
        <script type="text/javascript" src="../vista/js/funcion.js"></script>
         <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/layout.css">
        
    </head>
    <body>
         <div id="formulario">
       <form method="post" action="../controlador/Problema.php" enctype="multipart/form-data" id="formulario" onsubmit="return enviar();" >
            <h4>Nombre del problema:</h4>
            <input type="text"    name="nombre" id="nombreProblema"  onFocus="foco(this)"   required>  <br>          
            <h4>Inserte el enunciado:</h4>                                   <input type="file" name="enunciado" id="enunciado" required><br>
            <input type="submit" value="siguiente" name="crear" title="crear nuevo problema" >  
        </form>
         </div>
    </body>
</html>