<?php
if(isset($_POST['competencia'])){  //ver problemas de una competencia
$competencia=$_POST['competencia'];
 $contenedor         =  array();
 $contenedor         =  explode("_", $competencia);
 $id_problema        =  $contenedor[1];
require '../modelo/ConsultaCompetencia.php';
$consulta=new ConsultaCompetencia();
echo $consulta->generarProblemasCompetencia($id_problema);
}

if(isset($_POST['crear_competencia'])){ //crear competencia
    include '../modelo/ConsultaCompetencia.php';
    session_start();
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



?>
