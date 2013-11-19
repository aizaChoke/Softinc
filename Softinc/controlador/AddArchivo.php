<?php

if(isset($_POST['agregar'])){
     require '../modelo/File.php';
     
    $datosEntrada=$_POST['datosEntrada'];
    $datosSalida =$_POST['datosSalida'];
    $nomProblema=$_POST['idArchivo'];
    $puntaje=$_POST["puntajeSalida"];
    $archivo=new File();
    
if($datosEntrada!=" " && $datosSalida!=" " ){

         include("../modelo/cnx.php");
           $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          $numero=$archivo->listarArchivos("../archivo_comite/$nomProblema", "in");  
          $numero++;
          $archivo->guardar($datosEntrada,"$numero.in");
          rename("$numero.in" ,"../archivo_comite/$nomProblema/$numero.in");
          $numero=$numero."in";
          $insertar= "INSERT INTO archivo(id_problema, nombre_archivo, tipo, puntos_archivo)
                                  VALUES ( '$nomProblema', '$numero', 'entrada', '$puntaje');";
          $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


          $numero=$archivo->listarArchivos("../archivo_comite/$nomProblema", "out");  
          $numero++;
          $archivo->guardar($datosSalida,"$numero.out");
          rename( "$numero.out" ,"../archivo_comite/$nomProblema/$numero.out" );   
          $numero=$numero."out";
          $insertar= "INSERT INTO archivo(id_problema, nombre_archivo, tipo, puntos_archivo)
                                  VALUES ( '$nomProblema', '$numero', 'salida', '$puntaje');";
          $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          
          session_start();

          echo  $resultado="archivos insertados exitosamente";
           require '../vista/agregarArchivos.php';
}
else{
           echo   $resultado="intente nuevamente falta algun archivo";
        //   header("Location: ../vista/agregarArchivos.php");
}
               
               
                
               // require '../vista/SesionComite.php';
               // header("Location: ../vista/SesionComite.php");
                
              //  require '../Modelo/Contenido.php';
              //  $c =new Contenido("../vista/AgregarArchivos.php");
              //  $c->ponerTemplates("Ingrese","bienvenido al juez");
               // echo $c->mostrar();
              //  header("Location: ../vista/AgregarArchivos.php");

  $ruta = "../archivo_comite/$nomProblema";
$archivo->comprimir($ruta, "../archivo_comite/$nomProblema/$nomProblema.zip.");

//$archivo->download_file("../archivo/test.zip");
    
}
?>
