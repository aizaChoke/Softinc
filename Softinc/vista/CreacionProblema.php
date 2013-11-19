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
        bienvenid@ a juez SOFT-INC: <?php echo $_SESSION["nombre_usuario"];  ?><br>
         <div id="formulario">
       <form method="post" action="../controlador/CrearP.php" enctype="multipart/form-data" id="formulario" onsubmit="return enviar();" >
            Nombre del problema:
            <input type="text"    name="nombre" id="nombreProblema"  onFocus="foco(this)"   required>  <br>          
            <label>Seleccione los archivos</label><br>
            inserte el enunciado:                                   <input type="file" name="enunciado" id="enunciado" required><br>
            <input type="submit" value="siguiente" name="crear" title="crear nuevo problema" >  
        </form>
         </div>
    </body>
</html>