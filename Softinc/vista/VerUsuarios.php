
<!DOCTYPE html>
<html>
    <head>
        
        <title> Problemas </title>
         
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1></h1>
        <table>
      <?php
       include '../Modelo/Consulta.php';
    $p=new Consulta();
    $p->generarTablaUsuarios();
      echo $p->titulo;
      echo $p->col;
      $i=0;
      $total=count($p->cuerpo)-1;
      while($i<$total){
          
      echo $p->cuerpo[$i];
     
      $i++;
      }

      ?>
        </table>
    </body>

</html>
