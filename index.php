<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// https://wow.gamepedia.com/RaceId

require("config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
	<meta http-equiv=”Content-Type” content=”text/html"; charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" />
	<link rel="stylesheet" type="text/css" href="site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />
		
	<link rel="shortcut icon" href="images/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>

<body class="inicio">
	<?php include ("menu.php"); ?>
	<div class="container">
		<div class="texto bg claro" id="texto1">Bienvenidos a WOW ShadowOriental!</div>
		<div class="texto bg claro" id="texto2">Wow ShadowLands 9.0.2 (37176)</div>
		<video autoplay muted loop id="myVideo">
			<source src="\images\video\bg-3.mp4" type="video/mp4">
		</video>
	</div>
	<?php include("pie.php");  ?>

</body>
</html>