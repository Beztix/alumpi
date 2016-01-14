		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/man-looking-at-bookshelf.jpg" alt="man looking at bookshelf">
			</section>
			
			
			
			<section class="text">
		
				<br>
				<br>
				<br>

				<form action="index.php" method="POST" name="login">

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
						
						<tr>
							<td>
								Passwort
							</td>
							<td>
								<input type="password" name="pwd" size="20">
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit">Login</button>

				</form>	
						
						
						

				<?php
				include '../config.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					//Nicht alle Felder ausgefüllt
					if(empty($_POST['email']) || empty($_POST['pwd'])) {
						echo "Es wurden nicht alle Felder ausgefüllt.";
					}
					
					//Alle Felder ausgefüllt
					else {
						echo "test - formular ausgefüllt abgeschickt <br>";
						
						//Zur Datenbank verbinden
						//$conn = mysql_connect("mysql","alumpi","KdsUUscR6NYX2Ust");
						$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
						if (!$conn) {
							echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
							echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
						}
						else {
							echo "Datenbankverbindung erfolgreich!<br>";
						}
						
						
						
						echo $_POST['email'];
						echo $_POST['pwd'];
					}

				}



				//Formular (noch) nicht abgeschickt
				else {
					echo "test - formular noch nicht abgeschickt";
				}

				?> 
			
			</section>
			
			
			
			
        </section>
		