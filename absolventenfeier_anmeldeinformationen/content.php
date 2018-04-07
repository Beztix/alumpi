<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<section class="top_image">
				<img src="../_images_content/banner_absolventenfeier_tische.jpg" alt="Tische bei der Absolventenfeier">
			</section>
		
		
		
            <section class="text">

				<h1>Anmeldeinformationen zur Absolventenfeier</h1>
				
				<?php
				if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
					include 'content_anmeldungAktiv.php';
				}
				
				else {
					echo "<p>\n";
					echo "<strong>Aktuell ist keine Anmeldung zur Absolventenfeier möglich.</strong><br>\n";
					echo "<br>\n";
					echo "Die Anmeldung zur Feier wird rechtzeitig, meist ca. zwei Monate vor dem Termin der Absolventenfeier freigeschaltet.\n";
					echo "</p>\n";
				}
				?>
				
			
				
				
				
			</section>
			
			
			
			
			
			
        </section>
		