<?php

include '../modelo/cnx.php';
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

if(isset($_POST['agregar'])){
$problemas=  array();
$problemas=$_POST['problemas'];
$num_problemas=  count($problemas);
$id_competencia=$_POST['idCompetencia'];
$indices=array();




 $seleccionar=   'SELECT id_competencia, id_problema
  FROM competencia_tiene
  where id_competencia='.$id_competencia;
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);

        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            for($j=0;$j<count($problemas);$j++){
                if($line['id_problema']==$problemas[$j]){
                     $indeces[]=$j;
                } 
            }
             
        }  
       for($i=0;$i<count($indeces); $i++){
           unset($problemas[$indeces[$i]]);
        } 



        var_dump($problemas);




if(count($problemas)>0){

for($i=0;$i<count($problemas);$i++){
  $insertar= "INSERT INTO competencia_tiene(id_competencia, id_problema)
            VALUES ('$id_competencia', '$problemas[$i]');";
$result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
}
}
 header("Location: ../vista/ContenidoCompetencia.php");




}
if(isset($_POST['terminar'])){
     header("Location: ../vista/CompetenciaProxima.php");
}
?>
