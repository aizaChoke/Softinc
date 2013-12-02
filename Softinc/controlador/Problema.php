
 <?php
 require '../modelo/cnx.php';
 if(isset($_POST['crear'])){
    require '../modelo/CreadorArchivos.php';
    $archivo=$_FILES['enunciado']['name'];
    $nombreProblema=$_REQUEST['nombre'];
    $servidor=$_FILES['enunciado']['tmp_name'];
    $creador=new CreadorArchivos();
    $mensaje=$creador->subir($archivo, $servidor, $nombreProblema);
    
    $seleccionar="SELECT id_problema, id_usuario, nombre_problema
                  FROM problema
                  where nombre_problema='$nombreProblema';";
    $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    $columnas   = pg_numrows($result);

    $id_problema=0;
    for($i=1;$i<=$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $id_problema=$line['id_problema'];
    }
    require '../vista/AgregarArchivos.php';
 }
 
 
 if(isset($_POST['agregar'])){ //agregar datos de entrada y salida
     require '../modelo/File.php';
    $nombreProblema = $_POST['nombre_problema'];
    $datosEntrada   =$_POST['datosEntrada'];
    $datosSalida    =$_POST['datosSalida'];
    $id_problema    =$_POST['id_problema'];
    $puntaje        =$_POST["puntajeSalida"];
    $archivo        =new File();
    
if($datosEntrada!=" " && $datosSalida!=" " ){

          include("../modelo/cnx.php");
          $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          $numero=$archivo->listarArchivos("../archivo_comite/$id_problema", "in");  
          $numero++;
          $archivo->guardar($datosEntrada,"$numero.in");
          rename("$numero.in" ,"../archivo_comite/$id_problema/$numero.in");
          $numero=$numero."in";
          $insertar= "INSERT INTO archivo(id_problema, nombre_archivo, tipo, puntos_archivo)
                                  VALUES ( '$id_problema', '$numero', 'entrada', '$puntaje');";
          $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


          $numero=$archivo->listarArchivos("../archivo_comite/$id_problema", "out");  
          $numero++;
          $archivo->guardar($datosSalida,"$numero.out");
          rename( "$numero.out" ,"../archivo_comite/$id_problema/$numero.out" );   
          $numero=$numero."out";
          $insertar= "INSERT INTO archivo(id_problema, nombre_archivo, tipo, puntos_archivo)
                                  VALUES ( '$id_problema', '$numero', 'salida', '$puntaje');";
          $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          
          session_start();

          echo  $resultado="archivos insertados exitosamente";
           require '../vista/agregarArchivos.php';
}
else{
           echo   $resultado="intente nuevamente falta algun archivo";
        //   header("Location: ../vista/agregarArchivos.php");
}


  $ruta = "../archivo_comite/$id_problema";
$archivo->comprimir($ruta, "../archivo_comite/$id_problema/$id_problema.zip.");

//$archivo->download_file("../archivo/test.zip");
    
}

if(isset($_POST['ide_problema'])){ //subir archivos a un problema existente
    $contenedor=array();
    $id = ''; 
    $id_problema=$_POST['ide_problema'];
    $contenedor = explode('_', $id_problema); 
    $id_problema = $contenedor[1]; //id_problema es el id que se le manda a la clase de agregarArchivos.php
    $nombreProblema = $contenedor[2];
    session_start();
    require '../vista/AgregarArchivos.php';
    
}


if(isset($_POST['Contenedor'])){   //devuelve los id_problema para luego eliminarlos
    include("../modelo/cnx.php");
    include("../modelo/File.php");
    $f=new File();
    $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
    $conten = $_POST['Contenedor'];

for($i=0;$i<count($_POST['Contenedor']);$i++){
    
    $eliminar   =   "DELETE FROM archivo WHERE id_problema=$conten[$i];";
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    
    $eliminar   =   "DELETE FROM competencia_problema WHERE id_problema=$conten[$i];";
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    
    $eliminar   =   "DELETE FROM problema WHERE id_problema=$conten[$i];";
    $f->eliminarCarpeta("../archivo_comite/$conten[$i]");
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
       
}

header("Location: ../vista/EliminarProblema.php");	
}

 ?>
