		<section id="content">
		
		
			<section class="top_image">
				<img src="../_images_content/campus_scene_fahrrad.jpg" alt="Campus Scene Fahrrad">
			</section>
		
		
		
            <section class="text">

				<h1>Anmeldung zur Buffetteilnahme als Gast</h1>
				
				<p>
				Diese Seite ist nur zur Anmeldung zur Teilnahme am Buffet der Absolventenfeier als Fakultätsangehöriger oder eigenständiger Gast gedacht.<br>
				<br>
				Falls Sie aktueller Absolvent oder Gast eines aktuellen Absolventen sind, melden Sie sich bitte nicht mit diesem Formular an, sondern klicken Sie bitte <a href="../anmeldung_absolventenfeier/index.php#absolvent">hier</a>.<br>
				Möchten Sie lediglich am offiziellen Festakt, aber nicht am Buffet teilnehmen, so ist keine Anmeldung erforderlich.
				</p>
				<br>
				
				<?php				
				//Anmeldung aktuell möglich
				if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
					//Einbinden der PHP-Datei zur Formularauswertung
					include './process_partyGuestRegistrationForm.php';
					
					//Zeige Anmeldeformular an
					include './content_partyGuestRegistrationForm.php';
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
		