<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<h2>Formular zur Buchung von Festaktkarten</h2>

				<form action="index.php#result" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="is_alumni" value="0" />
                    <input type="hidden" name="laufkarte" value="0"/>

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
									<option value="B.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "B.Sc.") echo "selected";}?>>B.Sc.</option>
									<option value="B.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "B.Ed.") echo "selected";}?>>B.Ed.</option>
									<option value="M.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "M.Sc.") echo "selected";}?>>M.Sc.</option>
									<option value="M.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "M.Ed.") echo "selected";}?>>M.Ed.</option>
									<option value="Dr. rer. nat." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. rer. nat.") echo "selected";}?>>Dr. rer. nat.</option>
									<option value="Dr.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr.-Ing.") echo "selected";}?>>Dr.-Ing.</option>
									<option value="Dr. mult." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. mult.") echo "selected";}?>>Dr. mult.</option>
									<option value="Dr. h. c." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. h. c.") echo "selected";}?>>Dr. h. c.</option>
									<option value="Dr. habil." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. habil.") echo "selected";}?>>Dr. habil.</option>
									<option value="Dipl.-Inf." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Inf.") echo "selected";}?>>Dipl.-Inf.</option>
									<option value="Dipl.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Ing.") echo "selected";}?>>Dipl.-Ing.</option>
									<option value="Dipl.-Math." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Math.") echo "selected";}?>>Dipl.-Math.</option>
									<option value="Dipl.-Phys." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Phys.") echo "selected";}?>>Dipl.-Phys.</option>
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
					Bitte überweisen Sie den Betrag von <?php echo ABSOLVENTENFEIER_PREIS; ?> € pro Person bis spätestens 7 Tage vor der Feier auf das Konto des Absolventenvereins.<br>
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
					
					<div>
						
						<br>
						<h2>Verwendung der Kontaktdaten</h2>
						<p>
						Sie können unsere Vereinsarbeit unterstützen, indem Sie uns erlauben Ihre E-Mail-Adresse zu speichern.
						Wir verwenden diese, um Sie im Sinne unserer Vereinsarbeit (d.h. beispielsweise über das nächste Homecoming-Event) zu informieren.
						Diese Adressliste wird von uns nicht weitergegeben und Sie erhalten maximal einige wenige Mails pro Jahr von uns.
						<br>
						</p>
						
						<p>
						<input id="datenspeicherungCheckbox" type="checkbox" name="datenspeicherung" checked>
						Ja, ich gestatte dem Absolventen- und Förderverein MPI Uni Bayreuth e.V. die Speicherung und Nutzung meiner Kontaktdaten im Sinne der Vereinsarbeit. 
						</p>
					
					
					</div>

					<br>
					<button class="absenden" type="submit">Anmeldung Absenden</button>

				</form>
		