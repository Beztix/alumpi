<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
		
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
				
				
				<h3>Daten der aktuellen Absolventenfeier</h3>
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
							Gesamtzahl Anmeldungen
						</td>
						<td>
							<?php echo htmlspecialchars($data_output['anzahl_anmeldungen_gesamt'], ENT_QUOTES, 'UTF-8'); ?>
						</td>
					</tr>
					
				
				</table>

		
				
			</section>
			
			
			
			
			
			
        </section>
		