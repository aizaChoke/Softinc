<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="../vista/css/Decoracion.css" type="text/css">
    </head>
    <body>
        <form action="presentarCompetencia.php" method="post">
       <?php
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        session_start();
        $seleccionar='SELECT id_competencia_usuario, id_usuario, id_competencia
                      FROM competencia_usuario
                      where id_competencia='.$_POST['id_competencia'].'';
        
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

            $competencia=$_POST['id_competencia'];
            require '../modelo/ConsultaCompetencia.php';
            $consulta=new ConsultaCompetencia();
            echo $consulta->generarProblemasCompetencia($competencia);
           echo '<input type="hidden" value='.$competencia.' name="id_competencia" >';
            
        }else{
            echo 'Usted <Strong>'.$_SESSION["user_usuario"].'</Strong> no tiene acceso a esta competencia ' ;
 }
?>
        </form>
    </body>
</html>

