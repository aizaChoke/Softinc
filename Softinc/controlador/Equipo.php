<?php

include '../modelo/cnx.php';
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

if(isset($_POST['agregar_problema'])){
$problemas=  array();
$problemas=$_POST['problemas'];
$num_problemas=  count($problemas);
$id_competencia=$_POST['idCompetencia'];
$nombre_competencia=$_POST['nombre_competencia'];
$indices=array();

 $seleccionar=   'SELECT id_competencia_problema, id_problema, id_competencia
  FROM competencia_problema
  where id_competencia='.$id_competencia;
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);

        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            for($j=0;$j<count($problemas);$j++){
                if($line['id_problema']==$problemas[$j]){
                     $indices[]=$j;
                } 
            }
             
        }  
       for($i=0;$i<count($indices); $i++){
           unset($problemas[$indices[$i]]);
        } 
    if(count($problemas)>0){
        for($i=0;$i<count($problemas);$i++){
            $insertar= "INSERT INTO competencia_problema( id_competencia,id_problema)
            VALUES ('$id_competencia', '$problemas[$i]');";
            $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        }
    }
require '../vista/ContenidoCompetencia.php';
}






if(isset($_POST['siguiente_problema'])){
    require '../modelo/ConsultaCompetencia.php';
    $consul             =new ConsultaCompetencia();
    $id_competencia     =$_POST['idCompetencia'];
    $nombre_competencia =$_POST['nombre_competencia'];
    require '../vista/EquiposCompetencia.php';
}





if(isset($_POST['crear_equipo'])){ //creacion de un equipo
    require '../modelo/Equipo.php';
    require '../modelo/ConsultaEquipo.php';
    $nombreEquipo=$_POST['nombre_equipo'];
     require '../Modelo/verificarEquipoExiste.php';
     $extraer=new verificarEquipoExiste();
     
    $existe=$extraer->existe($nombreEquipo);
    if($existe==true )
    {
    $equipo=new Equipo();
    $equipo->crearEquipo($nombreEquipo);
    $consulta=new ConsultaEquipo();
    require '../vista/OlimpistaEquipo.php';
    }else{
        header("Location: ../vista/CrearEquipo");
    }
}


if(isset($_POST['agregarUsuarios'])){ //agregar usuarios a un equipo (modificar equipo)
    require '../modelo/ConsultaEquipo.php';
    $nombreEquipo=  $_POST['agregarUsuarios'];
    $contenedor  =  array();
    $contenedor  =  explode("_", $nombreEquipo);
    $nombreEquipo=  $contenedor[1];
    $consulta    =  new ConsultaEquipo();
    require '../vista/OlimpistaEquipo.php';
}

if(isset($_POST['agregar'])){ //agregar usuarios a un equipo (creacion de equipo)
    require '../modelo/Equipo.php';
    require '../modelo/ConsultaEquipo.php';
    $usuarios       =$_POST['Contenedor'];
    $nombreEquipo   =$_POST['nombreEquipo'];
    $equipo         =new Equipo();
    $id             =$equipo->getID($nombreEquipo);
    $indices        =array();
    $seleccionar=   'SELECT id_equipo_usuario, id_equipo, id_usuario
                     FROM equipo_usuario
                     where id_equipo='.$id;
        
        $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $columnas   = pg_numrows($result);
    
        for($i=0;$i<=$columnas-1; $i++){
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            for($j=0;$j<count($usuarios);$j++){
                if($line['id_usuario']==$usuarios[$j]){
                     $indices[]=$j;
                } 
            }
             
        }  
       for($i=0;$i<count($indices); $i++){
           unset($usuarios[$indices[$i]]);
        } 
    
    foreach ($usuarios as $usuario) {
        $equipo->AgregarUsuarios($usuario, $id);  
    }
    $consulta=new ConsultaEquipo();
     require '../vista/OlimpistaEquipo.php';
}

if(isset($_POST['inscribir_equipos'])){
    require '../modelo/Consulta.php';
    $consul=new Consulta();
    $id_competencia=$_POST['idCompetencia'];
    require '../vista/EquiposCompetencia.php';
}




if(isset($_POST['agregar_usuarios_competencia'])){ //agregar usuarios a una competencia
    $arrayIDEquipos     =$_POST['equipos'];
    session_start();
    require '../modelo/ConsultaCompetencia.php';
    $consul             =new ConsultaCompetencia();
    $arrayIDUsuarios    =array();
    $id_competencia     =$_POST['idCompetencia'];
    $nombre_competencia =$_POST['nombre_competencia'];
    $usuario            =$_SESSION["id_usuario"];
    
    for($i=0; $i<count($arrayIDEquipos); $i++){
    $insertar= "INSERT INTO competencia_equipo(id_equipo, id_competencia)
                                        VALUES('$arrayIDEquipos[$i]', '$id_competencia');";
    $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
    require '../vista/EquiposCompetencia.php';
}







if(isset($_POST['agregar_usuario'])){
    require '../modelo/Consulta.php';
    $consul=new Consulta();
    $id_competencia=$_POST['idCompetencia'];
    $arrayIDUsuarios=$_POST['usuarios'];
        for($i=0; $i<count($arrayIDUsuarios); $i++){
    $insertar= "INSERT INTO competencia_usuario(id_usuario, id_competencia)
                                        VALUES ('$arrayIDUsuarios[$i]', '$id_competencia');";
    $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
    require '../vista/UsuariosCompetencia.php';

}


if(isset($_POST['eliminarUsuario'])){ //Eliminar usuarios de un equipo (modificar equipo)
    require '../modelo/ConsultaEquipo.php';
    $id_equipo=  $_POST['eliminarUsuario'];
    $contenedor  =  array();
    $contenedor  =  explode("_", $id_equipo);
    $id_equipo=  $contenedor[1];
    $nombreEquipo=  $contenedor[2];
    $consulta    =  new ConsultaEquipo();
    require '../vista/equipoUsuariosEliminar.php';
}


if(isset($_POST['eliminar_usuario'])){
    require '../modelo/ConsultaEquipo.php';
    $consulta       =   new ConsultaEquipo();
    $idesUsuarios   =   array();
    $nombreEquipo   =   $_POST['nombreEquipo'];
    $id_equipo      =   $_POST['id_equipo'];
    $idesUsuarios   =   $_POST['Contenedor'];
    foreach ($idesUsuarios as $id) {
        $eliminar   =   "DELETE FROM equipo_usuario
                         WHERE id_usuario=".$id;
        $result     =   pg_query($cnx, $eliminar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
    require '../vista/equipoUsuariosEliminar.php';
}






//modificar competencia





if(isset($_POST['verUsuarios'])){// ver usuarios de un equipo
    include '../modelo/ConsultaEquipo.php';
    $consultaEquipo=new ConsultaEquipo();
    $id_equipo=$_POST['verUsuarios'];
    $contenedor         =  array();
    $contenedor         =  explode("_", $id_equipo);
    $id_equipo          =  $contenedor[1];
    require '../vista/VerUsuariosEquipo.php';

}



?>
