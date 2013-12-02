<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $problema = $_REQUEST['nombreP'];
   $id=$_REQUEST['id'];
       //echo "$id";
      if(!empty($problema)) {
            comprobar($problema,$id);
      }
       
      function comprobar($problema,$id) {
          
            $sql = pg_query("SELECT 
  competencia.id_competencia, 
  competencia.nombre_competencia, 
  problema.nombre_problema, 
  competencia_problema.id_competencia_problema, 
  problema.id_problema
FROM 
  public.competencia, 
  public.problema, 
  public.competencia_problema
WHERE 
  competencia_problema.id_competencia = competencia.id_competencia AND
  competencia_problema.id_problema = problema.id_problema and 
  competencia.id_competencia=$id and
   problema.id_problema='$problema'
  ;");
             
            $contar = pg_fetch_array($sql);
             
            echo "<span style='font-weight:bold;color:green;'>El nombre del problema es:".$contar['nombre_problema']."</span>";
               
      }
?>
