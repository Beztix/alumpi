<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/banner_campus_scene_fahrrad.jpg" alt="Campus Uni Bayreuth">
			</section>
			
			
			
			<section class="text">
			
				<h1>Passwort Zurücksetzen</h1>
				<br>
			
				<?php
				//Wenn die GET-Variablen passend gesetzt sind: Zeige Formular zum Eingeben eines neuen Passworts an
				if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['resetCode']) && !empty($_GET['resetCode'])){
					
					include 'verifyResetCode.php';
					
				}
				
				//Wenn die GET-Variablen eine erfolgte Änderung anzeigen: Zeige Erfolgmeldung an
				else if(isset($_GET['status'])){
						if($_GET['status'] === 'success') {

							// Änderung erfolgreich
							echo "<h3 class=\"green\">Passwortänderung erfolgreich!</h3>\n";
							echo "<p class=\"green\">\n";
							echo "Ihr neues Passwort wurde erfolgreich in die Datenbank eingetragen, Sie können sich ab sofort damit im Mitgliederbereich anmelden.<br>\n";
							echo "</p>\n";
						}
				}
				
				//GET-Variablen nicht passend gesetzt
				else{
					
					// Invalid approach
					echo "<p>";
					echo "Inkorrekter Zugriff auf diese Unterseite, bitte verwenden Sie den Link aus der versendeten E-Mail.<br>";
					echo "Bei Problemen wenden Sie sich bitte an alumpi@uni-bayreuth.de";
					echo "</p>";
				}
				?>
				
				
				

			
			</section>
			
			
			
			
        </section>
		