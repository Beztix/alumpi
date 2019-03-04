<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<?php $data_output = array(); ob_start();?>
		
			<section class="top_image">
				<img src="../_images_content/banner_mitgliedersuche.jpg" alt="Suche">
			</section>
		
		
		
            <section class="text">

				<h1>Mitgliedersuche</h1>
				
				<p>
				Dies ist die Suchmaske, mit der nach Mitgliedern in der Datenbank gesucht werden kann. 
				Diese kann von Finanzer, Vorstand und Admin genutzt werden und dient v.a. dazu die MID eines Mitglieds zu bestimmen, um Finanzer- und Vorstandsfunktionen eindeutig zugeordnet ausführen zu können. 
				</p>
				<br>

				<p>
				Es werden die gewünschten Mitgliedsdaten abgerufen und direkt hier auf der Seite angezeigt.<br>
				Die Kriterien werden UND-verknüpft, es werden also alle Einträge abgerufen, die ALLEN angegeben Kriterien genügen. 
				Wird ein Feld frei gelassen, so wird dieses Kriterium nicht angewendet.
				</p>
				<br>
				
				<a name="mitglied_suchen"></a>
				<form action="index.php#mitglied_suchen" method="POST">
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
				
			
				<?php
				//Einbinden der PHP-Datei zur Formularauswertung
				include 'process_mitgliedsuchenForm.php'; 		
				?>
		
				
			</section>
			
			
			
			
			
			
        </section>
		