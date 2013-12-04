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
        $seleccionar='SELECT equipo_usuario.id_usuario, competencia.id_competencia
                      FROM competencia,competencia_equipo, equipo, equipo_usuario
                      where competencia.id_competencia=competencia_equipo.id_competencia and
                      competencia_equipo.id_equipo=equipo.id_equipo and
                      equipo_usuario.id_equipo=equipo.id_equipo and competencia.id_competencia='.$_POST['id_competencia'].'';
        
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
            
        }else if( $_SESSION["nombre_rol"]=="comite"){
            $competencia=$_POST['id_competencia'];
            require '../modelo/ConsultaCompetencia.php';
            $consulta=new ConsultaCompetencia();
            echo $consulta->generarProblemasCompetencia2($competencia);
            echo '<input type="hidden" value='.$competencia.' name="id_competencia" >';
            
        }else{
            echo 'Usted <Strong>'.$_SESSION["user_usuario"].'</Strong> no tiene acceso a esta competencia ' ;
        }
?>
        </form>
    </body>
</html>

