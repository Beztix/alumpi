<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<?php 
			//Einbinden von auth.php, um diese Seite nur eingeloggten Mitgliedern zur Verfügung zu stellen
			require '../_includes_functionality/auth.php'; echo "\n"; 
			?>
		
		
			<section class="top_image">
				<img src="../_images_content/banner_daten.jpg" alt="Kalenderdaten">
			</section>
		
		
	
		
            <section class="text">
	
			
			
				<h1>Datenabfrage</h1>
				
				Hier können Sie ihre Mitgliedsdaten abfragen und ändern.<br>
				Falls sie Daten ändern möchten, tragen Sie die neuen Daten in die Eingabefelder ein. Wenn sie Felder leer lassen, findet für diese Daten keine Änderung statt.<br>
				
				<br>
				
				<?php
				//Einbinden der PHP-Datei um die Mitgliedsdaten abzurufen
				include '../_includes_functionality/get_memberdata_from_db.php'; 
				
				
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_memberdataForm.php'; 
				

				//Abfrage einer GET-Variable, um festzustellen ob die Seite neu geladen wurde, nachdem ein DB-Update erfolgreich ausgeführt wurde
				if(isset($_GET['status'])){
						if($_GET['status'] === 'success') {
							
							echo "<h3 class=\"green\">Änderung erfolgreich!</h3>\n";
							echo "<p class=\"green\">\n";
							echo "Die geänderten Daten wurden erfolgreich in die Datenbank eingetragen, kontrollieren Sie die Änderungen bitte noch einmal in der unten stehenden Tabelle.<br>\n";
							echo "Falls Sie ihr Passwort geändert haben überprüfen Sie die erfolgreiche Änderung bitte, indem Sie sich aus- und wieder einloggen.<br>\n";
							echo "</p>\n";
						}
				}
				?>
				
				<br>
				
				<form action="index.php" method="POST" name="datenabfrage">
				
				
					<table class="striped" style="width:100%">
						
						<colgroup>
							<col style="width:26%;">
							<col style="width:37%;">
							<col style="width:37%;">
						</colgroup>
						
						<tr>
							<th>
								
							</th>
							<th>
								Aktueller Eintrag
							</th>
							<th>
								Änderung
							</th>
						</tr>
						
						<tr>
							<td>
								Mitglieds-ID
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['mid'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								
							</td>
						</tr>
						
						<tr>
							<td>
								Eintrittsdatum
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['eintrittsdatum'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								
							</td>
						</tr>
						
						<tr>
							<td>
								Titel
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['titel'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<select name="titel">
									<option value=""></option>
									<option value="B.Sc.">B.Sc.</option>
									<option value="M.Sc.">M.Sc.</option>
									<option value="M.Ed.">M.Ed.</option>
									<option value="Dr. rer. nat.">Dr. rer. nat.</option>
									<option value="Dr.-Ing.">Dr.-Ing.</option>
									<option value="Dr. mult.">Dr. mult.</option>
									<option value="Dr. h. c.">Dr. h. c.</option>
									<option value="Dr. habil.">Dr. habil.</option>
									<option value="Dipl.-Inf.">Dipl.-Inf.</option>
									<option value="Dipl.-Ing.">Dipl.-Ing.</option>
									<option value="Dipl.-Math.">Dipl.-Math.</option>
									<option value="Dipl.-Phys.">Dipl.-Phys.</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>
								Vorname
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['vorname'], ENT_QUOTES, 'UTF-8');?>
							</td>
							<td>
								<input type="text" name="vorname" placeholder="Vorname" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Nachname
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['nachname'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="nachname" placeholder="Nachname" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Geburtsdatum
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['geburtstag'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="geburtstag" placeholder="TT.MM.JJJJ" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Email-Adresse
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['email'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35">
							</td>
						</tr>
						
						<tr>
							<td>
								Telefonnummer
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['telefon'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="telefon" placeholder="Telefonnummer (optional)" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Newsletter abonniert
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['newsletter'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<select name="newsletter">
									<option value="" selected></option>
									<option value="j">Ja</option>
									<option value="n">Nein</option>
								</select>
							</td>
						</tr>
						
						
						<tr>
							<td>
								Straße, Hausnummer
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['strasse'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="strasse" placeholder="Straße Hausnummer" size="30">		
							</td>
						</tr>
						
						<tr>
							<td>
								PLZ
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['plz'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="plz" placeholder="PLZ" size="10">
							</td>
						</tr>
						
						<tr>
							<td>
								Ort
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['ort'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="ort" placeholder="Ort" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Land
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['land'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="land" placeholder="Land" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Student
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['iststudent'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<select name="iststudent">
									<option value="" selected></option>
									<option value="j">Ja</option>
									<option value="n">Nein</option>
								</select>
							</td>
						</tr>
												
						<tr>
							<td>
								Kontoinhaber
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['kontoinhaber'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="kontoinhaber" placeholder="Vorname Nachname" size="40">
							</td>
						</tr>
												
						<tr>
							<td>
								IBAN
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['iban'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="iban" placeholder="IBAN" size="34">
							</td>
						</tr>
												
						<tr>
							<td>
								BIC
							</td>
							<td>
								<?php echo htmlspecialchars($data_output['bic'], ENT_QUOTES, 'UTF-8'); ?>
							</td>
							<td>
								<input type="text" name="bic" placeholder="BIC" size="15">
							</td>
						</tr>
												
						<tr>
							<td>
								Passwort
							</td>
							<td>
								
							</td>
							<td>
								<input type="password" name="passwort" autocomplete="off" placeholder="Neues Passwort" size="25">
							</td>
						</tr>
												
						<tr>
							<td>
							
							</td>
							<td>
								
							</td>
							<td>
								<input type="password" name="passwort2" autocomplete="off" placeholder="Neues Passwort wiederholen" size="25">
							</td>
						</tr>
						
					</table>
				
					<br>
					<button class="absenden" type="submit">Absenden</button>

				</form>
		
		
				
			</section>
			

			
        </section>
		