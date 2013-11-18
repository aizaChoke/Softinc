<?php

include '../modelo/cnx.php';
$cnx = pg_connect($entrada) or die ("Error de conexion. ". pg_last_error());

if(isset($_POST['agregar_problema'])){
$problemas=  array();
$problemas=$_POST['problemas'];
$num_problemas=  count($problemas);
$id_competencia=$_POST['idCompetencia'];

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
    require '../modelo/Consulta.php';
    $consul=new Consulta();
    $id_competencia=$_POST['idCompetencia'];
    require '../vista/UsuariosCompetencia.php';
}





if(isset($_POST['crear_equipo'])){
    require '../modelo/Equipo.php';
    require '../modelo/Consulta.php';
    $nombreEquipo=$_POST['nombre_equipo'];
    
    $equipo=new Equipo();
    $equipo->crearEquipo($nombreEquipo);
    $consulta=new Consulta();
    require '../vista/OlimpistaEquipo.php';
}

if(isset($_POST['agregar'])){
    require '../modelo/Equipo.php';
    require '../modelo/Consulta.php';
    $usuarios=$_POST['Contenedor'];
    $nombre_equipo=$_POST['nombreEquipo'];
    $equipo=new Equipo();
    $id=$equipo->getID($nombre_equipo);
    foreach ($usuarios as $usuario) {
        $equipo->AgregarUsuarios($usuario, $id);
        
    }
}

if(isset($_POST['inscribir_equipos'])){
    require '../modelo/Consulta.php';
    $consul=new Consulta();
    $id_competencia=$_POST['idCompetencia'];
    require '../vista/EquiposCompetencia.php';

}
if(isset($_POST['inscribir_usuarios'])){
    require '../modelo/Consulta.php';
    $consul=new Consulta();
    $id_competencia=$_POST['idCompetencia'];
    require '../vista/UsuariosCompetencia.php';

}

if(isset($_POST['agregar_usuarios_competencia'])){
    $arrayIDEquipos=$_POST['equipos'];
    $arrayIDUsuarios=array();
    $id_competencia=$_POST['idCompetencia'];
    for($i=0;   $i<count($arrayIDEquipos);    $i++){
                $seleccionar=   'SELECT id_equipo_usuario, id_equipo, id_usuario
                                 FROM equipo_usuario
                                 where id_equipo='.$arrayIDEquipos[$i];
        
                $result     = pg_query($seleccionar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                $columnas   = pg_numrows($result);

                for($i=0;$i<=$columnas-1; $i++){
                    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    $arrayIDUsuarios=$line['id_usuario'];      
                }  
    }
    echo count($arrayIDUsuarios);
    for($i=0; $i<count($arrayIDUsuarios); $i++){
    $insertar= "INSERT INTO competencia_usuario(id_usuario, id_competencia)
                                        VALUES ('$arrayIDUsuarios[$i]', '$id_competencia');";
    $result = pg_query($cnx, $insertar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    }
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



?>
