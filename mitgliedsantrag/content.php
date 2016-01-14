		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/man-looking-at-bookshelf.jpg" alt="man looking at bookshelf">
			</section>
			
			
			
			<section class="text">
		
				<h1>Mitglied bei aluMPI werden</h1>
				<br>

				<p>
				Um die Vorzüge des Vereins genießen zu können, müssen Sie Mitglied des Vereins werden. 
				Zum Beispiel werden Sie dann automatisch zur nächsten Absolventenfeier eingeladen und können sich dann im Mitgliederbereich dafür anmelden. 
				Zudem haben Sie als Mitglied des Absolventenvereins auch nach Ihrem Abschluss weiterhin die Möglichkeit am Unisport teilzunehmen.
				</p>

				<p>
				In folgendem Formular geben Sie persönliche Daten an, die es dem Verein ermöglichen mit Ihnen in Kontakt zu bleiben, und erklären somit den Beitritt zum Verein. 
				Wenn der Antrag abgesendet wird bekommen Sie eine kurze Nachricht an die angegebene E-Mail-Adresse, durch die Sie die Richtigkeit Ihrer Daten bestätigen. 
				Bitte lesen Sie vor dem Beitritt auch die Satzung und Beitragsordnung des Vereins.
				</p>

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
									<option value="Herr">Herr</option>
									<option value="Frau">Frau</option>
								</select>
								<select name="titel">
									<option value="" selected="selected"></option>
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
								Name
							</td>
							<td>
								<input type="text" name="vorname" placeholder="Vorname" size="25">
								<input type="text" name="nachname" placeholder="Nachname" size="25">
							</td>
						</tr>
						<tr>
							<td>
								Geburtsdatum
							</td>
							<td>
								<input type="text" name="geburtstag" placeholder="TT.MM.JJJJ" size="10">
							</td>
						</tr>
						<tr>
							<td>
								Kontakt
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35">
								<input type="text" name="telefon" placeholder="Telefonnummer (optional)" size="25">
							</td>
						</tr>
					</table>

					<p>
					Ich werde hiermit Mitglied und ermächtige hiermit den Absolventen- und Förderverein MPI Uni Bayreuth e.V. jederzeit widerruflich, den
					Mitgliedsbeitrag in Höhe von 10 Euro / Jahr von oben angegebenen Konto abzubuchen. Dies beinhaltet, dass ich die Satzung und
					Beitragsordnung in der derzeit gültigen Form anerkenne. <br>
					Ich bin außerdem damit einverstanden, dass meine Daten an die Universität Bayreuth zum Zwecke der Ehemaligenbetreuung weiter gegeben werden dürfen.
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
								<input type="text" name="kontoinhaber" placeholder="Vorname Nachname" size="40">
							</td>
						</tr>
						<tr>
							<td>
								Kontodaten
							</td>
							<td>
								<input type="text" name="iban" placeholder="IBAN" size="34">
								<input type="text" name="bic" placeholder="BIC" size="11">
							</td>
						</tr>
					</table>


					<p>
					<input type="checkbox" name="student">
					Ich bin Student oder aktueller Absolvent. Diese sind vom Beitrag befreit, die Kontodaten sind jedoch in jedem Fall anzugeben. 
					Für die Befreiung ist zusätzlich ein Studiennachweis eines Semesters des zu befreienden Jahres bereitzustellen. 
					Die Kontaktdaten finden Sie im Menu links unter dem Punkt Kontakt.
					</p>


					<h3>Postalische Adresse</h3>

					<p>
					<input type="checkbox" name="newsletter">
					Ich möchte den regelmäßigen Absolventen-Newsletter der Universität Bayreuth nicht beziehen. 
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
								<input type="text" name="strasse" placeholder="Straße Hausnummer" size="30">
							</td>
						</tr>
						<tr>
							<td>
								Postleitzahl, Ort
							</td>
							<td>
								<input type="text" name="plz" placeholder="PLZ" size="10">
								<input type="text" name="ort" placeholder="Ort" size="25">
							</td>
						</tr>
						<tr>
							<td>
								Land
							</td>
							<td>
								<input type="text" name="land" placeholder="Land" size="25">
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit">Absenden</button>

				</form>


			
			</section>
			
			
			
			
        </section>
		