<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $user = $_REQUEST['usuarioUsuario'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($login) {
          
            $sql = pg_query("SELECT 
                    usuario.user_usuario
                    FROM 
                     public.usuario
                    where
                    usuario.user_usuario='$login';");
             
            $contar = pg_num_rows($sql);
             
            if($contar == 0) 
                {
                echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
            }else{
                  echo "<span style='font-weight:bold;color:red;'>  El usuario ya existe</span>";
            }
      }

?>