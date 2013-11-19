
<?php 
 include 'cnx.php';
 $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
 session_start();
//$_SESSION["ci_usuario"];

class Juzgar 
{
               private $nombreArchivo;
               private $numerador;
               private $mensaje;
               
    function __construct() {
        $this->nombreArchivo="";
        $this->numerador=0;
        $this->mensaje="";
    }
    
    function compilarPrograma($lenguaje, $CodigoFuente, $titulo)     
    {
        include 'cronometro.php' ;
        $casio = new cronometro();
        $compilar="falla";
        $bandera=true;
        $id_usuario=$_SESSION["id_usuario"];
        echo "--$id_usuario--";
        $hora = date("H:i",time());
        list($ho , $minut) = explode(':', $hora);
        $hora=date("H:i",mktime($ho-4, $minut, 0));
        $fecha = date('Y-n-d');
        echo $fecha;
       if(!strcmp($lenguaje, "java") )
        { 
               if(exiteArchivo("../archivo_comite/",$titulo)==true)//--------------------
              {
            $texto = file_get_contents("$CodigoFuente");
            //$texto = nl2br($texto);
            $nombreSinExtencion=explode(".",$CodigoFuente);
           
            if(file_exists("$nombreSinExtencion[0].class") == 1)
            {
                 //echo "$nombreSinExtencion[0].class";
                 
                 unlink("$nombreSinExtencion[0].class");
               
            }
           // echo "&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&"; 
            echo $CodigoFuente;
            exec("javac $CodigoFuente");
           // exec("java principal < ../archivo/problema/1/1.in  >../archivo/olimpista/1/1.out");
           //echo file_exists("$nombreSinExtencion[0].class");
            if(file_exists("$nombreSinExtencion[0].class") == 1)  
            { 
                $compilar="bueno";
                $this->nombreArchivo = substr($CodigoFuente,0,strrpos($CodigoFuente, '.'));   
              
               //echo ".........................".$nombreSinExtencion[0]."....................";  
                $tipo1 = array ("in");
                $tipo2 = array ("sol");
               $entrada=listar_ficheros($tipo1,"../archivo_comite/$titulo/");
              for($i=0;$i<sizeof($entrada);$i++)
              { 
                  $crearArchivo1=explode(".",$entrada[$i]);
                  //echo "*$crearArchivo1[0]*";
                  fopen("../archivo_olimpista/$id_usuario/$titulo/$crearArchivo1[0].sol", "w+");
                 
              }
               
               $solucion=listar_ficheros($tipo2,"../archivo_olimpista/$id_usuario/$titulo/");
               echo "$titulo";
               exec("powershell.exe  mkdir ../archivo_olimpista/$id_usuario/$titulo");
               
             for($i=0;$i< sizeof($solucion);$i++)
               {
                
                   $j=$i+1;
                
                exec( "java $nombreSinExtencion[0] < ../archivo_comite/$titulo/$entrada[$i]  >../archivo_olimpista/$id_usuario/$titulo/$solucion[$i]");
            
              // eliminafila("../archivo_olimpista/$titulo/$solucion[$i]");
               }
               $timeEjecucion=($casio->stop(true, 2));
               $timeEjecucion1=explode(",",$timeEjecucion);
               $timeEjecucion2=$timeEjecucion1[0].".".$timeEjecucion1[1];
               if($timeEjecucion <30  )  
               {
                   $compilar="bueno";
                   //echo "holas1";
               if( CantidadDirencia("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo) == 0)
                   {
                  // echo "holas2";
                   $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (1,$id_usuario ,$titulo,'$texto','$fecha','$hora',100, 'yes' ,$timeEjecucion2);";
                   pg_query($usuariosube);
                   echo "yes";
                     
                 }else{
                     if(leerOutputFormatError("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo)=="yes")
                     {
                       //  echo "entro--------------------------------------------------------------------";
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/") >0)
                     {
                        
                     $porsentage=calificarPregunta("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo,$id_usuario);                       
                     $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (1,$id_usuario ,$titulo,'$texto','$fecha','$hora',$porsentage, 'WRONG ANSWER' ,$timeEjecucion2);";
                     pg_query($usuariosube);
                     echo "WRONG ANSWER";
                     }
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/")==0)
                     {
                        $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (1,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'OUTPUT FORMAT ERROR' ,$timeEjecucion2);";
                        pg_query($usuariosube);
                   
                        
                           echo "OUTPUT FORMAT ERROR";
                     } 
                     }else{
                    $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (1,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'RUNTIME ERROR' ,$timeEjecucion2);";
                    pg_query($usuariosube);
                    echo "RUNTIME ERROR";
                        
                     }
                     
                 }
               }else{
                     $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (1,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'exsepcion time' ,$timeEjecucion2);";
                    pg_query($usuariosube);
                   echo "exsepcion time";
               }
            }
        }else{
            echo "archivos no exiten";
            $bandera=false;
        }
        }
       
        if(!strcmp($lenguaje, "c"))//*************************************************************************
        {
                if(exiteArchivo("../archivo_comite/",$titulo)==true)//--------------------
              {
            $texto = file_get_contents("$CodigoFuente");
            //$texto = nl2br($texto);
            $nombreSinExtencion=explode(".",$CodigoFuente);
           
            if(file_exists("$nombreSinExtencion[0].exe") == 1)
            {
                 //echo "$nombreSinExtencion[0].class";
                 
                 unlink("$nombreSinExtencion[0].exe");
               
            }
           // echo "&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&"; 
            
            exec("powershell.exe gcc -o $CodigoFuente $nombreSinExtencion[0]");
           // exec("java principal < ../archivo/problema/1/1.in  >../archivo/olimpista/1/1.out");
           //echo file_exists("$nombreSinExtencion[0].class");
            if(file_exists("$nombreSinExtencion[0].exe") == 1)  
            { 
                $compilar="bueno";
                $this->nombreArchivo = substr($CodigoFuente,0,strrpos($CodigoFuente, '.'));   
              
               //echo ".........................".$nombreSinExtencion[0]."....................";  
                $tipo1 = array ("in");
                $tipo2 = array ("sol");
               $entrada=listar_ficheros($tipo1,"../archivo_comite/$titulo/");
              for($i=0;$i<sizeof($entrada);$i++)
              { 
                  $crearArchivo1=explode(".",$entrada[$i]);
              
                  fopen("../archivo_olimpista/$id_usuario/$titulo/$crearArchivo1[0].sol", "w+");
                 
              }
               
               $solucion=listar_ficheros($tipo2,"../archivo_olimpista/$id_usuario/$titulo/");
               echo "$titulo";
               exec("powershell.exe  mkdir ../archivo_olimpista/$id_usuario/$titulo");
               
             for($i=0;$i< sizeof($solucion);$i++)
               {
                
                   $j=$i+1;
                
                exec( "$nombreSinExtencion[0].exe < ../archivo_comite/$titulo/$entrada[$i]  >../archivo_olimpista/$id_usuario/$titulo/$solucion[$i]");
            
              // eliminafila("../archivo_olimpista/$titulo/$solucion[$i]");
               }
              
               if(($casio->stop(true, 2)) <30  )  
               {
                   $compilar="bueno";
                   //echo "holas1";
               if( CantidadDirencia("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo) == 0)
                   {
                   $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (2,$id_usuario ,$titulo,'$texto','$fecha','$hora',100, 'yes' ,$timeEjecucion);";
                    pg_query($usuariosube);
                   echo "yes";
                     
                 }else{
                     if(leerOutputFormatError("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo)=="yes")
                     {
                       //  echo "entro--------------------------------------------------------------------";
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/") >0)
                     {
                        
                         $porsentage=calificarPregunta("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo,$id_usuario);                       
                         $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (2,$id_usuario ,$titulo,'$texto','$fecha','$hora',$porsentage, 'WRONG ANSWER' ,$timeEjecucion);";
                          pg_query($usuariosube);
                         echo "WRONG ANSWER";
                 
                     }
                     
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/")==0)
                     {
                       $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (2,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'OUTPUT FORMAT ERROR' ,$timeEjecucion);";
                        pg_query($usuariosube);
                        echo "OUTPUT FORMAT ERROR";
                     } 
                     }else{
                     $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (2,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'RUNTIME ERROR' ,$timeEjecucion);";
                    pg_query($usuariosube);
                    echo "RUNTIME ERROR";
                     }
                     
                 }
               }else{
                   $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (2,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'exsepcion time' ,$timeEjecucion);";
                   pg_query($usuariosube);
                   echo "exsepcion time";
                  
               }
            }
        }else{
            echo "archivos no exiten";
            $bandera=false;
        }
        }
        
        if(!strcmp($lenguaje, "cpp"))
        {  
              if(exiteArchivo("../archivo_comite/",$titulo)==true)//--------------------
              {
            $texto = file_get_contents("$CodigoFuente");
            //$texto = nl2br($texto);
            $nombreSinExtencion=explode(".",$CodigoFuente);
           
            if(file_exists("$nombreSinExtencion[0].class") == 1)
            {
                 //echo "$nombreSinExtencion[0].class";
                 
                 unlink("$nombreSinExtencion[0].class");
               
            }
           // echo "&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&"; 
            
            exec("g++ -o $CodigoFuente $nombreSinExtencion[0]");
           // exec("java principal < ../archivo/problema/1/1.in  >../archivo/olimpista/1/1.out");
           //echo file_exists("$nombreSinExtencion[0].class");
            if(file_exists("$nombreSinExtencion[0].class") == 1)  
            { 
                $compilar="bueno";
                $this->nombreArchivo = substr($CodigoFuente,0,strrpos($CodigoFuente, '.'));   
              
               //echo ".........................".$nombreSinExtencion[0]."....................";  
                $tipo1 = array ("in");
                $tipo2 = array ("sol");
               $entrada=listar_ficheros($tipo1,"../archivo_comite/$titulo/");
              for($i=0;$i<sizeof($entrada);$i++)
              { 
                  $crearArchivo1=explode(".",$entrada[$i]);
              
                  fopen("../archivo_olimpista/$id_usuario/$titulo/$crearArchivo1[0].sol", "w+");
                 
              }
               
               $solucion=listar_ficheros($tipo2,"../archivo_olimpista/$id_usuario/$titulo/");
               echo "$titulo";
               exec("powershell.exe  mkdir ../archivo_olimpista/$id_usuario/$titulo");
               
             for($i=0;$i< sizeof($solucion);$i++)
               {
                
                   $j=$i+1;
                
                exec( "$nombreSinExtencion[0].exe < ../archivo_comite/$titulo/$entrada[$i]  >../archivo_olimpista/$id_usuario/$titulo/$solucion[$i]");
            
              // eliminafila("../archivo_olimpista/$titulo/$solucion[$i]");
               }
              
               if(($casio->stop(true, 2)) <30  )  
               {
                   $compilar="bueno";
                   //echo "holas1";
              if( CantidadDirencia("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo) == 0)
                   {
                   $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',100, 'yes' ,$timeEjecucion);";
                    pg_query($usuariosube);
                   echo "yes";
                     
                 }else{
                     if(leerOutputFormatError("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo)=="yes")
                     {
                       //  echo "entro--------------------------------------------------------------------";
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/") >0)
                     {
                        
                         $porsentage=calificarPregunta("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/",$titulo,$id_usuario);                       
                         $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',$porsentage, 'WRONG ANSWER' ,$timeEjecucion);";
                          pg_query($usuariosube);
                         echo "WRONG ANSWER";
                 
                     }
                     
                     if(leerWronGanswer("../archivo_olimpista/$id_usuario/$titulo/", "../archivo_comite/$titulo/")==0)
                     {
                       $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'OUTPUT FORMAT ERROR' ,$timeEjecucion);";
                        pg_query($usuariosube);
                        echo "OUTPUT FORMAT ERROR";
                     } 
                     }else{
                     $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'RUNTIME ERROR' ,$timeEjecucion);";
                    pg_query($usuariosube);
                    echo "RUNTIME ERROR";
                     }
                     
                 }
               }else{
                   $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',0, 'exsepcion time' ,$timeEjecucion);";
                   pg_query($usuariosube);
                   echo "exsepcion time";
                  
               }
            }//------------------------------------------------////////////////*/*/*/
        }else{
            echo "archivos no exiten";
            $bandera=false;
        }
        }
        
        if($compilar=="falla" && $bandera==true)
        {
                    $usuariosube="insert into solucion_olimpista(id_lenguaje, id_usuario ,id_problema, texto_solucion_olimpista, fecha_subida, hora_subida, calificacion_olimpista, mensage_calificacion, tiempo_ejecucion_olimpista) values (3,$id_usuario ,$titulo,'$texto','$fecha','$hora',0,'error compilar' ,0);";
                    pg_query($usuariosube);
                    echo ".....error compilar";   
        }
  
   // echo "hola";
   // header( "Status: 301 Moved Permanently", false, 1000);
  //  header("Location: ../vista/problemaResueltoUsuario.php");
     //exit();
      

        //return $this->mensaje;
    }
}
 
        
function leer_Archivo($nombre_fichero){
        
   $fichero_texto = fopen ($nombre_fichero, "r");

   $contenido_fichero = fread($fichero_texto, filesize($nombre_fichero));
   return $contenido_fichero;
}

function leerPorLineas($archivo){
$file = fopen($archivo, "r");
$lineas="";
while(!feof($file))
{
//echo fgets($file). "<br />";
   $lineas=$lineas.  fgets($file);
}
//echo $lineas;
fclose($file);
return $lineas;
}


function leerRunTimeError($archivo1, $archivo2)
{
    $file1 = fopen($archivo1, "rb");
    $file2 = fopen($archivo2, "rb");
    $res="yes";
    //$nombre_fichero = ‘fichero.txt’;
    //$fichero = fopen($nombre_fichero,'rb'');
    while ( ($linea1 = fgets($file1)) !== false && ($linea2 = fgets($file2)) !== false && $res == "yes" ) {
    
        if($linea1==$linea2)
        {
            $res="yes";
        }else{
            
            $res="no";
            
        }
    }
    fclose($file1);
    fclose($file2);
    return  $res;
    
}

function leerWronGanswer($archivo1, $archivo2)
{
    $res="yes";
    $contar=0;
   // echo "contado".$contar;
    $tipo1 = array ("sol");
     $tipo2 = array ("out");
     //echo "$archivo2 problema-----------??????????----------------------------";
    $solucion=listar_ficheros ($tipo1, $archivo1);//olimpista
    $salida=listar_ficheros ($tipo2, $archivo2);//problema
    
    for($j=0; $j< sizeof($salida); $j++ )
    {
        //echo "$archivo1.$solucion[$j] dajflsdhfklsdjhflkasjhl";
        $file1 = fopen($archivo1.$solucion[$j], "rb");
        $file2 = fopen($archivo2.$salida[$j], "rb");
    //$nombre_fichero = ‘fichero.txt’;
    //$fichero = fopen($nombre_fichero,'rb'');
      //  echo "casi entrar";
     
               
               $suma=contarArchivo($archivo2.$salida[$j]);
    while ( ($linea1 = fgets($file1)) !== false && ($linea2 = fgets($file2)) !== false && $suma !== 0) {
     // echo "$linea1 && $linea2";
        $suma--;
        if($linea1==$linea2)
        {
          echo "$linea2";
           $contar++;
        }
        
    }
    fclose($file1);
    fclose($file2);
    }
    echo "$contar";
    return  $contar;
    
}

function calificarPregunta($archivo1, $archivo2,$titu,$idUser)//---------------------------------------------
{
   
    $contar=0;
    $nota1=0;
    $linea=0;
    $tipo1 = array ("sol");
       $tipo2 = array ("out");
     $solucion=listar_ficheros ($tipo1, $archivo1);//olimpista
    $salida=listar_ficheros ($tipo2, $archivo2);//problema comite
    $porsentage=0;
    for($j=0; $j< sizeof($solucion); $j++ )
    {
        $file1 = fopen($archivo1.$solucion[$j], "rb");
        $file2 = fopen($archivo2.$salida[$j], "rb");
    //$nombre_fichero = ‘fichero.txt’;
    //$fichero = fopen($nombre_fichero,'rb'');
   
        $nota=puntageNota($titu,$salida[$j]);
        
    while ( ($linea1 = fgets($file1)) !== false && ($linea2 = fgets($file2)) !== false  ) 
        {
    
        if($linea1==$linea2)
        {
           $contar++;
        }
        $linea++;
        
    }
    
    fclose($file1);
    fclose($file2);
    
    $puntage=($nota*$contar)/$linea;
    $porsentage=($puntage*100)/$nota;
    
    $nota1=$nota1+$porsentage;
    $contar=0; 
    $linea=0;
    }
    $notafinal=$nota1/sizeof($solucion);
    echo "----*$notafinal*-----";
    return $notafinal;
    
}

function puntageNota($titulo,$outArchivo)//********************************************
{
    
    $nombreArchivoSinpunto=explode(".",$outArchivo);
    
    $nombreArchivo=$nombreArchivoSinpunto[0].$nombreArchivoSinpunto[1];
    
    $notaOut="SELECT 
  archivo.puntos_archivo
FROM 
  public.archivo
where
archivo.id_problema=$titulo and
archivo.nombre_archivo='$nombreArchivo'
order by 
nombre_archivo
  ;";
    $notaProblema=  pg_query($notaOut);
    
    $puntage= pg_fetch_array($notaProblema);
    
    return $puntage[0];
}
    function leerOutputFormatError($archivo1,$archivo2,$num)
    {
    $res="yes";
    $contar=0;
    $contar1=0;
    $tipo1 = array ("sol");
       $tipo2 = array ("out");
    $solucion=listar_ficheros ($tipo1, $archivo1);//olimpista
    $salida=listar_ficheros ($tipo2, $archivo2);//problema
    //echo "$archivo2@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@$salida[0]";
    for($j=0; $j< sizeof($solucion); $j++ )
    {
        //echo $archivo1.$solucion[$j]."@@@@@@@@@@@@@@@1";
      //  echo $archivo2.$salida[$j]."@@@@@@@@@@@@@@@2";
       $file1 = fopen($archivo1.$solucion[$j], "rb");
       $file2 = fopen($archivo2.$salida[$j], "rb");
        if(contarArchivo($archivo1.$solucion[$j])== contarArchivo($archivo2.$salida[$j]))
    {
    while ( ($linea1 = fgets($file1)) !== false && ($linea2 = fgets($file2)) !== false  ) {
    $contar1++;
     echo "--------------------";
        if($linea1!==$linea2)
        {
           
            if(limpia_espacios($linea1) == $linea2)
                {     echo "me despido";    
                  $contar++;
                }
                if(limpia_espacios($linea1)=="" && $linea2 !== "")
                {
                    $res="formato";
                   // echo "--------------------";
                }
        }
    }
    
    }else{
        $contar=-1;
        $i=sizeof($solucion)+1;
        $res="formato";
    }
    fclose($file1);
    fclose($file2);
    
    
    }
   // echo $contar."contado";
    if($contar==$contar1)
    {
        $res="formato";
        
    }
   // echo "$contar";
    //echo $res."-------------";
    return  $res;
    
    }
   function limpia_espacios($cadena)
    {
   
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
    }

function contarlineas($archivo1, $archivo2)
{
    $file1 = fopen($archivo1, "rb");
    $file2 = fopen($archivo2, "rb");
    $res="yes";
    $contar=0;
    //$nombre_fichero = ‘fichero.txt’;
    //$fichero = fopen($nombre_fichero,'rb'');
    while ( ($linea1 = fgets($file1)) !== false || ($linea2 = fgets($file2)) !== false  ) {
    
           $contar++;
        
    }
    fclose($file1);
    fclose($file2);
    return  $contar;
    
}



    function CantidadDirencia($archivo1, $archivo2,$num)
{
       $tipo1 = array ("sol");//olimpista
       $tipo2 = array ("out");//problema
   $solucion=listar_ficheros ($tipo1, $archivo1);//carpeta olimpista
   $salida=listar_ficheros ($tipo2, $archivo2);//carpeta problema
   $contar=0;
   $res="yes";
   
   for($j=0; $j< sizeof($solucion); $j++ )
   {
        $file1 = fopen($archivo1.$solucion[$j],"rb");//olimpista
        
        $file2 = fopen($archivo2.$salida[$j], "rb");//problema
        
  //  echo contarArchivo($archivo1.$solucion[$j])."holaaaaa1".$archivo1.$solucion[$j]."olimpista";
   // echo contarArchivo($archivo2.$salida[$j])."holaaaaaa2".$archivo2.$salida[$j]."";
    //echo contarArchivo($archivo2.$salida[$j])."chauuuuuuuuuuuuuuuuuu";
    if(contarArchivo($archivo1.$solucion[$j]) == contarArchivo($archivo2.$salida[$j]))
    { 
        $suma=contarArchivo($archivo2.$salida[$j]);
       // echo $suma."cahuuuuuuuuuuuu";
    while( ($linea1 = fgets($file1)) !== false  && ($linea2 = fgets($file2)) !== false && $suma!==0 ) 
        {
       $suma--;
       //echo "-$linea1-*-$linea2-";
         if(trim($linea1)!==trim($linea2) )
        {
            //echo "[[[***]]]]";
           $contar++;
           
        }
        /*
        if(trim($linea1)!==((trim($linea2))) && $suma ==0)
        {
            
            //echo "[[[***]]]]";
           if($contar>0)
           {
            $contar++;
           }
        }
         * 
         */
        
    }
     fclose($file1);
     fclose($file2);
    }else{
        
        $contar=-1;
        $j=sizeof($solucion)+1;
    }
   
}
return $contar;
}

function contarArchivo($archivo1)
{
    
    $file1 = fopen($archivo1, "rb");
    
    $contar=0;
    while ( ($linea1 = fgets($file1)) !== false   ) {
    
       
           $contar++;

        }
    fclose($file1);
    
    return $contar;
}

function listar_ficheros ($tipos, $carpeta){
    //Comprobamos que la carpeta existe
    $lista="";
    if (is_dir ($carpeta)){
        //Escaneamos la carpeta usando scandir
        $scanarray = scandir ($carpeta);
        $c=0;
        for ($i = 0; $i < count ($scanarray); $i++){
            //Eliminamos  "." and ".." del listado de ficheros
            if ($scanarray[$i] != "." && $scanarray[$i] != ".."){
		//No mostramos los subdirectorios
		if (is_file ($carpeta . "/" . $scanarray[$i])){
                        //Verificamos que la extension se encuentre en $tipos
			$thepath = pathinfo ($carpeta . "/" . $scanarray[$i]);
			if (in_array ($thepath['extension'], $tipos)){
				//echo $scanarray[$i] . "-----------";
                                
                                $lista[$c]=$scanarray[$i];
			
                                $c++;
                        }
                }
            }
        }
    } else {
        echo "La carpeta no existe";
    }
   return $lista;
 
}
function eliminafila($archivo)
{
            // echo $archivo."este es nuevo";
                $numlinea = 0; 
                $contar=0;
                $contar1=0;
                $lineas = file("$archivo") ;
              $textolinea = file_get_contents("$archivo");
              if($textolinea!=="")
              {
                foreach ($lineas as $nLinea => $dato)
                {
                    $contar1++;
                    if ($nLinea != $numlinea && $nLinea !== $contar1)
                    $info[] =$dato ;
                    
                }
                
                $documento = implode($info,"");
               // echo $documento."-"; 
               // echo "$contar1";
                file_put_contents("$archivo", $documento);
                //fclose($documento);
                
               
                    //$documento="";
                
                   //echo "o".($info[])."o";
                
              }
    return null;
}

function exiteArchivo($archivo,$nombre)
{
    echo "hola";
    $directorio=opendir($archivo); 
    $res=false;
  while ($archivo = readdir($directorio))
  {
      if($archivo==$nombre)
      {
          $res=true;
        //echo "$archivo<br>";
      }
  }
closedir($directorio); 
    return $res;
}

?>
