<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// https://wow.gamepedia.com/RaceId

	//header("Refresh: 90; URL='status.php'");

	require("config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
	<meta http-equiv=”Content-Type” content=”text/html"; charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Server</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" />
	<link rel="stylesheet" type="text/css" href="site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />
		
	<link rel="shortcut icon" href="img/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>

<body class="status">
	<?php include ("menu.php"); ?>
		<div class="container">
			<table class="tabla tabla2" id="tabla-online">
				<caption class="texto sm cyan">
					Players Online
				</caption>
				<thead>
				<tr>
					<th scope="col" class="texto h3">Nombre</th>
					<th scope="col" class="texto h3">Raza</th>
					<th scope="col" class="texto h3">Clase</th>
					<th scope="col" class="texto h3">Nivel</th>
				</tr>
				</thead>
				<tbody>
				
				<?php
				
				$mysqliC = new mysqli($sql_host, $sql_user, $sql_pass, $sql_character_db);
				
				$get_online = $mysqliC->query("SELECT * FROM `characters` WHERE `online` = '1';") or die (mysqli_error($mysqliC));
				$num_online = $get_online->num_rows;
				if($num_online < 1)
				{
					echo '<tr><td colspan="4" class="texto sm cyan">There are no players online!</td></tr>';
				}
				else
				{
					while($online = $get_online->fetch_assoc())
					{
						echo '
							<tr>
								<td class="texto sm cyan">'. $online['name'] .'</td>
								<td><img src="images/races/'. $online['race'] .'_'. $online['gender'] .'.png" width="36" height="36" alt="race" title="'. _getCharRaceSTR($online['race']).' - '. _getChSexSTR($online['gender']).' - '. _getFactionSTR($online['race']).'"></td>
								<td><img src="images/classes/'. $online['class'] .'.png" width="36" height="36" alt="class" title="'. _getChClSTR($online['class']).'"></td>
								<td class="texto sm cyan">'. $online['level'] .'</td>
							</tr>
						';
					}
				}
				?>
				</tbody>
			</table>
			<table class="tabla tabla1" id="tabla-topchar">
				<caption class="texto sm cyan">
					Top Players
				</caption>
				<thead>
				<tr>
					<th scope="col" class="texto h3">Nombre</th>
					<th scope="col" class="texto h3">Raza</th>
					<th scope="col" class="texto h3">Clase</th>
					<th scope="col" class="texto h3">Nivel</th>
					<th scope="col" class="texto h3">Money</th>
				</tr>
				</thead>
				<tbody>
				
				<?php
				//Top players
				$get_topchar= $mysqliC->query("SELECT * FROM `characters` ORDER BY `Level` Desc LIMIT 10;") or die (mysqli_error($mysqliC));
				$num_topchar = $get_topchar->num_rows;
				if($num_topchar < 1)
				{
					echo '<tr><td colspan="4" class="texto sm cyan">Realm is offline!</td></tr>';
				}
				else
				{
					while($char = $get_topchar->fetch_assoc())
					{
						echo '
							<tr>
								<td class="texto sm cyan">'. $char['name'] .'</td>
								<td><img src="images/races/'. $char['race'] .'_'. $char['gender'] .'.png" width="36" height="36" alt="race" title="'. _getCharRaceSTR($char['race']).' - '. _getChSexSTR($char['gender']).' - '. _getFactionSTR($char['race']).'"></td>
								<td><img src="images/classes/'. $char['class'] .'.png" width="36" height="36" alt="class" title="'. _getChClSTR($char['class']).'"></td>
								<td class="texto sm cyan">'. $char['level'] .'</td>
								<td class="texto esm cyan">'. _getCharMoneySTR($char['money']).'</td>
							</tr>
						';
					}
				}
				?>
				</tbody>
			</table>
			<div class="videofi" id="video-shadow">
				<!-- <iframe title="vimeo-player" src="https://www.youtube.com/watch?v=SkJCYNUB4vo" frameborder=0; allowfullscreen></iframe> -->
				<iframe id="frame" src="https://www.youtube.com/embed/SkJCYNUB4vo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
		
	<?php include("pie.php");  ?>
</body>
</html>