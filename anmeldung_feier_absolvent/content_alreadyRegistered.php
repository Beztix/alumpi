<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<br>
				<p>
				Sie sind bereits für die diesjährige Absolventenfeier als Absolvent angemeldet. <br>
				</p>
				<br>
				
				<h3>Gespeicherte Daten:</h3>
				
				<table style="width:100%">
					<colgroup>
						<col style="width:50%;">
						<col style="width:50%;">
					</colgroup>
					
					
					<tr>
						<td>
							Ihre MID
						</td>
						<td>
							<?php echo $data_output['mid']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Datum der Feier
						</td>
						<td>
							<?php echo $data_output['datum_der_feier']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Anzahl mitgebrachter Gäste
						</td>
						<td>
							<?php echo $data_output['anzahl_gaeste']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Zahlung per Kontoeinzug
						</td>
						<td>
							<?php echo $data_output['will_kontoeinzug']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Beitrag zum Nachspeisenbuffet
						</td>
						<td>
							<?php echo $data_output['mitbringsel']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Thema der Abschlussarbeit
						</td>
						<td>
							<?php echo $data_output['abschlussarbeitsthema']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Lehrstuhl der Abschlussarbeit
						</td>
						<td>
							<?php echo $data_output['lehrstuhl']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Studiengang
						</td>
						<td>
							<?php echo $data_output['studiengang']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Erworbener Titel
						</td>
						<td>
							<?php echo $data_output['titel']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Studienbeginn
						</td>
						<td>
							<?php echo $data_output['studienbeginn']; ?>
						</td>
					</tr>
					<tr>
						<td>
							Studienabschluss
						</td>
						<td>
							<?php echo $data_output['studienabschluss']; ?>
						</td>
					</tr>
				
				</table>
				
				<br>
				
				Ihr bereitsgestelltes Portrait: <br>
				<br>
				
				<img src="xxx" style="width:240px; height:300px;">
				
				<br>
				<br>
				<br>
				
				<h3>Hinweis:</h3>
				<p>
				Aus organisatorischen Gründen (Erstellen der Urkunden, Vorbereitung der Präsentation) ist es nicht möglich, die angegeben Daten selbst auf der Webseite zu ändern.<br>
				Falls die gespeicherten Daten nicht korrekt sind, kontaktieren Sie bitte den Absolventenverein unter alumpi@uni-bayreuth.de.
				</p>
				
			