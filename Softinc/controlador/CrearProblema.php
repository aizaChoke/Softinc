<?php 


    include("../modelo/cnx.php");
    require '../modelo/File.php';
    session_start();
    $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
    $mensaje        =FALSE;
    $validacion     ="";
    $dir            ="";
    $seleccionar    ="SELECT nombre_problema  FROM problema";
    $result         = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    $columnas       = pg_numrows($result);


    for($i=1;$i<=$columnas; $i++){
        $line = pg_fetch_array($result, null, PGSQL_ASSOC);
        if(!strcmp($line['nombre_problema'] ,$_REQUEST['nombre'])){ // El nombre ya existe en la bd???
           $mensaje=TRUE; 
          
        }
    }    
    
    
        
    if($_REQUEST['in']!=" " && $_REQUEST['out']!=" " && $_FILES['enunciado']['name']){
            $formatPermitido=array("pdf");// solo estos formatos soportara el sistema
            $nombreArchivo=$_FILES['enunciado']['name'];
            $puntoArchivo   =end(explode('.',$nombreArchivo)); //cortamos para obtener solamente el formato
            if(in_array($puntoArchivo, $formatPermitido)){ 
                        
                
                
               if($mensaje!=TRUE){

                    $usuario=$_SESSION["id_usuario"];
                    $problema=$_REQUEST['nombre'];
                    
                    
                    $insertar= "INSERT INTO problema(id_usuario, id_olimpiada, nombre_problema, descripcion_problema)
                                 VALUES ('$usuario', 1,'$problema' , 'nada');";
                    $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    
                    $seleccionar="SELECT id_problema  FROM problema  where nombre_problema='$_REQUEST[nombre]'";
                    $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    $columnas   = pg_numrows($result);


                    for($i=1;$i<=$columnas; $i++){
                    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $line['id_problema'];
                    }
                $nomProblema=$line['id_problema'];
                move_uploaded_file($_FILES['enunciado']['tmp_name'], "../archivo/problema/".$_FILES['enunciado']['name']); 
                rename("../archivo/problema/".$_FILES['enunciado']['name'],"../archivo/problema/$nomProblema.pdf");
                $input=$_REQUEST['in'];
                $output=$_REQUEST['out'];
                $archivo=new File();
                $archivo->guardar($input,"$nomProblema.in");
                rename("$nomProblema.in" ,"../archivo/entrada/$nomProblema.in");
                $archivo->guardar($output,"$nomProblema.out");
                rename("$nomProblema.out","../archivo/salida/$nomProblema.out");
                $validacion="Su creacion fue exitosa";
                require '../vista/CrearProblema.html';
                }
                else{
                    // "enviamos un mensaje a la vista, ya existe el problema"
                }
            }else{ 
                echo "suba un archivo con el formato adecuado";
                }  
            
      } else{
            echo "falta archivos";
        }
    
   


pg_close($cnx);
   

?>
