<html>
    <head>
        <title></title>
         <link rel="StyleSheet" href="../vista/css/CreacionProblema.css" type="text/css">
         <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>

        <div id="formularioADD">
        <form method="post" action="../controlador/Problema.php" enctype="multipart/form-data">
             
             <?php
             echo "<strong>Problema:  $nombreProblema </strong>"; 
             echo '<input type="hidden" value='.$id_problema.' name="id_problema" >';
             echo '<input type="hidden" value='.$nombreProblema.' name="nombre_problema" >';
             ?>
             
            <br><h4>Insertar datos de Entrada:</h4> &nbsp; &nbsp;    <br><textarea cols="50" rows="10" name="datosEntrada" placeholder="Ingrese valores de entrada" required></textarea><br>
            <br><h4>Insertar datos de Salida :</h4> &nbsp; &nbsp;    <br><textarea cols="50" rows="10" name="datosSalida" placeholder="Ingrese valores de salisa"  required></textarea><br>
            Inserte el puntaje del archivo de salida :  <br>
            <input type="text" name="puntajeSalida" placholder="1233" pattern="([0-9]{1,1000})" required  ">
            <br>Agregar Archivos:
            <input type="submit" value="agregar" name="agregar" required >
            
        </form>        
         </div>
    </body>
</html>