<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/man-looking-at-bookshelf.jpg" alt="man looking at bookshelf">
			</section>
			
			
			
			<section class="text">
			
				<h1>Passwort Vergessen</h1>
				<br>
			
				<p>
				Falls Sie ihr Passwort vergessen haben geben Sie bitte ihre E-Mail-Adresse ein, 
				wir werden Ihnen eine E-Mail mit Instruktionen zum Zurücksetzen des Passworts schicken.
				</p>


				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_sendResetEmailForm.php'; 
				?>	

				<form action="index.php" method="POST" name="reset_password">

					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						
						<tr>
							<td>
								E-Mail-Adresse
							</td>
							<td>
								<input type="text" name="email" size="35">
							</td>
						</tr>
						
					</table>
					<br>
					<button class="absenden" type="submit">E-Mail Versenden</button>

				</form>	
				
				
				

			
			</section>
			
			
			
			
        </section>
		