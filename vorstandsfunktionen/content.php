<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
		
			<section class="top_image">
				<img src="../_images_content/banner_vorstandsfunktionen.jpg" alt="Der Vorstand">
			</section>
		
		
		
            <section class="text">

				<h1>Vorstandsfunktionen</h1>
				
				<p>
				Hier finden sich alle Funktionen, die nur für den Vorstand nutzbar sind.
				</p>
				<br>
				<br>
				
				
				
				<h3>Alle Mitgliederdaten aus der Datenbank abrufen</h3>
				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="mitglieder_abrufen">Mitglieder abrufen</button>
				</form>

				
				
				
				
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_vorstandsForm.php'; 
				?>
		
				
			</section>
			
			
			
			
			
			
        </section>
		