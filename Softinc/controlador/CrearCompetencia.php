<?php
include '../modelo/Competencia.php';
session_start();
$nombre_competencia =$_POST['nombre_competencia'];
$fecha_inicio       =$_POST['fecha_inicio'];
$hora               =$_POST['hora'];
$duracion           =$_POST['duracion'];
$competencia=new Competencia();
$competencia->crearCompetencia($nombre_competencia, $fecha_inicio, $hora, $duracion);

//require  '../vista/ContenidoCompetencia.php';
header("Location: ../vista/ContenidoCompetencia.php");

?>
