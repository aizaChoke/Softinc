<?php
include '../modelo/Competencia.php';
session_start();
$nombre_competencia =$_POST['nombre_competencia'];
$fecha_inicio       =$_POST['fecha_inicio'];
$fecha_final        =$_POST['fecha_fin'];
$hora_inicio        =$_POST['hora_ini'];
$hora_final         =$_POST['hora_fin'];
$competencia=new Competencia();
$competencia->crearCompetencia($nombre_competencia, $fecha_inicio,$fecha_final, $hora_inicio, $hora_final, $_SESSION["id_usuario"]);
$id_competencia=$competencia->getIDCompetencia($nombre_competencia);
require  '../vista/ContenidoCompetencia.php';
//header("Location: ../vista/ContenidoCompetencia.php");

?>
