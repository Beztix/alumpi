<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
		
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
				
				
				
				<h3>Alle Studentennachweise zurücksetzen</h3>
				<p>
				Diese Funktion, setzt ALLE Einträge von "studentennachweis vorhanden" in der DB wieder auf false. <br>
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
		
				
			</section>
			
			
			
			
			
			
        </section>
		