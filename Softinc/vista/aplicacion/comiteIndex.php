<?php
session_start();
?>
<div>
   <table class="tabla-principal">
       <tr>
           <td class="contenedor-barra-izquierda">
                <ul class="sidebar">
                    <h4>Problemas:</h4>
                    <li><a href="../CreacionProblema.php" target="frame-principal">Crear problema</a></li>
                    <li><a href="../SubirArchivo.php" target="frame-principal">Subir Archivos</a></li>
                    <li><a href="../EliminarProblema.php" target="frame-principal">Eliminar problema</a></li>
                    <li><a href="../descargar_archivo.php" target="frame-principal">Ver problema</a></li>
                    <li><a href="../descargarProblemaComite.php" target="frame-principal">Descargar solucion</a></li>
                    <li><a href="../estaditicasEntrenamiento.php"  target="frame-principal">Estadistica entrenamiento </a></li>
                    <h4>Competencias:</h4>
                    <li><a href="../CrearCompetencia.php"  target="frame-principal" >Crear</a></li>
                    <li><a href="../EditarCompetencia.php" target="frame-principal">Modificar Competencia</a></li>
                    <li><a href="../CompetenciaActual.php" target="frame-principal">En servicio</a></li>
                    <li><a href="../CompetenciaProxima.php" target="frame-principal">Proximas</a></li>
                    <li><a href="../CompetenciaAnterior.php" target="frame-principal">Anteriores</a></li>
                    <li><a href="../Competencia.php" target="frame-principal">Competencias</a></li>
                       <li><a href="../listaCompetencia.php"  target="frame-principal" >Lista competencia</a></li>
                    
                    <h4>Equipos:</h4>
                    <li><a href="../CrearEquipo.php" target="frame-principal">Crear Equipo</a></li>
                    <li><a href="../AgregarUsuarios.php" target="frame-principal">Opciones</a></li>
                    
                    <h4>Ranking</h4>
                     <li><a href="../tablaProblemaMasResueltos.php"   target="frame-principal">Ranking  problema mas faciles  </a></li>
                     <li><a href="../tablaProblemaMenosResueltos.php"  target="frame-principal">Ranking  problema mas complicadas </a></li>
                     <li><a href="../rankinGlobalGanador.php"  target="frame-principal">Ganador entrenamiento </a></li> 
                                     
                </ul>
              
             <!-- <ul class="sidebar">
                     <label>RANKING :</label>
                    <li><a href="../listaRankingGlobalGanador.php">Problemas mas resueltos</a></li>
                    <li><a href="#">Top 10 olimpistas</a></li>
                </ul>-->
           </td>
           <td><iframe name="frame-principal" src="introduccion.php" width="100%" height="100%" frameborder="0"></iframe></td>
       </tr>
   </table>
</div>