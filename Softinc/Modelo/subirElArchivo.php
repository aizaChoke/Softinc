<html>
<head></head>
<body>

<?php
    $titulo=$_POST['titulo'];
    $tipoCodigo=$_POST['tipoCodigo'];
    $tipoSolucion=$_POST['tipoSolucion'];
    $formaDesubir=$_POST['subir'];
    
       $idCompetencia= $_POST['idCompetencia'];
   if($formaDesubir=="Escriba codigo")
   {
    $codigoFuente=$_POST['codigoFuente'];
   }else{
       $codigoFuente="";
   }
// echo "/////////////".$codigoFuente."*****************";
     include_once  'juzgar.php';  
     
       //echo $tipoCodigo;
          $juez =new juzgar();
         //echo "pppppppppppppppppppppppppppppp".$titulo."oooooooooooooooooooooooooooooooo" ;
    if($codigoFuente=="" )
    { 
        $archivoNom=$_FILES['programa']['name'];
         if($archivoNom !== "")
         {
        if( ($tipoCodigo =="java" || $tipoCodigo =="c" || $tipoCodigo =="c++"))
        {
           
         if($titulo !=="")
         {
            $formatPermitido=array("java","c","cpp");// solo estos formatos soportara el sistema
            $nombreArchivo=$_FILES['programa']['name'];
            $destino = $nombreArchivo;
            copy($_FILES['programa']['tmp_name'],$destino);
            $puntoArchivo   =end(explode('.',$nombreArchivo)); //cortamos para obtener solamente el formato
      // echo "------------------- $puntoArchivo";
            if(in_array($puntoArchivo, $formatPermitido)){ //verifica si es un programa
       
                      ?>
         
 <?php
        $mensaje=$juez->compilarPrograma($puntoArchivo, $nombreArchivo,$titulo,$tipoSolucion,$idCompetencia);
 
        //echo "el programa compilo $puntoArchivo $mensaje";
                
        
        }else{
            echo "selecciones lenguage ";
            	
		header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/presentarSolucion.php");
		exit();  
        }
        }else{
            echo "ponga el codigo del problema";
            header( "Status: 301 Moved Permanently", false, 301);
            header("Location: ../vista/presentarSolucion.php");
		exit();  
        }
    }else{ 
        echo "seleccione lenguage";
       
        header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/presentarSolucion.php");
		exit();  
        }
    }else{
        echo "subir codigo";
        include '../vista/suvirProblemaJuez.php';
        header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/presentarSolucion.php");
		exit();  
    }
    }else{
        if($titulo!== "")
        {
        if("java"==$tipoCodigo && $titulo!== "")
        {
            $fp=fopen("Main.java" ,"w");
            fwrite($fp,$codigoFuente);
            fclose($fp) ;
            $mensaje=$juez->compilarPrograma("java","Main.java",$titulo,$tipoSolucion,$idCompetencia);
        //($puntoArchivo, $nombreArchivo,$titulo,$tipoSolucion,$idCompetencia)
        }
        if("c"==$tipoCodigo &&  $titulo!== "")
        {
         $fp=fopen("Main.c" ,"w");
        fwrite( $fp,$codigoFuente);
        fclose($fp) ;
         $mensaje=$juez->compilarPrograma("c","Main.c",$titulo,$tipoSolucion,$idCompetencia);
        
        }   
        if("cpp"==$tipoCodigo && $titulo!== "")
        {
            $fp=fopen("Main.cpp" ,"w");
        fwrite( $fp,$codigoFuente);
        fclose($fp) ;
         $mensaje=$juez->compilarPrograma("cpp","Main.cpp",$titulo,$tipoSolucion,$idCompetencia);
        }
        
        }else{
            echo "ingrese el codigo del problema";
            include '../vista/presentarSolucion.php';
        }
    }

?>
</body>
</html>
