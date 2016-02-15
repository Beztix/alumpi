				<h2>Anmeldeformular</h2>
		
				<form action="index.php" method="POST" enctype="multipart/form-data">
				
					<table style="width:100%">
						<colgroup>
							<col style="width:30%;">
							<col style="width:70%;">
						</colgroup>
						<tr>
							<td>
								Titel
							</td>
							<td>
								<select name="geschlecht">
									<option value="Herr" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] == "Herr") echo "selected";}?>>Herr</option>
									<option value="Frau" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] == "Frau") echo "selected";}?>>Frau</option>
								</select>
								<select name="titel">
									<option value="" <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "") echo "selected";}?>></option>
									<option value="B.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "B.Sc.") echo "selected";}?>>B.Sc.</option>
									<option value="B.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "B.Ed.") echo "selected";}?>>B.Ed.</option>
									<option value="M.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "M.Sc.") echo "selected";}?>>M.Sc.</option>
									<option value="M.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "M.Ed.") echo "selected";}?>>M.Ed.</option>
									<option value="Dr. rer. nat." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dr. rer. nat.") echo "selected";}?>>Dr. rer. nat.</option>
									<option value="Dr.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dr.-Ing.") echo "selected";}?>>Dr.-Ing.</option>
									<option value="Dr. mult." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dr. mult.") echo "selected";}?>>Dr. mult.</option>
									<option value="Dr. h. c." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dr. h. c.") echo "selected";}?>>Dr. h. c.</option>
									<option value="Dr. habil." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dr. habil.") echo "selected";}?>>Dr. habil.</option>
									<option value="Dipl.-Inf." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dipl.-Inf.") echo "selected";}?>>Dipl.-Inf.</option>
									<option value="Dipl.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dipl.-Ing.") echo "selected";}?>>Dipl.-Ing.</option>
									<option value="Dipl.-Math." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dipl.-Math.") echo "selected";}?>>Dipl.-Math.</option>
									<option value="Dipl.-Phys." <?php if(isset($_POST['titel'])) {if($_POST['titel'] == "Dipl.-Phys.") echo "selected";}?>>Dipl.-Phys.</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Name
							</td>
							<td>
								<input type="text" name="vorname" placeholder="Vorname" size="25" <?php if(isset($_POST['vorname'])) echo "value=\"" . $_POST['vorname'] . "\"";?>>
								<input type="text" name="nachname" placeholder="Nachname" size="25" <?php if(isset($_POST['nachname'])) echo "value=\"" . $_POST['nachname'] . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Kontakt
							</td>
							<td>
								<input type="text" name="email" placeholder="E-Mail-Adresse" size="35" <?php if(isset($_POST['email'])) echo "value=\"" . $_POST['email'] . "\"";?>>
							</td>
						</tr>
					</table>
					<br>
					
					<p>
					Hiermit melde ich mich verbindlich zum Buffet der Absolventenfeier am <?php echo ABSOLVENTENFEIER_DATUM; ?> zum Preis von <?php echo ABSOLVENTENFEIER_PREIS; ?>€ an 
					und bestätige die Korrektheit der oben stehenden Angaben.
					<br>
					</p>
					
					


					<button class="absenden" type="submit">Anmeldung Absenden</button>

				</form>
		