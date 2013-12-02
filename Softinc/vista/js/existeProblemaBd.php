<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $problema = $_REQUEST['nombreP'];
       
      if(!empty($user)) {
            comprobar($problema);
      }
       
      function comprobar($problema) {
          
            $sql = pg_query("SELECT 
          problema.id_problema, 
          problema.nombre_problema
          FROM 
          public.problema
          where  
          problema.nombre_problema='$problema'; ");
             
            $contar = pg_num_rows($sql);
             
            if($contar == 0) 
                {
                echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
            }else{
                  echo "<span style='font-weight:bold;color:red;'>  Problema existente</span>";
            }
      }

?>