<?php
	//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	header("Refresh: 10; URL='ip.php'");
	
	$domain = "sswow.ddns.net";
	$ip = gethostbyname($domain);
	
	$mysql_host = "127.0.0.1";
	$mysql_user = "root";
    $mysql_pass = "ascent";
    $mysql_account_db = "sl_auth"; //Auth Database for TC

	$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass,$mysql_account_db);
	
	
	if(! $conn ) {
		die('Could not connect: ' . mysqli_error());
 	}
 	$sql = "SELECT `name`, `address` FROM `realmlist` WHERE `id` = '1'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Monitor IP</title>
	  <!-- Bootstrap -->
	  <link rel="stylesheet" href="css/estilos.css">
	  <link rel="stylesheet" href="css/site.css">
   </head>
   <body>
   <header>
   <?php

	if(! $conn ) {
		die('Could not connect: ' . mysqli_error());
 	}
 	
	if (mysqli_num_rows($result) > 0) {
			if ($ip != $row['address']){
				$sql = " UPDATE `realmlist` SET `address`= '". $ip ."', `online`='1' WHERE `id` = '1'";
   				mysqli_query($conn, $sql);
				mysqli_close($conn);
				echo exec('start ..\..\core\reset.exe');
			}
		}

	if ($ip == $row['address']){
		echo "
		<div class='texto cyan'>
		<h1>".$domain."</h1>
		<br/><h2 class='texto cyan'>IP del Server: " .$ip."</h2>
		<h2>IP RealmList: ".$row['address']."</h2><br/ >";
		echo "<h2 class='texto cyan'><div class='texto cyan'>LA IP ESTA OK</h2><br />
		<!-- </h2 class='texto cyan'><h2>Ultima actualizacion<br />".$row['fecha']."</h2> -->
		
		<div>";
	}else{
		echo "
		<div class='texto rojo'>
		<h1>".$domain."</h1>
		<br/><h2 class='texto rojo'>IP del Server: " .$ip."</h2>
		<h2 class='texto rojo'>IP RealmList: ".$row['address']."</h2><br/ >";
		echo "<h2><div class='texto rojo'>LA IP NO ESTA CONFIGURADA</h2><br />
		<!-- </h2><h2>Ultima actualizacion<br />" .$row['fecha']. "</h2> -->
		</div>";
	}
	
   ?>
   </header>

   <li><a class="texto md rojo-suave" href="./index.php?action=inicio">&#8592 Inicio</a></li>
   </body>
</div>
</html>