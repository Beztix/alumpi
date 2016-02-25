<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/banner_man_writing2.jpg" alt="Mann schreibt">
			</section>
			
			
			
			<section class="text">
		
				<h1>Mitglied bei aluMPI werden</h1>

				<p>
				Um die Vorzüge des Vereins genießen zu können, müssen Sie Mitglied des Absolventen- und Fördervereins MPI Uni Bayreuth e.V. werden.
				</p>
				
				<br>
				<h2>Vorteile der Vereinsmitgliedschaft</h2>
				<p>
				### AUSFORMULIEREN ###<br>
				Zum Beispiel werden Sie dann automatisch zur nächsten Absolventenfeier eingeladen und können sich dann im Mitgliederbereich dafür anmelden. 
				Zudem haben Sie als Mitglied des Absolventenvereins auch nach Ihrem Abschluss weiterhin die Möglichkeit am Unisport teilzunehmen.
				</p>

				<br>
				<br>
				
				<p>
				In folgendem Formular geben Sie persönliche Daten an, die es dem Verein ermöglichen mit Ihnen in Kontakt zu bleiben, und erklären somit den Beitritt zum Verein. 
				Wenn der Antrag abgesendet wird bekommen Sie eine kurze Nachricht an die angegebene E-Mail-Adresse, durch die Sie die Richtigkeit Ihrer Daten bestätigen. 
				Bitte lesen Sie vor dem Beitritt auch die Satzung und Beitragsordnung des Vereins.
				</p>

				
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_memberRegistrationForm.php'; 
				?>	

				<br>				

				<h2>Beitrittserklärung</h2>

				<h3>Personalien</h3>

				<form action="index.php" method="POST" name="mitgliedsantrag">

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
								Geburtsdatum
							</td>
							<td>
								<input type="text" name="geburtstag" placeholder="TT.MM.JJJJ" size="10" <?php if(isset($_POST['geburtstag'])) echo "value=\"" . htmlspecialchars($_POST['geburtstag'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Kontakt
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35" <?php if(isset($_POST['email'])) echo "value=\"" . htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								<input type="text" name="telefon" placeholder="Telefonnummer (optional)" size="25" <?php if(isset($_POST['telefon'])) echo "value=\"" . htmlspecialchars($_POST['telefon'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>

					<p>
					Ich werde hiermit Mitglied und ermächtige hiermit den Absolventen- und Förderverein MPI Uni Bayreuth e.V. jederzeit widerruflich, den
					Mitgliedsbeitrag in Höhe von 10 Euro / Jahr von unten angegebenem Konto abzubuchen.
					Dies beinhaltet, dass ich die Satzung und Beitragsordnung in der derzeit gültigen Form anerkenne. <br>
					Ich bin außerdem damit einverstanden, dass meine Daten an die Universität Bayreuth zum Zwecke der Ehemaligenbetreuung weiter gegeben werden dürfen.<br>
					<br>
					</p>


					<h3>Bankverbindung</h3>

					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Kontoinhaber
							</td>
							<td>
								<input type="text" name="kontoinhaber" placeholder="Vorname Nachname" size="40" <?php if(isset($_POST['kontoinhaber'])) echo "value=\"" . htmlspecialchars($_POST['kontoinhaber'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Kontodaten
							</td>
							<td>
								<input type="text" name="iban" placeholder="IBAN" size="34" <?php if(isset($_POST['iban'])) echo "value=\"" . htmlspecialchars($_POST['iban'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								<input type="text" name="bic" placeholder="BIC" size="15" <?php if(isset($_POST['bic'])) echo "value=\"" . htmlspecialchars($_POST['bic'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>


					<p>
					<input type="checkbox" name="iststudent" <?php if(isset($_POST['iststudent'])) echo "checked";?>>
					Ich bin Student oder aktueller Absolvent. Diese sind vom Beitrag befreit, die Kontodaten sind jedoch in jedem Fall anzugeben. 
					Für die Befreiung ist zusätzlich ein Studiennachweis eines Semesters des zu befreienden Jahres bereitzustellen. 
					Die Kontaktdaten finden Sie im Menu links unter dem Punkt Kontakt.<br>
					<br>
					</p>


					<h3>Postalische Adresse</h3>

					<p>
					<input type="checkbox" name="newsletter" <?php if(isset($_POST['newsletter'])) echo "checked";?>>
					Ich möchte den regelmäßigen Absolventen-Newsletter der Universität Bayreuth <strong>nicht</strong> beziehen. 
					Der Newsletter wird per Post versendet, falls er gewünscht wird, müssen Angaben zur Anschrift erfolgen.
					</p>

					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Straße, Hausnummer
							</td>
							<td>
								<input type="text" name="strasse" placeholder="Straße Hausnummer" size="30" <?php if(isset($_POST['strasse'])) echo "value=\"" . htmlspecialchars($_POST['strasse'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Postleitzahl, Ort
							</td>
							<td>
								<input type="text" name="plz" placeholder="PLZ" size="10" <?php if(isset($_POST['plz'])) echo "value=\"" . htmlspecialchars($_POST['plz'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								<input type="text" name="ort" placeholder="Ort" size="25" <?php if(isset($_POST['ort'])) echo "value=\"" . htmlspecialchars($_POST['ort'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Land
							</td>
							<td>
								<input type="text" name="land" placeholder="Land" size="25" <?php if(isset($_POST['land'])) echo "value=\"" . htmlspecialchars($_POST['land'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit">Absenden</button>

				</form>

				
			
			</section>
			
			
			
			
        </section>
		