<html>
<head></head>
<body>

<?php
    $titulo=$_POST['titulo'];
    $tipoCodigo=$_POST['tipoCodigo'];
    $codigoFuente=$_POST['codigoFuente'];
    //echo $codigoFuente;
     include_once  'juzgar.php';  
     
       //echo $tipoCodigo;
          $juez =new juzgar();
         //echo "pppppppppppppppppppppppppppppp".$titulo."oooooooooooooooooooooooooooooooo" ;
    if($codigoFuente=="" )
    { $archivoNom=$_FILES['programa']['name'];
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
        if(in_array($puntoArchivo, $formatPermitido)){ //verifica si es un programa
       
                      ?>
         
 <?php
        $mensaje=$juez->compilarPrograma($puntoArchivo, $nombreArchivo,$titulo);
 
        echo "el programa compilo $puntoArchivo $mensaje";
                
        
        }else{
            echo "selecciones lenguage ";
            	
		header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/suvirProblemaJuez.php");
		exit();  
        }
        }else{
            echo "ponga el codigo del problema";
            include '../vista/suvirProblemaJuez.php';
            header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/suvirProblemaJuez.php");
		exit();  
        }
    }else{ 
        echo "seleccione lenguage";
       
        header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/suvirProblemaJuez.php");
		exit();  
        }
    }else{
        echo "subir codigo";
        include '../vista/suvirProblemaJuez.php';
        header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/suvirProblemaJuez.php");
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
            $mensaje=$juez->compilarPrograma($tipoCodigo,"Main.java",$titulo);
        
        }
        if("c"==$tipoCodigo &&  $titulo!== "")
        {
         $fp=fopen("Main.c" ,"w");
        fwrite( $fp,$codigoFuente);
        fclose($fp) ;
         $mensaje=$juez->compilarPrograma($tipoCodigo,"Main.c",$titulo);
        
        }   
        if("cpp"==$tipoCodigo && $titulo!== "")
        {
            $fp=fopen("Main.cpp" ,"w");
        fwrite( $fp,$codigoFuente);
        fclose($fp) ;
         $mensaje=$juez->compilarPrograma($tipoCodigo,"Main.cpp",$titulo);
        }
        
        }else{
            echo "ingrese el codigo del problema";
            include '../vista/suvirProblemaJuez.php';
        }
    }

?>
</body>
</html>
