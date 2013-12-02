<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $competencia = $_REQUEST['nombreC'];
       
      if(!empty($user)) {
            comprobar($competencia);
      }
       
      function comprobar($competencia) {
          
            $sql = pg_query("SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia
FROM 
  public.competencia
where
 competencia.nombre_competencia='$competencia'
  ;
 ");
             
            $contar = pg_num_rows($sql);
             
            if($contar == 0) 
                {
                echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
            }else{
                  echo "<span style='font-weight:bold;color:red;'>  Copetencia ya  existente</span>";
            }
      }

?>