<?php

class ConsultaEquipo {

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
        function generarTablaUsuariosEquipos2($idEquipo){ //tabla de usuarios de un equipo especifico (eliminar usuarios de equipos)
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT usuario.id_usuario, rol.id_rol, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                      pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
                      FROM usuario, usuario_rol, rol, equipo_usuario, equipo
                      where usuario.id_usuario=usuario_rol.id_usuario
                      and rol.id_rol=usuario_rol.id_rol and rol.id_rol=3
                      and usuario.id_usuario=equipo_usuario.id_usuario 
                      and equipo.id_equipo=equipo_usuario.id_equipo
                      and equipo.id_equipo='.$idEquipo.'';
        
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
            function listaUsuariosEquipo($idEquipo){ //tabla de usuarios de un equipo especifico (eliminar usuarios de equipos)
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT usuario.id_usuario, rol.id_rol, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                      pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
                      FROM usuario, usuario_rol, rol, equipo_usuario, equipo
                      where usuario.id_usuario=usuario_rol.id_usuario
                      and rol.id_rol=usuario_rol.id_rol and rol.id_rol=3
                      and usuario.id_usuario=equipo_usuario.id_usuario 
                      and equipo.id_equipo=equipo_usuario.id_equipo
                      and equipo.id_equipo='.$idEquipo.'';
        
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
    

    
    
    
       function generarEquiposAgregar(){ //sirve para añadir mas usuarios a un equipo determinado
        
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_equipo, nombre_equipo
                         FROM equipo;';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>Nombre de Equipo</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_equipo'].'</td> 
               <td>'.$line['nombre_equipo'].'</td>
               <td><input type="submit" name="agregarUsuarios"  value="Agregar Usuarios  _'.$line['nombre_equipo'].'" style="width:115px"></td>
               <td><input type="submit" name="eliminarUsuario"  value="Eliminar Usuarios  _'.$line['id_equipo'].'" style="width:115px"></td>
               <td><input type="submit" name="verUsuarios"      value="Ver Usuarios  _'.$line['id_equipo'].'" style="width:90px"></td>
               </tr>'; 
        }  
        $this->formu.='</table>';
        return $this->formu;    
    }
    
    
    
        function generarEquiposEliminar(){ //sirve para eliminar usuarios de un equipo determinado
        
        include("../modelo/cnx.php");
        session_start();
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());
        $seleccionar=   'SELECT id_equipo, nombre_equipo
                         FROM equipo;';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr><td><h4>Identificador</h4></td>';
        $this->formu.='<td><h4>Nombre de Equipo</h4></td>';
        $this->formu.='</tr>';
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
               $this->formu.='<tr>             
               <td>'.$line['id_equipo'].'</td> 
               <td>'.$line['nombre_equipo'].'</td>
               <td><input type="submit" name="eliminarUsuario"  value="Eliminar Usuarios  _'.$line['id_equipo'].'" style="width:115px"></td>
               <td><input type="submit" name="verUsuarios"      value="Ver Usuarios  _'.$line['id_equipo'].'" style="width:90px"></td>
               </tr>'; 
        }  
        $this->formu.='</table>';
        return $this->formu;    
    }
    
    
    
        function generarTablaUsuariosEquipos(){   
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT usuario.id_usuario, rol.id_rol, nombre_usuario, apellido_usuario, ci_usuario, user_usuario, 
                      pass_usuario, institucion_usuario, fecha_nacimiento_usuario, email_usuario
                      FROM usuario, usuario_rol, rol
                      where usuario.id_usuario=usuario_rol.id_usuario
                      and rol.id_rol=usuario_rol.id_rol and rol.id_rol=3';
        
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
    
    
    
    
    
        function ListaEquiposDeCompetencia($id_competencia){ // genera una lista de equipo que pertenecen a una competencia   
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT  equipo.id_equipo, nombre_equipo
                        FROM  competencia_usuario, usuario, equipo_usuario, equipo
                        where usuario.id_usuario=competencia_usuario.id_usuario and
                        equipo_usuario.id_usuario=usuario.id_usuario	and
                        equipo.id_equipo=equipo_usuario.id_equipo and competencia_usuario.id_competencia='.$id_competencia.'
                        GROUP BY nombre_equipo, equipo.id_equipo';
        
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
                                <td><input type="submit" name="id_equipo"  value="Ver Usuarios  _'.$line['id_equipo'].'"  style="width:90px"></td>
                           </tr>';
        }   
        $this->formu.='</table>';
        return $this->formu;
        
    } 
    
    
    
    
    
    
    
    
            function ListaUsuariosDeEquipos($id_equipo){ // genera una lista de usuarios que pertenecen a un equipo   
        include("cnx.php");
        $cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

        $seleccionar='SELECT id_equipo_usuario, id_equipo, usuario.id_usuario, nombre_usuario, apellido_usuario, ci_usuario, fecha_nacimiento_usuario
                      FROM equipo_usuario, usuario
                      where equipo_usuario.id_usuario=usuario.id_usuario and 
                      id_equipo='.$id_equipo.'';
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
        $this->formu.='<table>';
        $this->formu.='<tr>
                            <td>Identificador</td>
                            <td>Nombre</td>
                            <td>Apellidos</td>
                            <td>CI</td>
                            <td>Fecha de nacimiento</td>
                       </tr>';
        for($i=0;$i<$columnas; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            $this->formu.='<tr>
                                <td>'.$line['id_usuario'].'</td>
                                <td>'.$line['nombre_usuario'].'</td>
                                <td>'.$line['apellido_usuario'].'</td>
                                <td>'.$line['ci_usuario'].'</td>
                                <td>'.$line['fecha_nacimiento_usuario'].'</td>
                           </tr>';
        }   
        $this->formu.='</table>';
        return $this->formu;
        
    } 
    
    
    
    
    
    
    
}
?>
