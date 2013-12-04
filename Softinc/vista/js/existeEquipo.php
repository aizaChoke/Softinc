<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $equipo = $_REQUEST['nombreE'];
       
      if(!empty($user)) {
            comprobar($equipo);
      }
       
      function comprobar($equipo) {
          
            $sql = pg_query("SELECT 
  equipo.nombre_equipo
FROM 
  public.equipo
where
equipo.nombre_equipo='$equipo'
  ;

 ");
             
            $contar = pg_num_rows($sql);
             
            if($contar == 0) 
                {
                echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
            }else{
                  echo "<span style='font-weight:bold;color:red;'>  Equipo ya  existente</span>";
            }
      }

?>