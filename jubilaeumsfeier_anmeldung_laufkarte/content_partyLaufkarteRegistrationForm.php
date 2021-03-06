<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<h2>Formular zur Buchung von Laufkarten</h2>

				<form action="index.php#result" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="is_alumni" value="0" />
					<input type="hidden" name="laufkarte" value="1"/>

					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Titel
							</td>
							<td>
								<select name="geschlecht">
									<option value="Herr" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] === "Herr") echo "selected";}?>>Herr</option>
									<option value="Frau" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] === "Frau") echo "selected";}?>>Frau</option>
								</select>
								<select name="titel">
									<option value="" <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "") echo "selected";}?>></option>
									<option value="Dr." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr.") echo "selected";}?>>Dr.</option>
									<option value="Prof. Dr." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Prof. Dr.") echo "selected";}?>>Prof. Dr.</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Name
							</td>
							<td>
								<input type="text" name="vorname" placeholder="Vorname" size="25" <?php if(isset($_POST['vorname'])) echo "value=\"" . htmlspecialchars($_POST['vorname'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								<input type="text" name="nachname" placeholder="Nachname" size="25" <?php if(isset($_POST['nachname'])) echo "value=\"" . htmlspecialchars($_POST['nachname'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Kontakt
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35" <?php if(isset($_POST['email'])) echo "value=\"" . htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Anzahl mitgebrachter Gäste
							</td>
							<td>
								<input type="text" name="anzahl_gaeste" placeholder="" size="3" <?php if(isset($_POST['anzahl_gaeste'])) echo "value=\"" . htmlspecialchars($_POST['anzahl_gaeste'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					
                    <br>
					Hinweis: Kommen Sie alleine, so ist die Anzahl mitgebrachter Gäste 0.
					Falls sich die Gästezahl nachträglich ändert so können Sie uns dies bis spätestens eine Woche vor der Feier per E-Mail mitteilen.
					<br>
					<br>
					
                    <h3>Zahlung</h3>

					<p>
					Bitte überweisen Sie den Betrag von <?php echo ABSOLVENTENFEIER_PREIS_LAUFKARTE; ?> € pro Person bis spätestens 14 Tage nach Anmeldung auf das Konto des Absolventenvereins.<br>
					<br>
					<u>Kontodaten:</u><br>
					Absolventen- und Förderverein MPI Uni Bayreuth e.V.<br>
					IBAN: DE05 7735 0110 0038 0189 41<br>
					BIC: BYLADEM1SBT<br>
					Verwendungszweck: [Nachname],[Vorname]<br>
					
					<br>
					<br>
					Die entsprechenden Angaben finden Sie auch in der Bestätigungsmail zur Anmeldung.
					</p>

					<br>
					<button class="absenden" type="submit">Anmeldung Absenden</button>

				</form>
		