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
				<img src="../_images_content/banner_finanzerfunktionen.jpg" alt="Der Vorstand">
			</section>
		
		
		
            <section class="text">

				<h1>Finanzerfunktionen</h1>
				
				<p>
				Hier finden sich alle Funktionen, die für den Finanzer relevant sind.
				</p>
				<br>
				<br>
					
				<br>
				<h2>Studentennachweis eines Mitglieds setzen</h2>
				<p>
				Es wird der Status des DB-Eintrags "Studentennachweis vorhanden" des Mitglieds mit der eingegebenen MID gesetzt.
				</p>
				
				<form action="index.php" method="POST">
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
						<tr>
							<td>
								Nachweis vorhanden?
							</td>
							<td>
								<select name="studentennachweis">
									<option value="j">Ja</option>
									<option value="n">Nein</option>
								</select> 
							</td>
						</tr>
					</table>
					<br>
					
					<button class="absenden" type="submit" name="studentennachweis_setzen">Studentennachweis setzen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung		
				include 'process_studentennachweissetzenForm.php'; 
				?>
				<br>
				<br>
				
				
				
				<br>
				<h2>Bezahlung der Absolventenfeier eines Mitglieds setzen</h2>
				<p>
				Es wird der Status des DB-Eintrags "hat bezahlt" des Mitglieds mit der eingegebenen Feier-ID in der Datenbank der Absolventenfeier-Anmeldungen gesetzt.<br>
				Die FID muss auf der Seite "Orga-Team-Funktionen" mittels der Suche (nicht mit der Mitgliedersuche) ermittelt werden!
				</p>
				
				<form action="index.php" method="POST">
					<table style="width:100%">
						<colgroup>
							<col style="width:29%;">
							<col style="width:71%;">
						</colgroup>
						<tr>
							<td>
								Feier-ID
							</td>
							<td>
								<input type="text" name="fid" placeholder="FID" size="25">
							</td>
						</tr>
						<tr>
							<td>
								Hat bezahlt?
							</td>
							<td>
								<select name="hat_bezahlt">
									<option value="j">Ja</option>
									<option value="n">Nein</option>
								</select> 
							</td>
						</tr>
					</table>
					<br>
					
					<button class="absenden" type="submit" name="feier_bezahlt_setzen">Absolventenfeier bezahlt setzen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung		
				include 'process_feierbezahltsetzenForm.php'; 
				?>
				<br>
				<br>
				
				
				
				<h2>E-Mail-Adressen zu fehlenden Studentennachweisen abrufen</h2>
				<p>
				Es werden die E-Mail-Adressen aller Mitglieder abgerufen, die selbst angegeben haben Student zu sein, bei denen laut Datenbank aber noch kein Studentennachweis vorliegt.<br>
				An diese Mitglieder kann dann noch eine Erinnerungsmail vor dem Einzug der Mitgliedsbeiträge geschickt werden.
				</p>


				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="fehlende_studentennachweise_abrufen">E-Mail-Adressen abrufen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_fehlendenachweiseForm.php'; 
				?>
				<br>
				<br>
				
				
				
				
				<h2>Alle Studentennachweise zurücksetzen</h2>
				<p>
				Diese Funktion setzt ALLE Einträge von "studentennachweis vorhanden" in der DB wieder auf false. <br>
				Dies sollte einmal zu Beginn des Jahres gemacht werden, um die neuen Studentennachweise eintragen zu können.
				</p>


				<form action="index.php" method="POST" onsubmit="return confirm('Sollen wirklich ALLE Einträge über vorhandene Studentennachweise auf false gesetzt werden?');">
					<button class="absenden" type="submit" name="studentennachweise_zuruecksetzen">Studentennachweise zurücksetzen</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_studentennachweisezuruecksetzenForm.php'; 
				?>
				<br>
				<br>
				
				
				
				
				
				
				<h2>SEPA-XML-Datei zum Einzug der diesjährigen Mitgliedsbeiträge erzeugen</h2>
				<p>
				Diese Funktion erzeugt aus der Datenbank eine SEPA-XML-Datei, die zum Einzug der Mitgliedsbeiträge an die Bank übermittelt wird.<br>
				Es wird der Mitgliedsbeitrag von allen Mitgliedern eingezogen, die nicht erst in diesem Jahr Mitglied wurden, und bei denen "studentennachweis vorhanden" 
				in der DB auf false gesetzt ist.
				</p>


				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="sepa_einzug_generieren">SEPA-XML-Datei generieren</button>
				</form>
				<br>
				<br>
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_sepaEinzugGenerierenForm.php'; 
				?>

				<div style="margin-left:80px;">
				
					<h3>Kontrolldateien herunterladen</h3>
					<p>
					<strong>Diese Funktionen sind erst NACH dem Generieren der SEPA-XML-Datei verwendbar (ansonsten ggf. veraltet)!</strong><br>
					Sie dienen v.a. der Kontrolle der generierten SEPA-XML-Datei, um mittels der Gesamtzahl der Buchungssätze zu überprüfen, ob alle Datensätze aus der Datenbank korrekt gefiltert 
					und verarbeitet werden. Die Gesamtzahl der Mitglieder in der Datenbank muss dabei der Summe der Einträge in diesen vier Kontrolldateien entsprechen.
					</p>

					<br>
					
					<p>
					Diese Funktionen erzeugt die Kontrolldatei, die alle Mitgliedsdaten von Mitgliedern enthält, deren Bankdaten fehlerhaft sind.<br>
					Von diesen Mitgliedern kann kein Beitrag eingezogen werden.
					</p>
					<form action="index.php" method="POST">
						<button class="absenden" type="submit" name="inkorrekte_bankdaten">Inkorrekte Bankdaten herunterladen</button>
					</form>
					<br>
					<br>
					
					<p>
					Diese Funktionen erzeugt die Kontrolldatei, die alle Mitgliedsdaten von Mitgliedern enthält, die erst im aktuellen Jahr Mitglied wurden (und deren Bankdaten korrekt sind).<br>
					Von diesen Mitgliedern wird kein Beitrag eingezogen, da der Stichtag zum Einzug immer der Jahreswechsel ist.
					</p>
					<form action="index.php" method="POST">
						<button class="absenden" type="submit" name="neue_mitglieder">Neue Mitglieder herunterladen</button>
					</form>
					<br>
					<br>
					
					<p>
					Diese Funktionen erzeugt die Kontrolldatei, die alle Mitgliedsdaten von Mitgliedern enthält, die eine gültige Studienbescheinigung eingereicht haben 
					(und die nicht erst seit diesem jahr Mitglied sind und korrekte Bankdaten angegeben haben).<br>
					Von diesen Mitgliedern wird kein Beitrag eingezogen, da sie laut Stazung vom Beitrag befreit sind.
					</p>
					<form action="index.php" method="POST">
						<button class="absenden" type="submit" name="studienbescheinigungen">Mitglieder mit Studienbescheinigung herunterladen</button>
					</form>
					<br>
					<br>
					
					<p>
					Diese Funktionen erzeugt die Kontrolldatei, die alle Mitgliedsdaten von Mitgliedern enthält, von denen der Beitrag eingezogen werden soll.
					</p>
					<form action="index.php" method="POST">
						<button class="absenden" type="submit" name="zahler">Zahler herunterladen</button>
					</form>
					<br>
					<br>
					
				
					<?php
					//Einbinden der PHP-Datei zur Formularauswertung
					include 'process_kontrollDateienForm.php'; 
					?>
				
				
				</div>
				
				<br>
		
				
			</section>
			
			
			
			
			
			
        </section>
		