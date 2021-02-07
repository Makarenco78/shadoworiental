<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="../css/site.css" />
	<meta name="description" content="<?php $site["meta_description"] ?>" />

	<link rel="shortcut icon" href="../images/favicon.png" type="image/png" />
	<title><?php echo $site["title"]; ?></title>
</head>

<?php

// https://wow.gamepedia.com/RaceId
require_once("../modelo/config.php");

$texto_aleatorio = generateRandomString();

if(!empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"]) && !empty($_POST["captcha"]) && !empty($_POST["captcha_verif"]) ){

	$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_account_db) or die("Unable to connect to the database.");

	$post_password = mysqli_real_escape_string($conn, trim(strtoupper($_POST["password"])));
	$post_password2 = trim(strtoupper($_POST["password2"]));
	$post_email = mysqli_real_escape_string($conn, trim(strtoupper($_POST["email"])));
	$post_captcha = mysqli_real_escape_string($conn, trim(strtoupper($_POST["captcha"])));
	$post_captcha_verif = mysqli_real_escape_string($conn, trim(strtoupper($_POST["captcha_verif"])));
	
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
	
	if($post_captcha != $post_captcha_verif) { $errors[] = "Error de captcha."; }
	
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
	*/
	
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
		
	
		$errors[] = '<p class="texto cyan sm">Se ha creado correctamente la cuenta '.$post_email.'<p>';  
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

	function no_robot()
	{
		document.getElementById("captcha_verif").value = document.getElementById("captcha").value;

		function sleep (time) {
  			return new Promise((resolve) => setTimeout(resolve, time));
		}

		// Usage!
		sleep(1000).then(() => {
    		// Do something after the sleep!
			//var elem = document.querySelector('#selector');
			document.getElementById("selector").disabled = true;
			document.getElementById("check").disabled = true;
			document.getElementById("slider").disabled = true;
			//elem.parentNode.removeChild(elem);

			//var elem = document.querySelector('#check');
			//elem.parentNode.removeChild(elem);

			//var elem = document.querySelector('#slider');
			//elem.parentNode.removeChild(elem);
		});
	}

	function checkform ( form )
	{
		if (form.password.value == "") { alert( "Debes ingresar el password." ); form.password.focus(); return false; } else { if (form.password.value.length < 6) { alert( "La contraseña es demasiado corta!" ); form.password.focus(); return false; } }
		if (form.password2.value == "") { alert( "Debes ingresar el password." ); form.password2.focus(); return false; }
		if (form.password.value != form.password2.value) { alert( "El password y la confirmacion no coinciden." ); form.password.focus(); return false; }
		if (form.captcha.value != form.captcha_verif.value) { alert( "Debes activar el captcha" ); form.password.focus(); return false; }
		if (form.email.value == "") { alert( "Debes ingresar el e-mail." ); form.email.focus(); return false; } else { if (form.email.value.length < 8) { alert( "Az email címed túl rövid!" ); form.email.focus(); return false; } }
		return true ;
	}
 </script>

a
<script>
	document.body.style.backgroundImage = "url('../images/bg-images/background.jpg')";
</script>
	<body>
		

	<?php include "../menu.php";?>
		
	
	<div class="container">
		<form class="formulario" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" onsubmit="return checkform(reg);" name="reg">
			<!-- <table class="reg"> -->
			<!-- <a href="ip.php" target="_blank">Check Ip</a> -->
			<h2 class="texto azul md">REGISTRO DE CUENTA</h2>
			<!--<h3 class="texto cyan sm">ejemplo: usuario@email</h3>-->
			<?php error_msg(); ?>

			<label class="texto teal sm" for="mail">E-mail</label>
			<input class="input" id="mail" name="email" type="email" placeholder="username@email" maxlength="35" /><br>
			
			<label class="texto teal sm" for="pass">Contraseña</label>
			<input class="input" id="pass" name="password" type="password" placeholder="*********" maxlength="30" /><br>
			
			<label class="texto teal sm" for="pass2">Re-Contraseña</label>
			<input class="input" id="pass2" name="password2" type="password" placeholder="*********" maxlength="30" /><br>
			
			<input id="captcha" name="captcha" type="hidden" value= <?php echo $texto_aleatorio?> /><br>
			<input id="captcha_verif" name="captcha_verif" type="hidden" /><br>

			<label class="texto teal sm">Captcha</label>
			<div class="captcha">
				<label id="selector" class="switch">
					<input id="check" type="checkbox">
					<a id="slider" class="slider round" onclick="no_robot()"></a>
				</label>
			</div>
			<input type="submit" class="sbm" value="Registrar" />
		</form>
		
	</div>
	<?php include "pie.php";?>
</body>


	
