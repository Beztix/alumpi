		<section id="content">
		
		
			<?php 
			//Einbinden von auth.php, um diese Seite nur eingeloggten Mitgliedern zur Verfügung zu stellen
			require '../_includes_functionality/auth.php'; echo "\n"; 
			?>
		
		
			<section class="top_image">
				<img src="../_images_content/campus_scene_fahrrad.jpg" alt="Campus Scene Fahrrad">
			</section>
		
		
			<?php
			//Einbinden der PHP-Datei um die Mitgliedsdaten abzurufen
			include '../_includes_functionality/get_memberdata_from_db.php'; 
			?>		
		
		
            <section class="text">

				<h1>Datenabfrage</h1>
				
				
				<form action="index.php" method="POST" name="datenabfrage">
				
				
					<table style="width:100%">
						
						<colgroup>
							<col style="width:26%;">
							<col style="width:37%;">
							<col style="width:37%;">
						</colgroup>
						
						<tr>
							<th>
								
							</th>
							<th>
								Aktueller Eintrag
							</th>
							<th>
								Änderung
							</th>
						</tr>
						
						<tr>
							<td>
								Mitglieds-ID
							</td>
							<td>
								<?php echo $mid; ?>
							</td>
							<td>
								
							</td>
						</tr>
						
						<tr>
							<td>
								Titel
							</td>
							<td>
								<?php echo $titel; ?>
							</td>
							<td>
								<select name="titel">
									<option value=""></option>
									<option value="B.Sc.">B.Sc.</option>
									<option value="M.Sc.">M.Sc.</option>
									<option value="M.Ed.">M.Ed.</option>
									<option value="Dr. rer. nat.">Dr. rer. nat.</option>
									<option value="Dr.-Ing.">Dr.-Ing.</option>
									<option value="Dr. mult.">Dr. mult.</option>
									<option value="Dr. h. c.">Dr. h. c.</option>
									<option value="Dr. habil.">Dr. habil.</option>
									<option value="Dipl.-Inf.">Dipl.-Inf.</option>
									<option value="Dipl.-Ing.">Dipl.-Ing.</option>
									<option value="Dipl.-Math.">Dipl.-Math.</option>
									<option value="Dipl.-Phys.">Dipl.-Phys.</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>
								Vorname
							</td>
							<td>
								<?php echo $vorname; ?>
							</td>
							<td>
								<input type="text" name="vorname" placeholder="Vorname" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Nachname
							</td>
							<td>
								<?php echo $nachname; ?>
							</td>
							<td>
								<input type="text" name="nachname" placeholder="Nachname" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Email-Adresse
							</td>
							<td>
								<?php echo $email; ?>
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35">
							</td>
						</tr>
						
						<tr>
							<td>
								Telefonnummer
							</td>
							<td>
								<?php echo $telefon; ?>
							</td>
							<td>
								<input type="text" name="telefon" placeholder="Telefonnummer (optional)" size="25">
							</td>
						</tr>
						
						<tr>
							<td>
								Straße, Hausnummer
							</td>
							<td>
								<?php echo $strasse; ?>
							</td>
							<td>
								<input type="text" name="strasse" placeholder="Straße Hausnummer" size="30">		
							</td>
						</tr>
						
						<tr>
							<td>
								PLZ
							</td>
							<td>
								<?php echo $plz; ?>
							</td>
							<td>
								<input type="text" name="plz" placeholder="PLZ" size="10">
							</td>
						</tr>
						
						<tr>
							<td>
								Ort
							</td>
							<td>
								<?php echo $ort; ?>
							</td>
							<td>
								<input type="text" name="ort" placeholder="Ort" size="25">
							</td>
						</tr>
												
						<tr>
							<td>
								Kontoinhaber
							</td>
							<td>
								<?php echo $kontoinhaber; ?>
							</td>
							<td>
								<input type="text" name="kontoinhaber" placeholder="Vorname Nachname" size="40">
							</td>
						</tr>
												
						<tr>
							<td>
								IBAN
							</td>
							<td>
								<?php echo $konto; ?>
							</td>
							<td>
								<input type="text" name="iban" placeholder="IBAN" size="34">
							</td>
						</tr>
												
						<tr>
							<td>
								BIC
							</td>
							<td>
								<?php echo $blz; ?>
							</td>
							<td>
								<input type="text" name="bic" placeholder="BIC" size="15">
							</td>
						</tr>
												
						<tr>
							<td>
								Passwort
							</td>
							<td>
								
							</td>
							<td>
								<input type="text" name="passwort" placeholder="Passwort" size="25">
							</td>
						</tr>
												
						<tr>
							<td>
							
							</td>
							<td>
								
							</td>
							<td>
								<input type="text" name="passwort" placeholder="Passwort wiederholen" size="25">
							</td>
						</tr>
						
					</table>
				
				
				
				</form>
		
				
			</section>
			
			
			
			
			
			
        </section>
		