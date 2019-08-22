<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<?php $data_output = array(); ob_start();?>
		
			<section class="top_image">
				<img src="../_images_content/banner_orgafunktionen.jpg" alt="Der Vorstand">
			</section>
		
		
		
            <section class="text">

				<h1>Orga-Team-Funktionen</h1>
				
				<p>
				Hier finden sich alle Funktionen, die die Absolventenfeier betreffen.
				</p>
				<br>
				<br>
				
				
				<h2>Daten der aktuellen Absolventenfeier</h2>
				<?php
				include 'get_partydata_from_db.php';
				?>
				
				
				<table style="width:100%">
					<colgroup>
						<col style="width:50%;">
						<col style="width:50%;">
					</colgroup>
					
					
					<tr>
						<td>
							Datum der Feier
						</td>
						<td>
							<?php echo ABSOLVENTENFEIER_DATUM; ?>
						</td>
					</tr>
					<tr>
						<td>
							Uhrzeit, Ort
						</td>
						<td>
							<?php echo ABSOLVENTENFEIER_UHRZEIT . ', ' . ABSOLVENTENFEIER_ORT; ?>
						</td>
					</tr>
					<tr>
						<td>
							Anmeldeschluss
						</td>
						<td>
							<?php echo ABSOLVENTENFEIER_ANMELDESCHLUSS; ?>
						</td>
					</tr>
					<tr>
						<td>
							Eintrittspreis
						</td>
						<td>
							<?php echo ABSOLVENTENFEIER_PREIS; ?> €
						</td>
					</tr>
					<tr>
						<td>
							Angemeldete aktuelle Absolventen
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_absolventen'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Angemeldete mitgebrachte Gäste
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_mitgebrachter_gaeste'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Angemeldete eigenständige Gäste
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_separater_gaeste'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Angemeldete Laufgäste
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_laufkarten'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					<tr>
						<td>
							Gesamtzahl Anmeldungen
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_anmeldungen_gesamt'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					
				
				</table>
				
				<br>
				<br>
				<br>
				
				<h2>Alle Anmeldungen als CSV abrufen</h2>
				<p>
				Es werden sämtliche Daten aller zur aktuellen Absolventenfeier angemeldeten Personen aus der Datenbank abgerufen und als CSV-Datei zum Download zur Verfügung gestellt.<br>
				ACHTUNG: Die generierte CSV-Datei enthält SÄMLICHE Daten zu den Anmeldungen aus der Datenbank, also bitte sorgsam mit der Datei umgehen.
				</p>
				
				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="anmeldungen_abrufen">Anmeldungen abrufen</button>
				</form>
				<br>
				<br>
				<br>
				<br>
				
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_orgaForm.php'; 
				?>

				
				
				
				<h2>Anmeldungssuche</h2>
				
				<p>
				Dies ist die Suchmaske, mit der nach Anmeldungen in der Absolventenfeier-Datenbank gesucht werden kann. 
				Diese kann von Orga-Team, Finanzer, Vorstand und Admin genutzt werden und dient v.a. dazu die Feier-ID eines Mitglieds zu bestimmen, 
				um Finanzer- und Vorstandsfunktionen eindeutig zugeordnet ausführen zu können.<br>
				<br>
				Es werden die gewünschten Anmeldungsdaten abgerufen und direkt hier auf der Seite angezeigt.<br>
				Die Kriterien werden UND-verknüpft, es werden also alle Einträge abgerufen, die ALLEN angegeben Kriterien genügen. 
				Wird ein Feld frei gelassen, so wird dieses Kriterium nicht angewendet.
				</p>
				<br>
				
				
				<a name="anmeldung_suchen"></a>
				<form action="index.php#anmeldung_suchen" method="POST">
					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Feier-ID
							</td>
							<td>
								<input type="text" name="fid" placeholder="FID" size="25" <?php if(isset($_POST['fid'])) echo "value=\"" . htmlspecialchars($_POST['fid'], ENT_QUOTES, 'UTF-8') . "\"";?>>
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
								Datum der Feier
							</td>
							<td>
								<input type="text" name="datum_der_feier" placeholder="TT.MM.JJJJ" size="25" <?php if(isset($_POST['datum_der_feier'])) echo "value=\"" . htmlspecialchars($_POST['datum_der_feier'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit" name="anmeldung_suchen">Anmeldung suchen</button>
				</form>
				<br>
				<br>
			
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_anmeldungsuchenForm.php'; 		
				?>
				
				<br>
				<br>
		
				
			</section>
			
			
			
			
			
			
        </section>
		