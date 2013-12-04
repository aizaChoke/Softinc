<?php

class ConsultaCompetencia {

    public $cuerpo;
    public $titulo;
    public $col;
    public $cierre;
    public $boton;
    public $formu;

        
    function __construct() {
        
        $this->cuerpo=array();
        $this->titulo="";
        $this->col="";
        $this->cierre="";
        $this->formu="";
    }
    
    ///////////////
    function crearCompetencia($nombre_olimpiada, $fecha_ini, $fecha_fin, $hora_ini, $hora_fin, $creador){
        include("../modelo/cnx.php");
        $inicio=$fecha_ini." ".$hora_ini;
        $fin=$fecha_fin." ".$hora_fin;
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $insertar= "INSERT INTO competencia(nombre_competencia, fecha_inicio_competencia, 
            fecha_fin_competencia, creador_competencia, fecha_creacion)
            VALUES ('$nombre_olimpiada', '$inicio', '$fin', '$creador', current_timestamp);";
        $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
              
    }
    
        function configuracion($id_competencia, $arreglo_lenguajes){
        
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        foreach ($arreglo_lenguajes as $value) {
        $insertar= "INSERT INTO competencia_lenguaje( id_competencia, id_lenguaje_competencia)
                                             VALUES ( '$id_competencia','$value');";
        $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());    
        }
        
    }
    
    
    
    
    
    
    
        function CompetenciaComite(){ //modificar competencia
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                $seleccionar='SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                              fecha_fin_competencia, creador_competencia, fecha_creacion
                              FROM competencia
                              where fecha_inicio_competencia>CURRENT_TIMESTAMP
                              and creador_competencia='.$_SESSION["id_usuario"];
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>NOMBRE</h4></td>';
        $this->formu.='<td><h4>Fecha Inicio</h4></td>';
        $this->formu.='<td><h4>Fecha final</h4></td>';
        $this->formu.='<td><h4>Agregar problemas y equipos</h4></td>';
        $this->formu.='<td><h4>Eliminar problemas y equipos</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_competencia'].'</td> 
                             <td>'.$line['nombre_competencia'].'</td>
                             <td>'.$line['fecha_inicio_competencia'].'</td> 
                             <td>'.$line['fecha_fin_competencia'].'</td> 
                             <td> <input type="submit" name="add_problema"            value="Agregar   _'.$line['id_competencia'].'_'.$line['nombre_competencia'].'"   style="width:65px"> </td> 
                             <td> <input type="submit" name="eliminarDeCompetencia"   value="Eliminar  _'.$line['id_competencia'].'_'.$line['nombre_competencia'].'"  style="width:65px"> </td> 
                            </tr>';                                                                                                                                                                    
            }  
        $this->formu.='</table>';
        return $this->formu;
    }  
    
    
    


    function anteriorCompetencia(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
$seleccionar='SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                    fecha_fin_competencia, creador_competencia
                    FROM competencia
                    where  fecha_fin_competencia<CURRENT_TIMESTAMP;';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>NOMBRE</h4></td>';
        $this->formu.='<td><h4>Fecha Inicio</h4></td>';
        $this->formu.='<td><h4>Fecha final</h4></td>';
        $this->formu.='<td><h4>Ver</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_competencia'].'</td> 
                             <td>'.$line['nombre_competencia'].'</td>
                             <td>'.$line['fecha_inicio_competencia'].'</td> 
                             <td>'.$line['fecha_fin_competencia'].'</td> 
                             <td><input type="submit" name="competencia"  style="width:100px" value="Ver problemas  _'.$line['id_competencia'].'_'.$line['nombre_competencia'].'"></td>                                    
                            </tr>';                                                                                                                                                                    
        }  
        $this->formu.='</table>';
        return $this->formu;
    }     
    
    
        function CompetenciaActual(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar='SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                fecha_fin_competencia, creador_competencia
                FROM competencia
                where CURRENT_TIMESTAMP between fecha_inicio_competencia and fecha_fin_competencia';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>NOMBRE</h4></td>';
        $this->formu.='<td><h4>Fecha Inicio</h4></td>';
        $this->formu.='<td><h4>Fecha final</h4></td>';
        $this->formu.='<td><h4>Ver</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_competencia'].'</td> 
                             <td>'.$line['nombre_competencia'].'</td>
                             <td>'.$line['fecha_inicio_competencia'].'</td> 
                             <td>'.$line['fecha_fin_competencia'].'</td> 
                             <td><input type="button" href="javascript:;" style="width:100px" onclick="realizaProceso('.$line['id_competencia'].');return false;" value="Ver problemas  _'.$line['id_competencia'].'"/></td>                                    
                            </tr>';                                                                                                                                                                    
            }  
        $this->formu.='</table>';
        return $this->formu;
    }  
    
    
        function siguienteCompetencia(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar='SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                      fecha_fin_competencia, creador_competencia
                      FROM competencia
                      where  fecha_inicio_competencia>CURRENT_TIMESTAMP;';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>NOMBRE</h4></td>';
        $this->formu.='<td><h4>Fecha Inicio</h4></td>';
        $this->formu.='<td><h4>Fecha final</h4></td>';
        $this->formu.='<td><h4>Ver</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_competencia'].'</td> 
                             <td>'.$line['nombre_competencia'].'</td>
                             <td>'.$line['fecha_inicio_competencia'].'</td> 
                             <td>'.$line['fecha_fin_competencia'].'</td>
                             <td><input type="submit" name="competencia"  style="width:100px" value="Ver problemas  _'.$line['id_competencia'].'_'.$line['nombre_competencia'].'"></td>
                            </tr>';                                                                                                                                                                    
        }  
        $this->formu.='</table>';
        return $this->formu;
    }  
    
    
    
    
        function competenciaCreadaComite(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar='SELECT id_competencia, id_usuario, nombre_competencia, fecha_inicio_competencia, fecha_fin_competencia
                      FROM competencia
                      where id_usuario='.$_SESSION["id_usuario"];
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>NOMBRE</h4></td>';
        $this->formu.='<td><h4>Fecha Inicio</h4></td>';
        $this->formu.='<td><h4>Fecha final</h4></td>';
        $this->formu.='<td><h4>Ver</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_competencia'].'</td> <td>'.$line['nombre_competencia'].'</td><td>'.$line['fecha_inicio_competencia'].'</td> <td>'.$line['fecha_fin_competencia'].'</td> <td><input type="submit" name="competencia"  value="Ver problemas  _'.$line['id_competencia'].'"></td>                                    
                            </tr>';                                                                                                                                                                    
        }  
        $this->formu.='</table>';
        return $this->formu;
    } 
    
    
    
    function getIDCompetencia($nombreCompetencia){
        $seleccionar='SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                        fecha_fin_competencia, creador_competencia
                        FROM competencia;';
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);

        $identificador=0;
        for($i=1;$i<=$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
           $identificador= $line['id_competencia'];
           
        }
        return $identificador;
    }

    /////////////////
    
    
        function generarEquiposCompetencia(){
            
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          //  session_start();
          $seleccionar="SELECT id_equipo, nombre_equipo
                        FROM equipo;";
    
          $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          $columnas   = pg_numrows($result);
        $this->formu.='<table>';
         $this->formu.='<tr><td>Identificador</td>';
          $this->formu.='<td>Nombre</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_equipo'].'</td> 
               <td>'.$line['nombre_equipo'].'</td>
               <td><input type="CHECKBOX" name="equipos[]" value='.$line['id_equipo'].'></td>
               </tr>';            
        }  
        $this->formu.='</table>';
        return $this->formu;    
    }
            function generaListaCompetenciaPermitidosComite(){
                      
                  include("../modelo/cnx.php");
                  $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                  session_start();
                  $seleccionar="SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                                fecha_fin_competencia, hora_inicio_competencia, hora_fin_competencia, creador_competencia
                                FROM competencia
                                where creador_competencia=".$_SESSION["id_usuario"];
    
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);
                $this->formu.='<select name = "idCompetencia">';
                for($i=0;$i<=$columnas-1; $i++){
                     $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                                   $this->formu.='<option value ='.$line['id_competencia'].'>'.$line['id_competencia']."-----".$line['nombre_competencia'].'</option>';
                }
                $this->formu.='</select>';

           return $this->formu;    
    }
    
        function generarProblemasCompetencia($id_competencia){  //sirve para descargar problemas

                                      
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          //  session_start();
          $seleccionar="SELECT problema.id_problema, id_usuario, nombre_problema
                        FROM problema, competencia_problema
                        where competencia_problema.id_problema=problema.id_problema
                        and competencia_problema.id_competencia=".$id_competencia;
    
          $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td>Identificador</td>';
        $this->formu.='<td>Nombre</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_problema'].'</td> 
               <td>'.$line['nombre_problema'].'</td>
               <td><a href="../archivo_comite/'.$line['id_problema'].'/'.$line['id_problema'].'.pdf">Descargar Enunciado</a></td>
               <td><input type="hidden" value='.$line['id_problema'].' name="enviar_solucion" ></td>
               <td><input type="submit" name="enviar_solucion"  value="enviar solucion" ></td>
               </tr>';
        }  
        $this->formu.='</table>';
        return $this->formu;    

    }
    
            function generarProblemasCompetencia2($id_competencia){  //sirve para competencias pasadas

                                      
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          //  session_start();
          $seleccionar="SELECT problema.id_problema, id_usuario, nombre_problema
                        FROM problema, competencia_problema
                        where competencia_problema.id_problema=problema.id_problema
                        and competencia_problema.id_competencia=".$id_competencia;
    
          $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td>Identificador</td>';
        $this->formu.='<td>Nombre</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_problema'].'</td> 
               <td>'.$line['nombre_problema'].'</td>
               <td><a href="../archivo_comite/'.$line['id_problema'].'/'.$line['id_problema'].'.pdf">Descargar Enunciado</a></td>
               </tr>';
        }  
        $this->formu.='</table>';
        return $this->formu;    

    }
    
    
    
    
       function ListaCompetenciaDeUsuario(){ //usuario en que competencias pertenece
                      
                  include("../modelo/cnx.php");
                  $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                  session_start();
                  $id_usuario=$_SESSION["id_usuario"];
                  $seleccionar="SELECT competencia.id_competencia, competencia.nombre_competencia, fecha_inicio_competencia, fecha_fin_competencia
                                FROM equipo_usuario, equipo, competencia_equipo, competencia, usuario
                                where competencia.id_competencia=competencia_equipo.id_competencia and
                                competencia_equipo.id_equipo=equipo.id_equipo and 
                                equipo.id_equipo=equipo_usuario.id_equipo and
                                equipo_usuario.id_usuario='$id_usuario'
                                group by competencia.id_competencia, competencia.nombre_competencia, fecha_inicio_competencia, fecha_fin_competencia
                                order by competencia.id_competencia desc";
                                
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);
                $this->formu.='<table><tr><td>Identificador</td>';
                $this->formu.='<td>Nombre Competencia</td>';
                $this->formu.='<td>Fecha Inicio</td>';
                $this->formu.='<td>Fecha Final</td></tr>';
                for($i=0;$i<=$columnas-1; $i++){
                     $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $this->formu.='<tr>             
                                   <td>'.$line['id_competencia'].'</td> 
                                   <td>'.$line['nombre_competencia'].'</td>
                                   <td>'.$line['fecha_inicio_competencia'].'</td>
                                   <td>'.$line['fecha_fin_competencia'].'</td>
                                   </tr>';
                }
                $this->formu.='</table>';

           return $this->formu;    
    }
    
    
    
    
    
    
           function ListaCompetencia(){ //usuario en que competencias pertenece
                      
                  include("../modelo/cnx.php");
                  $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                  session_start();
                  $seleccionar="SELECT id_competencia, nombre_competencia, fecha_inicio_competencia, 
                                fecha_fin_competencia, creador_competencia, fecha_creacion
                                FROM competencia;";
    
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);
                $this->formu.='<table><tr><td>Identificador</td>';
                $this->formu.='<td>Nombre Competencia</td>';
                $this->formu.='<td>Fecha Inicio</td>';
                $this->formu.='<td>Fecha Final</td></tr>';
                for($i=0;$i<=$columnas-1; $i++){
                     $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $this->formu.='<tr>             
                                   <td>'.$line['id_competencia'].'</td> 
                                   <td>'.$line['nombre_competencia'].'</td>
                                   <td>'.$line['fecha_inicio_competencia'].'</td>
                                   <td>'.$line['fecha_fin_competencia'].'</td>
                                   <td>'.$line['fecha_creacion'].'</td>
                                   <td><input type="submit" name="id_competencia"  value="Ver Equipos  _'.$line['id_competencia'].'"  style="width:85px"></td>
                                   <td><input type="submit" name="competencia"  value="Ver Problemas  _'.$line['id_competencia'].'_'.$line['nombre_competencia'].'"  style="width:100px"></td>
                                   </tr>';
                }
                $this->formu.='</table>';

           return $this->formu;    
    }
    
    
    
    
    
       function listaProblemasCompetencia($competencia){ //lista problemas de un competencia
                      
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                  session_start();
                  $seleccionar="SELECT  id_competencia_problema, problema.id_problema, id_competencia, nombre_problema
                                FROM  competencia_problema, problema
                                where competencia_problema.id_problema=problema.id_problema   and
                                id_competencia=".$competencia;
    
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);
                $this->formu.='<table><tr><td>Identificador</td>';
                $this->formu.='<td>Nombre Problema</td>';
                for($i=0;$i<=$columnas-1; $i++){
                     $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $this->formu.='<tr>             
                                   <td>'.$line['id_problema'].'</td> 
                                   <td>'.$line['nombre_problema'].'</td>
                                   <td><input type="CHECKBOX" name="problemasCompetencia[]" value='.$line['id_problema'].'></td>
                                   </tr>';
                }
                $this->formu.='</table>';

           return $this->formu;    
    }
    
    
    
    
        function ListaEquiposDeCompetencia($id_competencia){ // genera una lista de equipo que pertenecen a una competencia   
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT    id_competencia_equipo, equipo.id_equipo, id_competencia, nombre_equipo
                        FROM    competencia_equipo, equipo
                       where    equipo.id_equipo=competencia_equipo.id_equipo
                                and competencia_equipo.id_competencia='.$id_competencia.'';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr>
                            <td>Identificador</td>
                            <td>Nombre Equipo</td>
                       </tr>';
        for($i=0;$i<$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $this->formu.='<tr>
                                <td>'.$line['id_equipo'].'</td>
                                <td>'.$line['nombre_equipo'].'</td>
                                <td><input type="CHECKBOX" name="equiposCompetencia[]" value='.$line['id_equipo'].'></td>
                           </tr>';
        }   
        $this->formu.='</table>';
        return $this->formu;  
    } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>
