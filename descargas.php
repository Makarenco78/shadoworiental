<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargas</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" />
	<link rel="stylesheet" type="text/css" href="site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />
		
	<link rel="shortcut icon" href="img/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>
<body class="descargas">
	<header>
	<?php include ("menu.php"); ?>
	</header>	
	<div class="container">
		<div class="titulo fondo">
			<h1 class="texto azul bg">Wow ShadowOriental</h1>
			<h1 class="texto azul bg">Instrucciónes para jugar<br></h1><br>
		</div>
	
		<div class="articulo fondo">
			<p class="parrafo claro sm">[1] Registra <a class="enlace" href="registro.php" target="_blank">aquí</a> tu cuenta para entrar a Wow Shadowlands.<br>
			<b class="importante">Importante</b> El correo electrónico será el nombre de tu cuenta y el password la contraseña.<br><br>
			[2] Descarga el mini-cliente Wow Shadowland. Es un archivo comprimido de 4 Gb, llamado "Client Shadow.rar".<br> Tenes dos opciones de descarga:</p>
				<div id="caja">
					<a class="boton claro sm" href='https://1drv.ms/u/s!Am9kRcOupILfgkkgOd_ZbCKSHgJb?e=NheiJ8' target='_blank'>OneDrive</a></li>
					<a class="boton claro sm" href='https://drive.google.com/drive/folders/1QTh2Ka0Jr_eWAptkSIRZvvJuiqV9UUoh?usp=sharing' target='_blank'>Google Drive</a></li>
				</div>
			<p class="parrafo claro sm"><b class="importante">Importante</b> Las dos opciones contienen el mismo cliente, solo descarga uno.</p>
			<p class="parrafo claro sm">
			[3] Descomprime el archivo "Client Shadow.rar" en la carpeta que contendrá tu Wow Shadowlands. Luego podrás borrar el archivo "Client Shadow.rar".<br><br>
			[4] Ingresa y disfruta este gran juego ejecutando el archivo: "Arctium WoW Client Launcher.exe".</p>
			<p class="parrafo claro sm"><b class="importante">Importante</b> Entrarás a jugar con una versión mínima, sin descargar la totalidad del cliente del Wow Shadowlands. Éste se seguirá descargando mientras juegas.
			Esto significa que mientras se descargue el cliente experimentes algunos momentos de "lag" durante la aventura.</p>
			<p class="parrafo claro sm">Necesitas 60 Gb de espacio libre en el disco duro para jugar Wow Shadowlands.</p>
		</div>
	</div>
	<?php include("pie.php");  ?>
</body>
</html>