<?php

   include('../../Modelo/cnx.php');
   pg_connect($entrada);
   $user = $_POST['user'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($login) {
          //  $con = mysql_connect('localhost','root', 'root');
         //   mysql_select_db('masajes', $con);
       /**
	   SELECT 
  usuario.user_usuario
FROM 
  public.usuario
where
usuario.user_usuario='$usuario'
	   */
            $sql = pg_query("SELECT 
  usuario.user_usuario
FROM 
  public.usuario
where
usuario.user_usuario='$login';");
             
            $contar = pg_num_rows($sql);
             
            if($contar == 0){
                  echo  "<span style='font-weight:bold;color:red;'>El usuario no existe.</span>";
            }
      }

?>