<body>
<?php
include("cnx.php");
pg_connect("$entrada")or die ("Error de conexion. ". pg_last_error());
$nombreUsuario=$_POST['NombreUsuario']; //echo $nombreUsuario;
$apellidoPaternoUsuario=$_POST['ApellidoPaternoUsuario'];//echo $apellidoPaternoUsuario;
$apellidoMaternoUsuario=$_POST['ApellidoMaternoUsuario'];//echo $apellidoMaternoUsuario;
$ciUsuario=$_POST['CiUsuario'];// echo $ciUsuario;
$unidadEducativa=$_POST['unidadEducativaUsuario']; //echo $unidadEducativa;
$fechaUsuario=$_POST['fechaUsuario']; //echo $fechaUsuario;
$emailUsuario=$_POST['EmailUsuario']; //echo $emailUsuario;
$usuarioUsuario=$_POST['usuarioUsuario']; //echo $usuarioUsuario;
$passwordUsuario=$_POST['passwordUsuario'];
$repetirPasswordUsuario=$_POST['repetirPasswordUsuario'];
$apellidos=$apellidoPaternoUsuario." ".$apellidoMaternoUsuario ;
	if($nombreUsuario=="" || $apellidoMaternoUsuario=="" || $apellidoMaternoUsuario=="" || $ciUsuario=="" ||
         $unidadEducativa=="" || $fechaUsuario=="" || $emailUsuario=="" || $usuarioUsuario=="" || $passwordUsuario=="" ||
         $repetirPasswordUsuario="" || $passwordUsuario!==$repetirPasswordUsuario)
	{	
	        
	 
	echo "Inserte correctamente los datos  ";
         header( "Status: 301 Moved Permanently", false, 301);
		header("Location: ../vista/formularioInscripcionUsuario.php");
		exit();
	}else{
           if(existeUser($usuarioUsuario)==false)
            {
	$guardar = " insert into usuario(nombre_usuario,apellido_usuario, ci_usuario, user_usuario,pass_usuario,institucion_usuario,fecha_nacimiento_usuario,email_usuario)values('$nombreUsuario','$apellidos',$ciUsuario,'$usuarioUsuario','$passwordUsuario','$unidadEducativa','$fechaUsuario','$emailUsuario');";
	         //('sadsa',            'pas',       1515,       'ppppp',            'rewrw',                'palmas',         '01-01-2021',    'will@');
        $sqlq= pg_query($guardar);
	
        $nombreId="SELECT 
                   usuario.id_usuario
                    FROM 
                    public.usuario
                    where
                    usuario.user_usuario ='$usuarioUsuario';";
        $nombreIdcod=  pg_query($nombreId);
        $num=0;
        while($arreglo = pg_fetch_array($nombreIdcod))
		{
		   $num = $arreglo['id_usuario'];
                  //  echo "$num";
		}
                
        $regitrar ="insert into usuario_rol(id_usuario,id_rol) values ($num,3);";
       $consulta= pg_query($regitrar);
       exec("powershell.exe mkdir ../archivo_olimpista/$num");
       include("../Vista/formularioInscripcionUsuario.php");
	header( "Status: 301 Moved Permanently", false, 301);
        header("Location: ../vista/pag-principal/");
		exit();
        echo "registrado";
        exit;	
	}else{
            echo "usuario ya existe";
            header( "Status: 301 Moved Permanently", false, 301);
            header("Location: ../vista/pag-principal/");
            exit();
           
        }
        
        
        }
        function existeUser($nombre)
        {
            $bandera=false;
            $nombre1=$nombre;
            $usuario="SELECT 
            usuario.user_usuario, 
            usuario.id_usuario
            FROM 
            public.usuario
            where 
            usuario.user_usuario='$nombre'  ;";
            
            $nombre=pg_query($usuario);
            
              while($arreglo = pg_fetch_array($nombre))
		{
                  //echo $arreglo['user_usuario'];
                  echo $nombre;
                 if($arreglo['user_usuario'] == $nombre1)
                 {
                     $bandera=true;
                     
                 }
		 
		}
                return $bandera;
        }
        
        ?>

    
   
</body>