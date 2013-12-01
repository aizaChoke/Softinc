<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Juez virtual</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../css/estilos_aplicacion.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
    
<div id="wrapper">
	<div id="logo">
		<h1><a href="#">Bienvenido al Juez Virtual SoftInc</a></h1>
		<p><em> Aqui encontraran cientos de problemas.</em></p>
	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
				<li><a href="#" class="first">Inicio</a></li>
				<!--<li class="current_page_item"><a href="#">Olimpiadas</a></li>-->
				<li><a href="#">Olimpiadas</a></li>
				<li><a href="#">Perfil</a></li>
				<li><a href="../Salir.php">Cerrar Sesion</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form method="get" action="">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
				<input type="submit" id="search-submit" value="GO" />
				</fieldset>
			</form>
		</div>
		<!-- end #search -->
	</div>
	<!-- end #header -->
<table>
    <tr class="texto-tipo-usuario">
        <td><?php echo $_GET["nombre_rol"]; ?>:</td>
        <td><?php echo $_GET['nombre_usuario']." ".$_GET['apellido_usuario'];?></td>
    </tr>
</table>