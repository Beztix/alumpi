<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<br>
				Um den Mitgliederbereich zu nutzen, melden Sie sich bitte mit Ihren Zugangsdaten an.<br>
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
					//Einbinden der PHP-Datei zur Auswertung des Login-Formulars
					include 'login_script.php'; 
				?>