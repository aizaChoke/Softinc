<?php

class Consulta {
    
    
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
    
    function generarTablaUsuarios(){
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $this->titulo="Usuarios de JUEZ VIRTUAL";
        $seleccionar='SELECT usuario.id_usuario, rol.id_rol,nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                      pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
                      FROM usuario, rol, usuario_tiene
                      where usuario.id_usuario=usuario_tiene.id_usuario and rol.id_rol=usuario_tiene.id_rol';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->col='<tr>
                            <td>ID USUARIO</td>
                            <td>ID ROL</td>
                            <td>NOMBRE </td>
                            <td>APELLIDO</td>
                            <td>CI</td>
                            <td>USER</td>
                            <td>PASSWORD</td>
                            <td>INSTITUCION</td>
                       </tr>';
        for($i=0;$i<=$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $this->cuerpo[]='<tr>
                                <td>'.$line['id_usuario'].'</td>
                                <td>'.$line['id_rol'].'</td>
                                <td>'.$line['nombre_usuario'].'</td>
                                <td>'.$line['apellido_usuario'].'</td>
                                <td>'.$line['ci_usuario'].'</td>
                                <td>'.$line['user_usuario'].'</td>
                                <td>'.$line['pass_usuario'].'</td>
                                <td>'.$line['institucion_usuario'].'</td>
                             </tr>';
        }   
        
    }   
        function generarTablaUsuariosEquipos(){
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT usuario.id_usuario, rol.id_rol, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
       pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
  FROM usuario, usuario_rol, rol
  where usuario.id_usuario=usuario_rol.id_usuario
	and rol.id_rol=usuario_rol.id_rol';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr>
                            <td>ID USUARIO</td>
                            <td>ID ROL</td>
                            <td>NOMBRE </td>
                            <td>APELLIDO</td>
                            <td>CI</td>
                            <td>USER</td>
                            <td>PASSWORD</td>
                            <td>INSTITUCION</td>
                       </tr>';
        for($i=0;$i<$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $this->formu.='<tr>
                                <td>'.$line['id_usuario'].'</td>
                                <td>'.$line['id_rol'].'</td>
                                <td>'.$line['nombre_usuario'].'</td>
                                <td>'.$line['apellido_usuario'].'</td>
                                <td>'.$line['ci_usuario'].'</td>
                                <td>'.$line['user_usuario'].'</td>
                                <td>'.$line['pass_usuario'].'</td>
                                <td>'.$line['institucion_usuario'].'</td>
                                <td><input value='.$line['id_usuario'].' name="Contenedor[]" type="checkbox" /></td>
                             </tr>';
        }   
        $this->formu.='</table>';
        return $this->formu;
        
    }   
    function eliminar($id){
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
	
            $eliminar="delete from roles where codigor='".$id."'";
            $result = pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        }
    
    
function generarTablaEliminarProblema(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_problema, nombre_problema
                        FROM problema, usuario
                        where  problema.id_usuario=usuario.id_usuario
                        and usuario.id_usuario='.$_SESSION["id_usuario"];
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr>';
        $this->formu.='<td>CODIGO DE PROBLEMA</td>';
        $this->formu.='<td>NOMBRE</td>';
        $this->formu.='<td>ELIMINAR</td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             $this->formu.='<tr>
                             <td>'.$line['id_problema'].'</td> <td>'.$line['nombre_problema'].'</td> <td><input value='.$line['id_problema'].' name="Contenedor[]" type="checkbox" /></td>
                             
                             </tr>';                                                                                    
        }  
        $this->formu.='</table>';
        return $this->formu;
        
    }     
    function generarPermisos(){
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT usuario.id_usuario, rol.nombre_tipo, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
       pass_usuario, institucion_usuario, fecha_nacimiento_usuario, 
       email_usuario
  FROM usuario, rol, usuario_tiene
 where usuario.id_usuario=usuario_tiene.id_usuario and rol.id_rol=usuario_tiene.id_rol
                               order by id_usuario;';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td>Identificador</td>';
        $this->formu.='<td>Nombre</td>';
        $this->formu.='<td>User</td>';
        $this->formu.='<td>Apellido</td>';
        $this->formu.='<td>Numero_CI</td>';
        $this->formu.='<td>Institucion</td>';
        $this->formu.='<td>Rol_Olimpista</td>';
        $this->formu.='<td>Rol_Comite</td>';
        $this->formu.='<td>Rol_Administrador</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
  
               $this->formu.='<tr>             
               <td>'.$line['id_usuario'].'</td> 
               <td>'.$line['nombre_tipo'].'</td> 
               <td>'.$line['nombre_usuario'].'</td>
               <td>'.$line['apellido_usuario'].'</td> 
               <td>'.$line['ci_usuario'].'</td> 
               <td>'.$line['institucion_usuario'].'</td>
               <td><input type="CHECKBOX" name="rol[]" value='.$line['id_usuario']."_3_".'> olimpista   </td>
               <td>    <input type="CHECKBOX" name="rol[]" value='.$line['id_usuario']."_2_".'>comite       </td>
               <td>    <input type="CHECKBOX" name="rol[]" value='.$line['id_usuario']."_1_".'>administrador</td>
               </tr>';
             
        }  
        $this->formu.='</table>';
        return $this->formu;
    }
    function generarArchivosSubidos(){
        
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_problema, usuario.id_usuario, nombre_problema
                         FROM problema, usuario
                         where usuario.id_usuario=problema.id_usuario
                         and usuario.id_usuario='.$_SESSION["id_usuario"];
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $nombre=$line['id_problema'];
               $this->formu.='<tr>             
               <td>'.$line['id_problema'].'</td> 
               <td>'.$line['nombre_problema'].'</td>
               <td><a href="../archivo/'.$nombre.'/'.$nombre.".IN".'">'.$line['id_problema'].'</a></td>
               </tr>';
             
        }  
        $this->formu.='</table>';
        return $this->formu;    
    }
    
    
        function generarArchivosSubidosComite(){ //solo para comite
        
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_problema, usuario.id_usuario, nombre_problema
                         FROM problema, usuario
                         where usuario.id_usuario=problema.id_usuario
                         and usuario.id_usuario='.$_SESSION["id_usuario"];
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td>Identificador</td>';
        $this->formu.='<td>Nombre problema</td>';
        $this->formu.='<td>Descargar</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $nombre=$line['id_problema'];
               $this->formu.='<tr>             
               <td>'.$line['id_problema'].'</td> 
               <td>'.$line['nombre_problema'].'</td>
               <td><a href="../archivo_comite/'.$nombre.'/'.$nombre.".zip".'"> descargar </a></td>
               </tr>';
             
        }  
        $this->formu.='</table>';
        return $this->formu;    
    }
    
    
    
    
    
    
    
    
    
        function generarArchivos(){
        
        include("../modelo/cnx.php");
       // session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_problema, nombre_problema
  FROM problema;';

        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->archivos.='<table>';
        $this->archivos.='<tr><td>Identificador</td>';
        $this->archivos.='<td>Nombre</td></tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $nombre=$line['id_problema'];
               $this->archivos.='<tr>             
               <td>'.$line['id_problema'].'</td> 
               <td>'.$line['nombre_problema'].'</td>
               <td><input type="CHECKBOX" name="problemas[]" value='.$line['id_problema'].'></td>
               </tr>';
             
        }  
        $this->archivos.='</table>';
        return $this->archivos;    
    }
    
    
    
    
    
    
    
    function generaListaArchivosPermitidosComite(){
                      
                  include("../modelo/cnx.php");
                  $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                //  session_start();
                  $seleccionar="SELECT id_problema, usuario.id_usuario, nombre_problema
                                FROM problema, usuario
                                where problema.id_usuario=usuario.id_usuario
                                and usuario.id_usuario=".$_SESSION["id_usuario"];
    
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);
                $this->formu.='<select name = "idArchivo">';
                for($i=0;$i<=$columnas-1; $i++){
                     $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                                   $this->formu.='<option value ='.$line['id_problema'].'>'.$line['id_problema']."-----".$line['nombre_problema'].'</option>';
                }
                $this->formu.='</select>';

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
    
    function datos(){
      $this->formu.='     Nombre:   <input  type="text" width="100" value='.$_SESSION["nombre_usuario"].' name="nombre"> <br>
              Nombre de Usuario:    <input  type="text" width="100" value='.$_SESSION["user_usuario"].'  name="user"><br>
                     Contraseña:    <input  type="text" width="100" name="contra1"> <br>
          Verifique su Contraseña:  <input  type="text" width="100" name="contra2"> <br>';
      return $this->formu;
        
    }
    
    
    function buscarProblemas($dato){
        $validacion="No existe el problema ";
                  include("../modelo/cnx.php");
                  $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
                //  session_start();
                  $seleccionar="SELECT id_problema, nombre_problema
                                FROM problema;";
    
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);

        
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            if($line['id_problema']==$dato){
                    $validacion='usted agrego el problema '.$line['id_problema'].'';
                    break;
            }    
        }  
        return $validacion;

    }
    function generarProblemasCompetencia($id_competencia){

                                      
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
    
    
        function generarUsuariosCompetencia(){
            
        include("../modelo/cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
          //  session_start();
          $seleccionar="SELECT id_usuario, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                        pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
                        FROM usuario;";
    
          $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td>Identificador</td>';
        $this->formu.='<td>Nombre</td>';
        $this->formu.='<td>Apellido</td>';
        $this->formu.='<td>Fecha de Nacimiento</td>';
        $this->formu.='<td>Correo electronico</td></tr>';

        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_usuario'].'</td> 
               <td>'.$line['nombre_usuario'].'</td>
               <td>'.$line['apellido_usuario'].'</td>
               <td>'.$line['fecha_nacimiento_usuario'].'</td>
               <td>'.$line['email_usuario'].'</td>
               <td><input type="CHECKBOX" name="usuarios[]" value='.$line['id_usuario'].'></td>
               </tr>';
             
        }  
        $this->formu.='</table>';
        return $this->formu;    

    }
    
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
}
//$c=new Consulta();
//echo $c->generarTablaUsuariosEquipos();

?>
