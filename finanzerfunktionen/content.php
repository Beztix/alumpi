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
				<h3>Studentennachweis eines Mitglieds setzen</h3>
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
				<h3>Bezahlung der Absolventenfeier eines Mitglieds setzen</h3>
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
				
				
				
				<h3>E-Mail-Adressen zu fehlenden Studentennachweisen abrufen</h3>
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
				
				
				
				
				<h3>Alle Studentennachweise zurücksetzen</h3>
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
				
				
				
				
				
				
				<h3>SEPA-XML-Datei zum Einzug der diesjährigen Mitgliedsbeiträge erzeugen</h3>
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
				<br>
				<br>
		
				
			</section>
			
			
			
			
			
			
        </section>
		