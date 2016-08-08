<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<?php 
			//Buffern des PHP-Outputs, um während PHP-Verarbeitung HTTP-Header schicken zu können
			//(Benötigt um Dateidownload aus geschütztem Bereich zu initiieren)
			$data_output = array(); ob_start();
			?>
		
			<section class="top_image">
				<img src="../_images_content/banner_vorstandsfunktionen.jpg" alt="Der Vorstand">
			</section>
		
		
		
            <section class="text">

				<h1>Vorstandsfunktionen</h1>
				
				<p>
				Hier finden sich alle Funktionen, die nur für den Vorstand nutzbar sind.
				</p>
				<br>
				<br>
				
				
				<a name="mitglieder_abrufen"></a>
				<h2>Alle Mitgliederdaten als CSV abrufen</h2>
				<p>
				Es werden sämtliche Mitgliederdaten aus der Datenbank abgerufen und als CSV-Datei zum Download zur Verfügung gestellt.<br>
				ACHTUNG: Die generierte CSV-Datei enthält SÄMLICHE Daten der Mitglieder aus der Datenbank, also bitte sorgsam mit der Datei umgehen.
				</p>
				
				<form action="index.php#mitglieder_abrufen" method="POST">
					<button class="absenden" type="submit" name="mitglieder_abrufen">Mitglieder abrufen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_mitgliederabrufenForm.php'; 
				?>
				<br>
				<br>
				
				
				<br>
				<a name="emails_abrufen"></a>
				<h2>E-Mail-Adressen als CSV abrufen</h2>
				<p>
				Es werden die gewünschten E-Mail-Adresse abgerufen und als CSV-Datei zum Download zur Verfügung gestellt.<br>
				Die Kriterien werden ODER-verknüpft, es werden also alle Einträge abgerufen, die mindestens einer der ausgewählten Kriterien genügen.
				</p>
				
				<form action="index.php#emails_abrufen" method="POST">
					<input type="checkbox" name="foerderer"> Förderer
					<input type="checkbox" name="mitglied"> Mitglieder
					<input type="checkbox" name="orga"> Orga-Team
					<input type="checkbox" name="kuratorium"> Kuratorium
					<input type="checkbox" name="finanzer"> Finanzer
					<input type="checkbox" name="vorstand"> Vorstand
					<input type="checkbox" name="admin"> Admins
					<br>
					<br>
					<button class="absenden" type="submit" name="emails_abrufen">E-Mail-Adressen abrufen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_emailsabrufenForm.php';
				?>
				<br>
				<br>
				
				
				
				<br>
				<a name="rechte_aendern"></a>
				<h2>Rechtegruppen eines Mitglieds setzen</h2>
				<p>
				Wichtig: Es werden ALLE Rechte geändert, also alle Gruppen passend einstellen (auch "Mitglied")!<br>
				Änderungen bitte anschließend über die Mitglieds-Suche noch einmal überprüfen.
				</p>
				
				<form action="index.php#rechte_aendern" method="POST">
					<table style="width:100%">
						<colgroup>
							<col style="width:29%;">
							<col style="width:71%;">
						</colgroup>
						<tr>
							<td>
								Mitglieds-ID
							</td>
							<td>
								<input type="text" name="mid" placeholder="MID" size="25">
							</td>
						</tr>
					</table>
					<br>
					<table style="width:100%">
						<colgroup>
							<col style="width:15%;">
							<col style="width:14%;">
							<col style="width:14%;">
							<col style="width:14%;">
							<col style="width:14%;">
							<col style="width:14%;">
							<col style="width:15%;">
						</colgroup>
						<tr>
							<td>
								Förderer
							</td>
							<td>
								Mitglied
							</td>
							<td>
								Orga
							</td>
							<td>
								Kuratorium
							</td>
							<td>
								Finanzer
							</td>

							<td>
								Vorstand
							</td>
							<td>
								Admin
							</td>
						</tr>
						<tr>
							<td>
								<select name="foerderer">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
							<td>
								<select name="mitglied">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
							<td>
								<select name="orga">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
							<td>
								<select name="kuratorium">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
							<td>
								<select name="finanzer">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>

							<td>
								<select name="vorstand">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
							<td>
								<select name="admin">
									<option value="0">Nein</option>
									<option value="1">Ja</option>
								</select>
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit" name="rechte_aendern">Rechte ändern</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung		
				include 'process_rechteaendernForm.php'; 
				?>
				<br>
				<br>
				
				
				<br>
				<a name="mail_verschicken"></a> 
				<h2>Bestätigungsmail eneut schicken</h2>
				<p>
				Diese Funktion versendet die bei der Anmeldung zum Verein verschickte Bestätigungsmail mit dem Code zur Verifikation der E-Mail-Adresse erneut.
				</p>
				
				<form action="index.php#mail_verschicken" method="POST">
					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Mitglieds-ID
							</td>
							<td>
								<input type="text" name="mid" placeholder="MID" size="25">
							</td>
						</tr>
					</table>
					<br>
					<br>
					<button class="absenden" type="submit" name="mail_verschicken">Mail verschicken</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_mailverschickenForm.php'; 
				?>
				<br>
				<br>
				
				
				
				<br>
				<a name="mitglied_loeschen"></a>
				<h2>Mitglied aus der Datenbank löschen</h2>
				<p>
				Diese Funktion entfernt ein Mitglied aus der Datenbank, dies is im Falle eines Austritts aus dem Verein durchzuführen.
				Zur Sicherheit muss neben der MID auch der Nachname eingegeben werden.<br>
				Achtung: Es werden ALLE Daten dieses Mitglieds gelöscht, dies kann nicht rückgängig gemacht werden!
				</p>
				
				<form action="index.php#mitglied_loeschen" method="POST" onsubmit="return confirm('Soll dieses Mitglied wirklich endgültig aus der Datenbank gelöscht werden?');">
					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Mitglieds-ID
							</td>
							<td>
								<input type="text" name="mid" placeholder="MID" size="25">
							</td>
						</tr>
						<tr>
							<td>
								Nachname
							</td>
							<td>
								<input type="text" name="nachname" placeholder="Nachname" size="25">
							</td>
						</tr>
					</table>
					<br>
					<br>
					<button class="absenden" type="submit" name="mitglied_loeschen">Mitglied löschen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_mitgliedLoeschenForm.php'; 
				?>
				<br>
				<br>
				
				
			</section>
			
			
			
			
			
			
        </section>
		