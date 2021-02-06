<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// https://wow.gamepedia.com/RaceId

require("./modelo/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="css/site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />
		
	<link rel="shortcut icon" href="images/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>

<body class="inicio">
	<?php include "menu.php";?>
	
	<div class="container">
	
	<?php
		if (isset($_GET['action'])){
			$pagina = $_GET['action'];
		
			if ($pagina == "inicio" || $pagina == "status" || $pagina == "registro" || $pagina == "descargas" || $pagina == "info"){
				include "./vista/".$pagina.".php";
			}else{
				include "./vista/inicio.php";
				
			}
		}else{
			include "./vista/inicio.php";

		}
		
	?>
	</div>
	<?php include "pie.php"; ?>

</body>
</html>