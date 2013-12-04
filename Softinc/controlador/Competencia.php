<?php
if(isset($_POST['competencia'])){  //ver problemas de una competencia
session_start();
$competencia=$_POST['competencia'];
 $contenedor         =  array();
 $contenedor         =  explode("_", $competencia);
 $competencia        =  $contenedor[1];
 $nombre_competencia =  $contenedor[2];





include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar='SELECT equipo_usuario.id_usuario, competencia.id_competencia
                      FROM competencia,competencia_equipo, equipo, equipo_usuario
                      where competencia.id_competencia=competencia_equipo.id_competencia and
                      competencia_equipo.id_equipo=equipo.id_equipo and
                      equipo_usuario.id_equipo=equipo.id_equipo and competencia.id_competencia='.$competencia;
        
        $result     = pg_query($seleccionar) or die('ERROR AL OBTENER USUARIO-CONSULTA.PHP: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $existe=false;
        for($i=0;$i<=$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            if($line['id_usuario']==$_SESSION["id_usuario"] || $_SESSION["nombre_rol"]=="comite"){
                $existe=true;
                break;
            }
        }  
        if($existe==true){
            require '../modelo/ConsultaCompetencia.php';
            $consulta=new ConsultaCompetencia();
            echo $consulta->generarProblemasCompetencia2($competencia);
           echo '<input type="hidden" value='.$competencia.' name="id_competencia" >';
            
        }else{
            echo 'Usted <Strong>'.$_SESSION["user_usuario"].'</Strong> no tiene acceso a esta competencia ' ;
 }
}







if(isset($_POST['crear_competencia'])){ //crear competencia
    include '../modelo/ConsultaCompetencia.php';
    session_start();
	$extraer=new verificarCompetenciaExiste();
    $existe=$extraer->existe($_POST['nombre_competencia']);
   if($existe==true )
   {
	
	
	
    $nombre_competencia =$_POST['nombre_competencia'];
    $fecha_inicio       =$_POST['fecha_inicio'];
    $fecha_final        =$_POST['fecha_fin'];
    $hora_inicio        =$_POST['hora_ini'];
    $hora_final         =$_POST['hora_fin'];
    $competencia=new ConsultaCompetencia();
    $competencia->crearCompetencia($nombre_competencia, $fecha_inicio,$fecha_final, $hora_inicio, $hora_final, $_SESSION["id_usuario"]);
    $id_competencia=$competencia->getIDCompetencia($nombre_competencia);
    $lenguajes=$_POST['configurador'];

    $competencia->configuracion($id_competencia, $lenguajes);
    require  '../vista/ContenidoCompetencia.php';
	else{
        header("Location: ../vista/CrearCompetencia.php");
      
   }
}






if(isset($_POST['id_competencia'])){ //crear competencia
$id_competencia=$_POST['id_competencia'];
    $contenedor         =  array();
    $contenedor         =  explode("_", $id_competencia);
    $id_competencia     =  $contenedor[1];
require  '../vista/CompetenciaEquipo.php';
}



if(isset($_POST['id_equipo'])){ //crear competencia
    $id_equipo          =$_POST['id_equipo'];
    $contenedor         =  array();
    $contenedor         =  explode("_", $id_equipo);
    $id_equipo          =  $contenedor[1];
require  '../vista/CompetenciaEquipoUsuario.php';
}




if(isset($_POST['add_problema'])){
    
    $id_competencia     =  $_POST['add_problema'];
    $contenedor         =  array();
    $contenedor         =  explode("_", $id_competencia);
    $id_competencia     =  $contenedor[1];
    $nombre_competencia =  $contenedor[2];
    require '../vista/ContenidoCompetencia.php';
}



if(isset($_POST['eliminarDeCompetencia'])){ //eliminar equipos y problemas de la competencia 
    $id_competencia     =$_POST['eliminarDeCompetencia'];
    $contenedor         =  array();
    $contenedor         =  explode("_", $id_competencia);
    $id_competencia     =  $contenedor[1];
    $nombre_competencia     =  $contenedor[2];
require  '../vista/EditaCompetenciaEliminar.php';
}






if(isset($_POST['eliminarProblema'])){ //eliminar problemas de la competencia 
    include '../modelo/cnx.php';
    $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
  $nombre_competencia   =$_POST['nombre_competencia'];
  $id_competencia       =$_POST['idcompetencia'];
  $arrayIdProblemas     =$_POST['problemasCompetencia'];
  //var_dump($arrayIdProblemas);
  for($i=0;$i<count($arrayIdProblemas);$i++){
    $eliminar   =   "DELETE FROM competencia_problema
    WHERE competencia_problema.id_problema=$arrayIdProblemas[$i];";
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  }
require  '../vista/EditaCompetenciaEliminar.php';
}



if(isset($_POST['irEliminarEquipos'])){ //ir a eliminar equipos de la competencia 
    $id_competencia     =$_POST['idcompetencia'];
    $nombre_competencia =$_POST['nombre_competencia'];
    require  '../vista/EliminarEquiposCompetencia.php';
}







if(isset($_POST['deleteEquipo'])){ //eliminar problemas de la competencia 
    include '../modelo/cnx.php';
    $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
    $nombre_competencia   =     $_POST['nombre_competencia'];
    $id_competencia       =     $_POST['idcompetencia'];
    
    $arrayIdEquipos       =     $_POST['equiposCompetencia'];
  for($i=0;$i<count( $arrayIdEquipos );$i++){
    $eliminar   =   "DELETE FROM competencia_equipo
                     WHERE id_equipo=$arrayIdEquipos[$i];";
    $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  }
  
require  '../vista/EliminarEquiposCompetencia.php';
}







?>
