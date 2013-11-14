<?php

class CreadorArchivos {
    private $validacion;
    
    function __construct() {
        $this->validacion="";
    }

    function buscar($buscado){
     include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
       // session_start();
    
    
    $mensaje        =FALSE;

    $seleccionar    ="SELECT nombre_problema  FROM problema";
    $result         = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    $columnas       = pg_numrows($result);


    for($i=1;$i<=$columnas; $i++){
        $line = pg_fetch_array($result, null, PGSQL_ASSOC);
        if(!strcmp($line['nombre_problema'] ,$buscado)){ // El nombre ya existe en la bd???
           $mensaje=TRUE; 
          
        }
    }
    return $mensaje;
    }
    
    function subir($archivo,$nombreArchivoServidor,$nombreRescatado){
         include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        session_start();

            $formatPermitido=array("pdf");// solo estos formatos soportara el sistema
            $nombreArchivo=$archivo;
            $puntoArchivo   =end(explode('.',$nombreArchivo)); //cortamos para obtener solamente el formato
            if(in_array($puntoArchivo, $formatPermitido)){ 
                        
                
                
               if($this->buscar($nombreRescatado)!=TRUE){

                    $usuario=$_SESSION["id_usuario"];
                    $problema=$_REQUEST['nombre'];
                    
                    
                    $insertar= "INSERT INTO problema(id_usuario, nombre_problema)
                                 VALUES ('$usuario','$nombreRescatado');";
                    $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
               //     echo $nombreRescatado;
                    $seleccionar="SELECT id_problema  FROM problema  where nombre_problema='$nombreRescatado'";
                    $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    $columnas   = pg_numrows($result);


                    for($i=1;$i<=$columnas; $i++){
                    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $line['id_problema'];
                    }
                 
                $nomProblema=$line['id_problema'];
                mkdir("../archivo_comite/$nomProblema");
                move_uploaded_file($nombreArchivoServidor, "../archivo_comite/$nomProblema/".$archivo); 
                rename("../archivo_comite/$nomProblema/".$archivo ,"../archivo_comite/$nomProblema/$nomProblema.pdf");
                
 

                $this->validacion="Su creacion fue exitosa el codigo de su problema es: $nomProblema";
               // require '../vista/ProblemaCreado.php';
                }
                else{
                    $this->validacion= " ya existe el problema";
                }
            }else{ 
                $this->validacion="suba un archivo con el formato adecuado";
                }  
            
                return $this->validacion;
    }
    
}

?>
