<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<section class="top_image">
				<img src="../_images_content/banner_woman_writing2.jpg" alt="Frau schreibt in Terminkalender">
			</section>
		
		
		
            <section class="text">

				<h1>Anmeldung zur Teilnahme an den Feierlichkeiten als Gast</h1>
				
				<p>
				Diese Seite ist nur zur Anmeldung zur Teilnahme an den Feierlichkeiten der Absolventenfeier als <strong>Fakultätsangehöriger</strong> oder <strong>eigenständiger Gast</strong> gedacht.<br>
				Möchten Sie lediglich am offiziellen Festakt, aber nicht an den anschließenden Feierlichkeiten mit Buffet teilnehmen, so ist keine Anmeldung erforderlich.<br>
				<br>
				Falls Sie aktueller Absolvent oder Gast eines aktuellen Absolventen sind, 
				melden Sie sich bitte nicht mit diesem Formular an, sondern klicken Sie bitte <a href="../absolventenfeier_anmeldeinformationen/index.php#absolvent">hier</a>.<br>
				<br>
				
				</p>
				<br>
				
				<?php				
				//Anmeldung aktuell möglich
				if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
					//Zeige Anmeldeformular an
					include './content_partyGuestRegistrationForm.php';
					
					//Einbinden der PHP-Datei zur Formularauswertung
					echo "<div id=\"result\"></div>\n";
					include './process_partyGuestRegistrationForm.php';					
				}
				
				
				//Anmeldung aktuell nicht möglich
				else {
					echo "<p>\n";
					echo "Aktuell ist keine Anmeldung zur Absolventenfeier möglich.\n";
					echo "</p>\n";
				}
				?>
				
				
				
				
				
			</section>
			
			
			
			
			
			
        </section>
		