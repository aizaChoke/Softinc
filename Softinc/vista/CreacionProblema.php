<?php
session_start();
?>
<html>
    <head>
        <title></title>
        <script type="text/javascript" src="../vista/js/funcion.js"></script>
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/layout.css">
        
    </head>
    <body>
         <div id="formulario">
       <form method="post" action="../controlador/Problema.php" enctype="multipart/form-data" id="formulario" onSubmit="return enviar();" >
            <table >
            <tr><td><h4>Nombre del problema:</h4></tr></td>
             <tr><td><input type="text"    name="nombre" id="nombreProblema"  onFocus="foco(this)"   required>  </tr></td>          
             <tr><td><h4>Inserte el enunciado:</h4></tr></td>                                   <tr><td><input type="file" name="enunciado" id="enunciado" required></td></tr>
           <tr><td> <input type="submit" value="siguiente" name="crear" title="crear nuevo problema" ></tr></td>   
        </form>
         </div>
    </body>
</html>