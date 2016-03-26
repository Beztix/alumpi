<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<?php $data_output = array(); ?>
		
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
				
				
				
				<h3>Alle Mitgliederdaten aus der Datenbank abrufen</h3>
				<form action="index.php" method="POST">
					<button class="absenden" type="submit" name="mitglieder_abrufen">Mitglieder abrufen</button>
				</form>
				<br>
				<br>
				
				
				<br>
				<h3>E-Mail-Adressen abrufen</h3>
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
				<h3>Nach Mitglied suchen</h3>
				<form action="index.php" method="POST">
					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
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
				
				
				
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_vorstandsForm.php'; 
				?>
		
				
			</section>
			
			
			
			
			
			
        </section>
		