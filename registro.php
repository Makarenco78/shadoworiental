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
    <title>Registro de cuentas</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" />
	<link rel="stylesheet" type="text/css" href="site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />
		
	<link rel="shortcut icon" href="img/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>
<?php

if(!empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) ){

	$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_account_db) or die("Unable to connect to the database.");

	$post_accountname = mysqli_real_escape_string($conn, trim(strtoupper($_POST["accountname"])));
	$post_password = mysqli_real_escape_string($conn, trim(strtoupper($_POST["password"])));
	$post_password2 = trim(strtoupper($_POST["password2"]));
	$post_email = mysqli_real_escape_string($conn, trim(strtoupper($_POST["email"])));
	
	//sha1( email, password)
	$post_password_final = mysqli_real_escape_string($conn, SHA1("".$post_email.":".$post_password.""));

	
	// Comprobar que el correo electronico no este registrado previamente
	$sqlemail = "SELECT COUNT(*) FROM battlenet_accounts WHERE email = '".$post_email."'";
	$check_email_query = mysqli_query($conn, $sqlemail);
	$check_email_results = mysqli_fetch_array($check_email_query);
	if($check_email_results[0]!=0){ 
		$errors[] = "Ese correo electronico ya està en uso.";
	}
	
	if(strlen($post_password) < 6) { $errors[] = "El password es muy corto."; }
	if(strlen($post_password) > 20) { $errors[] = "El password es muy largo."; }
	if(strlen($post_email) > 35) { $errors[] = "El e-mail es muy largo."; }
	if(strlen($post_email) < 8) { $errors[] = "El e-mail es muy corto."; }

	$post_expansion = 8;
	
	if($post_password != $post_password2) { $errors[] = "El passwords y la confirmación no coinciden."; }
	
	$arroba   = '@';
	
	$buscar = strpos($post_email, $arroba);

	if ($buscar === false) {
		$errors[] = "Debe introducir un correo válido.";
	}
	/*function bin2hex($field) {
		$field = bin2hex($field);
		$field = chunk_split($field,2,"\\x");
		$field = "\\x" . substr($field,0,-2);
		return $field;
	}
	*/
	
	function hex2bin($hexstr) 
    { 
        $n = strlen($hexstr); 
        $sbin="";   
        $i=0; 
        while($i<$n) 
        {       
            $a =substr($hexstr,$i,2);           
            $c = pack("H*",$a); 
            if ($i==0){$sbin=$c;} 
            else {$sbin.=$c;} 
            $i+=2; 
        } 
        return $sbin; 
    } 
	
	if(!is_array($errors)){
	
		$bnet_hashed_pass = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($post_email)) . ':' . strtoupper($post_password))))))));
		
		//insertar cuenta battlenet
		$sqlinsert = "INSERT INTO battlenet_accounts (email, sha_pass_hash) VALUES ('".strtoupper($post_email)."', '".$bnet_hashed_pass."')";
		mysqli_query($conn, $sqlinsert) or die(mysqli_error($conn));
	
		
		//capturar id para crear cuenta normal
		$sqlcatchid = "SELECT id FROM battlenet_accounts WHERE email = '".$post_email."'";
		$catch_id = mysqli_query($conn, $sqlcatchid);
		$row = mysqli_fetch_array($catch_id, MYSQLI_ASSOC);
		
		$bnet_account_id = $row["id"];
		$username = $bnet_account_id . '#1';
        $hashed_pass = strtoupper(sha1(strtoupper($username . ':' . $post_password)));

		//insertar cuenta normal
		$sqlinsertacc = "INSERT INTO account (username, sha_pass_hash, email, last_ip, expansion,battlenet_account) VALUES ('".$username."', '".$hashed_pass."', '".$post_email."', '".$_SERVER["REMOTE_ADDR"]."', '".$post_expansion."', '".$bnet_account_id."')";
		mysqli_query($conn, $sqlinsertacc) or die(mysqli_error($conn));
		
	
	$errors[] = '<p class="texto cyan">Se ha creado correctamente la cuenta Battlenet '.$post_email.'<p>';  
	}
	
	mysqli_close($conn);
}

function error_msg(){
	global $errors;
	if(is_array($errors)){
		foreach($errors as $msg){
			echo '<div class="errors">'.$msg.'</div>';
		}
	}
}

?>
 <script type="text/javascript">
 function checkform ( form )
 {
	if (form.password.value == "") { alert( "Debes ingresar el password." ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "La contraseña es demasiado corta!" ); form.password.focus(); return false; } }
	if (form.password2.value == "") { alert( "Debes ingresar el password." ); form.password2.focus(); return false; }
	if (form.password.value != form.password2.value) { alert( "El password y la confirmacion no coinciden." ); form.password.focus(); return false; }
	if (form.email.value == "") { alert( "Debes ingresar el e-mail." ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "Az email címed túl rövid!" ); form.email.focus(); return false; } }
	return true ;
 }
 </script>
 <body class="registro">
 
 
<div>
	<?php include ("menu.php");?> 
</div> 
<div class="container"> <!-- contenedor -->
	<form class="formulario" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return checkform(reg);" name="reg">
		<!-- <table class="reg"> -->
		<h1 class="texto azul bg">REGISTRO DE CUENTA</h1>
		<!-- <a href="ip.php" target="_blank">Check Ip</a> -->
		<h3 class="texto cyan sm">ejemplo: usuario@email</h3>
		<?php error_msg(); ?>

		<label class="texto teal md" for="mail">E-mail</label>
		<input id="mail" name="email" type="email" placeholder="username@email" maxlength="35" /><br>
		
		<label class="texto teal md" for="pass">Password</label>
		<input id="pass" name="password" type="password" placeholder="*********" maxlength="30" /><br>
		
		<label class="texto teal md" for="pass2">Confirmar password</label>
		<input id="pass2" name="password2" type="password" placeholder="*********" maxlength="30" /><br>
		
		<input type="submit" class="sbm" value="Registrar" />

		<div id="link-descargas">
			<a class="texto ocre md" href='descargas.php' target='_blank'>Descargas</a>
		</div>
	</form>
	
	<div class="unete">
		<a href="descargas.php"><img src="images/Unite.gif" width="500" height="300"></a>
	</div>
</div>
<?php include("pie.php");  ?>
</body>