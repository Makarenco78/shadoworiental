
<script>
	document.body.style.backgroundImage = "url('../images/bg-images/background2.jpg')";
</script>


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


<!-- <div class="container">
		<div class="serverstats texto sm claro">
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, ipsam! Quibusdam, vitae perferendis. Quas consequatur nobis assumenda earum delectus? Amet, sit voluptatibus? Laudantium at minima nulla earum sequi veritatis dolorem!
			Animi tempora suscipit, consectetur odit ex temporibus soluta laborum quaerat, pariatur facilis fuga quae eveniet inventore modi, eos accusantium reprehenderit exercitationem doloribus. Quia, tempora quas nobis similique aliquid placeat blanditiis.
			Quisquam architecto libero est commodi magnam? Quae omnis alias inventore quisquam, dolore corrupti perspiciatis a quas veritatis culpa voluptatibus magnam, nobis iusto consectetur cum quaerat. Animi illum tempore non vel.
			Tempore assumenda ea consequatur inventore illum labore, natus minus vero eum. Corporis qui cupiditate tempore veritatis sit, ut esse consequuntur accusantium delectus incidunt nam. Est doloribus quod error facere corrupti!
			Dolores ullam nihil amet. Neque error maxime nesciunt. Reiciendis consequatur praesentium temporibus magnam nesciunt at debitis iste provident recusandae deserunt, magni illum molestiae incidunt ad qui, dolore est quod itaque.
			Et suscipit rerum, similique ipsam dolore quas quo culpa nobis quam iusto laborum, reprehenderit est ex natus pariatur nostrum quae. Voluptate in dignissimos dolorem saepe qui harum! Autem, quae minima.
			Mollitia voluptate numquam hic perspiciatis modi ratione rerum rem, assumenda aut. Possimus ea aut commodi explicabo recusandae vitae quia, debitis minus corrupti sequi saepe, accusantium eaque rerum amet hic? Et.
			Ipsam praesentium quis quam quisquam minus, qui deserunt nisi dolores, in debitis incidunt repellat quaerat libero! Molestiae neque provident fugiat perferendis repellendus iusto minus amet excepturi. Eaque deserunt natus vero.
			Tenetur nobis repellat repudiandae quae soluta eligendi maxime veritatis, pariatur sapiente. Voluptates commodi quos odit dicta ipsum et nostrum aspernatur, labore omnis illo enim vero, nesciunt vitae sit, consequatur voluptate.
			Illo quibusdam dolorem velit nobis doloribus? Delectus facilis sit eius quasi reiciendis dolores magni iure doloremque nesciunt voluptates culpa accusantium tenetur saepe, necessitatibus repellendus aut iste veritatis est ratione quisquam!
			Velit tempora, inventore libero sit suscipit necessitatibus odio ea nobis voluptatem iste deleniti, quisquam ratione, eum hic. Delectus accusamus nam iure rerum, expedita sapiente, saepe veniam, ea libero laudantium quidem.
			Maiores doloremque dolor reprehenderit adipisci sint voluptas aspernatur quibusdam rem at, ullam voluptatem nostrum maxime praesentium veritatis laudantium perspiciatis facere ipsa dolorem quaerat fugiat sed velit expedita omnis! Consequatur, adipisci?
			Nesciunt cupiditate reprehenderit numquam sequi? A quisquam ab qui, doloribus perferendis eligendi? Exercitationem atque dolore aspernatur repudiandae labore incidunt modi hic facere quidem id cumque perspiciatis, quod, quis, vero corporis?
			Beatae facere quibusdam incidunt esse fugiat quod quisquam? Numquam, minima eveniet cum reiciendis ipsum, ad ab unde facere consectetur expedita aspernatur, architecto libero? Minus aspernatur magni quia molestiae, quam quibusdam.
			Asperiores, excepturi iusto? Accusantium quasi maiores voluptate iste necessitatibus voluptatem? Tempore provident rem voluptates mollitia vel id esse asperiores dolores? Unde numquam officia rerum magni? Iste omnis consequuntur molestias recusandae!
			Eius consequuntur consectetur, aliquid vero ipsam, eum dicta eaque, deleniti aut culpa assumenda! Dolore in quis consectetur porro quibusdam ea quas incidunt repellendus optio nisi nemo, sint distinctio doloribus quam.
			Omnis nam deserunt corporis quaerat voluptate blanditiis qui fugiat quidem! Voluptate quos blanditiis, architecto at accusamus rem non itaque officiis neque harum corrupti, ad a sit magni asperiores est cum.
			Iusto culpa beatae rem omnis a fugiat. Tenetur cum eaque, sed omnis quam ex qui doloremque, animi voluptatum officiis maiores eveniet numquam nostrum at quisquam quae sint sunt iste quis.
			Placeat eos temporibus ratione nemo omnis officia quas. Possimus nemo vel optio quia a obcaecati unde ut alias voluptates, eius magni et qui odit repellendus in dolore aperiam ad expedita!
			Repellendus est eius tempora natus. Reprehenderit commodi impedit sed dolorem rerum eum cum vero nemo nam at, eius error eaque officia dignissimos asperiores optio amet maiores nisi iste quod unde!
		</div>
	</div>
	-->
	<div class="videofi" id="video-shadow">
		<iframe id="frame" src="https://www.youtube.com/embed/SkJCYNUB4vo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

	<div class="unete">
		<a href="../vista/registro.php"><img src="images/Unite.gif" width="500" height="300"></a>
	</div>

