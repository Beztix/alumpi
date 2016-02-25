<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/banner_campus_scene_fahrrad.jpg" alt="Campus Uni Bayreuth">
			</section>
			
			
			
			<section class="text">
			
				<h1>Email-Verifikation</h1>
				<br>
			
				<?php
				//Wenn die GET-Variablen passend gesetzt sind: Versuche die Verifikation durchzuführen
				if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['verificationCode']) && !empty($_GET['verificationCode'])){
					
					include 'verifyEmail.php';
					
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
		