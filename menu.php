<div>
	<div id="logo"><img src="../images/logo.png" width="200" height="100"></div>
	<ul class="menu">
		<li><a href="../index.php?action=descargas">Descargas</a></li>
	  	<li><a href="../vista/registro.php">Registro</a></li>
	  	<li><a href="../index.php?action=status">Server</a></li>
	  	<li><a href="../index.php?action=inicio">Inicio</a></li>
		
		<?php
			$sql_user = 'root'; //mysql username
			$sql_pass = 'ascent'; //mysql_pass
			$sql_host = 'localhost'; //mysql server address
			$sql_account_db = 'sl_auth'; //mysql account data base name
			
			$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_account_db) or die("Unable to connect to the database.");

			if ($conn){
				$sql = "SELECT * FROM realmlist WHERE id = '1'";
				$online = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($online, MYSQLI_ASSOC);
		
				$isonline = $row["online"];
	
				if ($isonline == '1'){ ?>
					<li><label class="badge badge-on claro esm">Server On</label></li> <?php
				}else{ ?>
					<li><label class="badge badge-off claro esm">Server Off</label></li> <?php
				}
			}else{ ?>
				<li><label class="badge badge-off claro esm">Server Off</label></li> <?php

			}
			mysqli_close($conn);
		?>
	</ul>
</div>