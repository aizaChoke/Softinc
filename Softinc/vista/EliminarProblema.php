
<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript" src="../vista/js/EliminarProblema.js"></script>
     <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
            <h2>SELECCIONE LOS PROBLEMAS QUE DESEA ELIMINAR</h2>
         <div id="formulario">
        <form method="post" action="../controlador/Problema.php" onsubmit="return clickEliminar()">
             <?php
             require  '../Modelo/Consulta.php';
                $p=new Consulta();
                echo $p->generarTablaEliminarProblema();
             ?>
            <input type="submit" value="eliminar" name="eliminar" >
        </form>
         </div>


    </body>

</html>
