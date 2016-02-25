<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<?php 
			//Einbinden von auth.php, um diese Seite nur eingeloggten Mitgliedern zur Verfügung zu stellen
			require '../_includes_functionality/auth.php'; echo "\n"; 
			?>
		
		
			<section class="top_image">
				<img src="../_images_content/campus_scene_fahrrad.jpg" alt="Campus Scene Fahrrad">
			</section>
		
		
		
            <section class="text">

				<h1>Logout</h1>
				
				<br>
				Zum Abmelden aus dem Mitgliederbereich bitte hier klicken:<br>
				<br>
				<form action="./logout_script.php">
					<button class="absenden" type="submit">Logout</button>
				</form>
				<br>
				
			</section>
			
			
			
			
			
			
        </section>
		