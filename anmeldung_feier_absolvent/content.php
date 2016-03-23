<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<section class="top_image">
				<img src="../_images_content/banner_absolventenfeier_urkundenuebergabe.jpg" alt="Urkundenübergabe bei der Absolventenfeier">
			</section>
		
		
	
		
            <section class="text">
	
			
			
				<h1>Anmeldung zur Absolventenfeier als aktueller Absolvent</h1>
				
				<p>
				Auf dieser Seite können Sie sich zur Absolventenfeier als <strong>aktueller Absolvent</strong> anmelden.<br>
				Sie nehmen damit an der Feier teil und erhalten während des Festakts eine Abschlussurkunde der Fakultät. 
				Außerdem haben Sie die Möglichkeit, Ihre mitgebrachten Gäste mit anzumelden.<br>
				</p>
				
				
		
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include './process_partyGraduateRegistrationForm.php';
				
				//Einbinden der PHP-Datei um die Anmeldedaten des Mitglieds abzurufen
				include './get_partyRegistrationData_from_DB.php'; 

				
				//User ist bereits zur Feier angemeldet (durch die DB-Abfrage ermittelt)
				if($userIsRegistered) {
					include './content_alreadyRegistered.php';
				}
				
				
				//User ist nicht zur Feier angemeldet
				else {

					//Anmeldung aktuell möglich
					if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
						//Zeige Anmeldeformular an
						include './content_partyGraduateRegistrationForm.php';
					}
					
					
					//Anmeldung aktuell nicht möglich
					else {
						echo "<p>\n";
						echo "Aktuell ist keine Anmeldung zur Absolventenfeier möglich.\n";
						echo "</p>\n";
					}
				}
				?>
				
		
				
			</section>
			

			
        </section>
		