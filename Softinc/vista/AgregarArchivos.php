<html>
    <head>
        <title></title>
         <link rel="StyleSheet" href="../vista/css/CreacionProblema.css" type="text/css">
    </head>
    <body>

        bienvenid@ a juez SOFT-INC: <?php  echo $_SESSION["nombre_usuario"];  ?><br>
        <div id="formularioADD">
        <form method="post" action="../controlador/AddArchivo.php" enctype="multipart/form-data">
             Codigo del problema: 
             <?php
                    include '../Modelo/Consulta.php';
                    $con=new Consulta();
                    echo $con->generaListaArchivosPermitidosComite();
            ?>
          

             <br>Inserte su archivo de Entrada: &nbsp; &nbsp;    <br><textarea cols="50" rows="10" name="datosEntrada" placeholder="ingrese valores de entrada" required> hh </textarea><br>
            <br>Inserte su archivo de Salida : &nbsp; &nbsp;    <br><textarea cols="50" rows="10" name="datosSalida" placeholder="ingrese valores de salisa"  required> hhh</textarea><br>
            Inserte el puntaje del archivo de salida :  <br>
            <input type="text" name="puntajeSalida" required ">
            <br>Agregar Archivos:
            <input type="submit" value="agregar" name="agregar" required>
            
            
        </form>
        

        <a href="../controlador/archivosComite.php" target="_self">  <input type="button" value="terminar" name="terminar"></a>

         </div>
    </body>
</html>