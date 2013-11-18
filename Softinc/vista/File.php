<?php

        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        session_start();
        $seleccionar='SELECT id_competencia_usuario, id_usuario, id_competencia
                      FROM competencia_usuario
                      where id_competencia='.$_POST['valorCaja1'].'';
        
        $result     = pg_query($seleccionar) or die('ERROR AL OBTENER USUARIO-CONSULTA.PHP: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $existe=false;
        for($i=0;$i<=$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            if($line['id_usuario']==$_SESSION["id_usuario"]){
                $existe=true;
                break;
            }
        }  
        if($existe==true){

            $competencia=$_POST['valorCaja1'];
            require '../modelo/Consulta.php';
            $consulta=new Consulta();
            echo $consulta->generarProblemasCompetencia($competencia);


        }else{
            echo 'Usted <Strong>'.$_SESSION["user_usuario"].'</Strong> no tiene acceso a esta competencia ' ;
     
 }
?>
