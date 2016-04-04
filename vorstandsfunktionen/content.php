<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<?php $data_output = array(); ob_start();?>
		
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
				
				
				
				<h3>Alle Mitgliederdaten als CSV abrufen</h3>
				<p>
				Es werden sämtliche Mitgliederdaten aus der Datenbank abgerufen und als CSV-Datei zum Download zur Verfügung gestellt.
				</p>
				
				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="mitglieder_abrufen">Mitglieder abrufen</button>
				</form>
				<br>
				<br>
				<br>
				<br>
				
				
				<br>
				<h3>E-Mail-Adressen als CSV abrufen</h3>
				<p>
				Es werden die gewünschten E-Mail-Adresse abgerufen und als CSV-Datei zum Download zur Verfügung gestellt.<br>
				Die Kriterien werden ODER-verknüpft, es werden also alle Einträge abgerufen, die mindestens einer der ausgewählten Kriterien genügen.
				</p>
				
				<form action="index.php" method="POST">
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
				<br>
				<br>
				
				
				<br>
				<h3>Nach Mitglied suchen</h3>
				<p>
				Es werden die gewünschten Mitgliedsdaten abgerufen und direkt hier auf der Seite angezeigt.<br>
				Die Kriterien werden UND-verknüpft, es werden also alle Einträge abgerufen, die ALLEN angegeben Kriterien genügen. 
				Wird ein Feld frei gelassen, so wird dieses Kriterium nicht angewendet.
				</p>
				
				<form action="index.php" method="POST">
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
								<input type="text" name="mid" placeholder="MID" size="25" <?php if(isset($_POST['mid'])) echo "value=\"" . htmlspecialchars($_POST['mid'], ENT_QUOTES, 'UTF-8') . "\"";?>>
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
								Eintrittsdatum vor
							</td>
							<td>
								<input type="text" name="vor_datum" placeholder="TT.MM.JJJJ" size="25" <?php if(isset($_POST['vor_datum'])) echo "value=\"" . htmlspecialchars($_POST['vor_datum'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Eintrittsdatum nach
							</td>
							<td>
								<input type="text" name="nach_datum" placeholder="TT.MM.JJJJ" size="25" <?php if(isset($_POST['vor_datum'])) echo "value=\"" . htmlspecialchars($_POST['nach_datum'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					<br>
					<button class="absenden" type="submit" name="mitglied_suchen">Mitglied suchen</button>
				</form>
				<br>
				<br>
				<br>
				<br>
				
				
				<br>
				<h3>Rechtegruppen eines Mitglieds setzen</h3>
				<p>
				Wichtig: Es werden ALLE Rechte geändert, also alle Gruppen passend einstellen (auch "Mitglied")!
				</p>
				
				<form action="index.php" method="POST">
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
				<br>
				<br>
				
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_vorstandsForm.php'; 
				?>
		
				
			</section>
			
			
			
			
			
			
        </section>
		