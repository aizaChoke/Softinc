<html>
    <head>
        <title></title>
		
    </head>
    <body>
	<h1 align="center">Lista problema a ver </h1>
        <form action="mostrarTablaRanking.php" method="get" > 
             <div align="center">
               <p>
                 <?php
                require  '../Modelo/rankingProblema.php';
                $p=new rankingProblema();
                echo $p->formularioRanking();
             ?>
               </p>
               <p>
                 <input type="submit" value="Mostrar tabla de problema">
               </p>
             </div>
        </form>
    </body>
</html>
