<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
	
	
	
			<section class="top_image">
				<img src="../_images_content/banner_daten.jpg" alt="Kalenderdaten">
			</section>
		
		
		
            <section class="text">
	
			
			
				<h1>Downloads</h1>
				
				Hier finden Sie alle Downloads rund um Ihre Mitgliedschaft bei aluMPI.<br>
				
				<br>
				
				<a name="mitgliedsbescheinigung"></a>
				<h2>Mitgliedsbescheinigung generieren</h2>
				<p>
				Mit dieser Funktion können Sie direkt ihre eigene Mitgliedsbescheinigung für das aktuelle Jahr generieren lassen und herunterladen.
				</p>
				
				<form action="index.php#mitgliedsbescheinigung" method="POST">
					<button class="absenden" type="submit" name="mitgliedsbescheinigung">Mitgliedsbescheinigung herunterladen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_mitgliedsbescheinigungForm.php'; 
				?>
				<br>
				<br>
		
		
				
			</section>
			

			
        </section>
		