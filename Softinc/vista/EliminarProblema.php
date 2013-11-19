
<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript" src="../vista/js/EliminarProblema.js"></script>
     <link rel="StyleSheet" href="../vista/css/CreacionProblema.css" type="text/css">
    </head>
    <body>

         <div id="formularioEliminar">
        <form method="post" action="../controlador/ControlEliminar.php" onsubmit="return clickEliminar()">
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
