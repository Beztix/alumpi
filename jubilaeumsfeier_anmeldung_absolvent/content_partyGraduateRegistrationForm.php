<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				<h2>Formular zur Buchung von Festaktkarten (als aktueller Absolvent)</h2>

				<form action="index.php#result" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="is_alumni" value="1" />
					<input type="hidden" name="laufkarte" value="0"/>

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
									<option value="Herr" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] === "Herr") echo "selected";}?>>Herr</option>
									<option value="Frau" <?php if(isset($_POST['geschlecht'])) {if($_POST['geschlecht'] === "Frau") echo "selected";}?>>Frau</option>
								</select>
								<select name="titel">
									<option value="" <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "") echo "selected";}?>></option>
									<option value="B.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "B.Sc.") echo "selected";}?>>B.Sc.</option>
									<option value="B.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "B.Ed.") echo "selected";}?>>B.Ed.</option>
									<option value="M.Sc." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "M.Sc.") echo "selected";}?>>M.Sc.</option>
									<option value="M.Ed." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "M.Ed.") echo "selected";}?>>M.Ed.</option>
									<option value="Dr. rer. nat." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. rer. nat.") echo "selected";}?>>Dr. rer. nat.</option>
									<option value="Dr.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr.-Ing.") echo "selected";}?>>Dr.-Ing.</option>
									<option value="Dr. mult." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. mult.") echo "selected";}?>>Dr. mult.</option>
									<option value="Dr. h. c." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. h. c.") echo "selected";}?>>Dr. h. c.</option>
									<option value="Dr. habil." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dr. habil.") echo "selected";}?>>Dr. habil.</option>
									<option value="Dipl.-Inf." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Inf.") echo "selected";}?>>Dipl.-Inf.</option>
									<option value="Dipl.-Ing." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Ing.") echo "selected";}?>>Dipl.-Ing.</option>
									<option value="Dipl.-Math." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Math.") echo "selected";}?>>Dipl.-Math.</option>
									<option value="Dipl.-Phys." <?php if(isset($_POST['titel'])) {if($_POST['titel'] === "Dipl.-Phys.") echo "selected";}?>>Dipl.-Phys.</option>
								</select>
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
								Kontakt
							</td>
							<td>
								<div style="display:none;" id="email-validation-warning" class="validation-warning">Nach Exmatrikulation wird der Zugang zur Universitäts-Email gesperrt, bitte verwenden Sie wenn mögliche eine langfristig gültige Mail, da dies unsere einzige Möglichkeit ist, Sie zu kontaktieren.</div>
								<input type="text" oninput="showMailWarning()" name="email" id="email" placeholder="E-Mail-Adresse" size="35" <?php if(isset($_POST['email'])) echo "value=\"" . htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Anzahl mitgebrachter Gäste
							</td>
							<td>
								<input type="text" name="anzahl_gaeste" placeholder="" size="3" <?php if(isset($_POST['anzahl_gaeste'])) echo "value=\"" . htmlspecialchars($_POST['anzahl_gaeste'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					<br>
					Hinweis: Kommen Sie alleine, so ist die Anzahl mitgebrachter Gäste 0.
					Falls sich die Gästezahl nachträglich ändert, teilen Sie und das bitte rechtzeitig per E-Mail mit.
					<br>
					<br>

					
					<h3>Urkundenverleihung</h3>
					<p>
					Als aktueller Absolvent wird Ihnen nach der Festrede eine Abschlussurkunde durch den Dekan überreicht. 
					Es wird darauf hingewiesen, dass diese Urkunde kein Hochschulzeugnis ersetzt. <br>
					</p>

					<div id="alumni_data_display">
						<p>
						Folgende Angaben werden zur Erstellung der Urkunde und der Präsentation benötigt:
						</p>
						
						<table style="width:100%">
							<colgroup>
								<col style="width:40%;">
								<col style="width:60%;">
							</colgroup>
							<tr>
								<td>
									Titel der Abschlussarbeit
								</td>
								<td>
									<input type="text" name="abschlussarbeitsthema" placeholder="" size="40" <?php if(isset($_POST['abschlussarbeitsthema'])) echo "value=\"" . htmlspecialchars($_POST['abschlussarbeitsthema'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
							<tr>
								<td>
									An welchem Lehrstuhl haben Sie die Abschlussarbeit geschrieben?
								</td>
								<td>	
									<select name="lehrstuhl" size="1" style="width:450px;">
										<option value="">bitte auswählen</option>
										<optgroup label="Mathematik">
											<?php
											$lehrstuhl_mathe = array(
												"Lehrstuhl Mathematik I - Komplexe Analysis",
												"Lehrstuhl Mathematik II - Computeralgebra",
												"Lehrstuhl Mathematik III - Angewandte und Numerische Analysis",
												"Lehrstuhl Mathematik IV - Zahlentheorie",
												"Lehrstuhl Mathematik V - Angewandte Mathematik",
												"Lehrstuhl Mathematik VI - Nichtlineare Analysis und Mathematische Physik",
												"Lehrstuhl Mathematik VII - Stochastik",
												"Lehrstuhl Mathematik VIII - Algebraische Geometrie",
												"Lehrstuhl Mathematik und ihre Didaktik",
												"Lehrstuhl Wirtschaftsmathematik",
												"Lehrstuhl für Wissenschaftliches Rechnen"
												);
								
											foreach($lehrstuhl_mathe as $val) {
												if(isset($_POST['lehrstuhl']) && $_POST['lehrstuhl'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Physik">
											<?php
											$lehrstuhl_physik = array(
												"Experimentalphysik I - Physik lebender Materie",
												"Experimentalphysik II - Optoelektronik weicher Materie",
												"Experimentalphysik III - Nanooptik",
												"Experimentalphysik IV - Dynamik und Transport in Weicher Materie",
												"Experimentalphysik V",
												"Experimentalphysik VI - Biologische Physik",
												"Experimentalphysik VII ",
												"Experimentalphysik VII - Dynamik und Strukturbildung",
												"Experimentalphysik VIII - Ultraschnelle Dynamik",
												"Experimentalphysik IX - Spektroskopie weicher Materie",
												"Experimentalphysik X - Dynamik weicher Materie",
												"Experimentalphysik XI - Funktionelle Nanostrukturen",
												"Bayreuther Institut für Makromolekülforschung - Konfokale Mikroskopie und konfokale Mikro-Spektroskopie",
												"Theoretische Physik I - Theorie Weicher Materie und Nichtlineare Dynamik",
												"Theoretische Physik II",
												"Theoretische Physik III - Quantentheorie der kondensierten Materie",
												"Theoretische Physik IV - Elektronische Struktur und Dynamik",
												"Theoretische Physik V - Theoretische Plasmaphysik",
												"Theoretische Physik VI - Simulation und Modellierung von Biofluiden",
												"ENB Internationale Nachwuchsgruppe (Dr. Linn Leppert) - Elektronische Anregungen in lichtumwandelnden Systemen",
												"Lehrstuhl  für Kristallographie",
												"Materialphysik und Technologie bei extremen Bedingungen",
												"Didaktik der Physik"
												);
								
											foreach($lehrstuhl_physik as $val) {
												if(isset($_POST['lehrstuhl']) && $_POST['lehrstuhl'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Informatik">
											<?php
											$lehrstuhl_info = array(
												"Angewandte Informatik I - Software-Technik",
												"Angewandte Informatik II - Parallele und verteilte Systeme",
												"Angewandte Informatik III - Robotik und Eingebettete Systeme",
												"Angewandte Informatik IV - Datenbanken und Informationssysteme",
												"Angewandte Informatik V - Datenbanken und Informationssysteme",
												"Angewandte Informatik VI - Algorithmen und Datenstrukturen",
												"Angewandte Informatik VII - Theoretische Informatik",
												"Angewandte Informatik VIII - Serious Games)",
												"Betriebswirtschaftslehre VII – Wirtschaftsinformatik",
												"Bioinformatik/Strukturbiologie"
												);
								
											foreach($lehrstuhl_info as $val) {
												if(isset($_POST['lehrstuhl']) && $_POST['lehrstuhl'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>Studiengang:</td>
								<td>
									<select name="studiengang" size="1" style="width:450px;">
										<option value="">bitte auswählen</option>
										
										<optgroup label="Promotion">
											<?php
											$studiengang_promotion = array(
												"Promotion, Informatik",
												"Promotion, Mathematik",
												"Promotion, Physik"
												);
								
											foreach($studiengang_promotion as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Diplom">
											<?php
											$studiengang_diplom = array(
												"Diplom, Mathematik",
												"Diplom, Technomathematik",
												"Diplom, Wirtschaftsmathematik",
												"Diplom, Physik",
												"Diplom, technische Physik"
												);
								
											foreach($studiengang_diplom as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Bachelor of Science (kein Lehramt)">
											<?php
											$studiengang_bsc = array(
												"Bachelor of Science, Mathematik",
												"Bachelor of Science, Technomathematik",
												"Bachelor of Science, Wirtschaftsmathematik",
												"Bachelor of Science, Physik",
												"Bachelor of Science, Informatik",
												"Bachelor of Science, Angewandte Informatik"
												);
								
											foreach($studiengang_bsc as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Master of Science (kein Lehramt)">
											<?php
											$studiengang_msc = array(
												"Master of Science, Mathematik",
												"Master of Science, Technomathematik",
												"Master of Science, Wirtschaftsmathematik",
												"Master of Science, Physik",
												"Master of Science, Computer Science",
												"Master of Science, Angewandte Informatik"
												);
								
											foreach($studiengang_msc as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Abschlüsse für Lehramt an Berufsschulen">
											<?php
											$studiengang_berufsschule = array(
												"Bachelor of Education für Berufliche Bildung, Fachrichtung Metalltechnik",
												"Bachelor of Science für Berufliche Bildung, Fachrichtung Metalltechnik",
												"Master of Education in Science für Berufliche Bildung, Fachrichtung Metalltechnik",
												"1. Staatsexamen für Berufliche Bildung, Fachrichtung Metalltechnik"
												);
								
											foreach($studiengang_berufsschule as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="1. Staatsexamen für Lehramt an Realschulen">
											<?php
											$studiengang_stax_real = array(
												"1. Staatsexamen für Lehramt Informatik/Englisch an Realschulen",
												"1. Staatsexamen für Lehramt Informatik/Mathematik an Realschulen",
												"1. Staatsexamen für Lehramt Informatik/Physik an Realschulen",
												"1. Staatsexamen für Lehramt Informatik/Wirtschaftswissenschaften an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Chemie an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Deutsch an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Englisch an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Physik an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Sport an Realschulen",
												"1. Staatsexamen für Lehramt Mathematik/Wirtschaftswissenschaften an Realschulen"
												);
								
											foreach($studiengang_stax_real as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="1. Staatsexamen für Lehramt an Gymnasien">
											<?php
											$studiengang_stax_gym = array(
												"1. Staatsexamen für Lehramt an Gymnasien, Informatik/Englisch",
												"1. Staatsexamen für Lehramt an Gymnasien, Informatik/Mathematik",
												"1. Staatsexamen für Lehramt an Gymnasien, Informatik/Physik",
												"1. Staatsexamen für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Chemie",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Deutsch",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Englisch",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Physik",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Sport",
												"1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften",
												"1. Staatsexamen für Lehramt an Gymnasien, Physik/Geographie"
												);
								
											foreach($studiengang_stax_gym as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Master of Education in Science für Lehramt an Gymnasien">
											<?php
											$studiengang_med_gym = array(
												"Master of Education in Science für Lehramt an Gymnasien, Informatik/Englisch",
												"Master of Education in Science für Lehramt an Gymnasien, Informatik/Mathematik",
												"Master of Education in Science für Lehramt an Gymnasien, Informatik/Physik",
												"Master of Education in Science für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Chemie",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Deutsch",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Englisch",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Physik",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Sport",
												"Master of Education in Science für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften",
												"Master of Education in Science für Lehramt an Gymnasien, Physik/Geographie"
												);
								
											foreach($studiengang_med_gym as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Bachelor of Science für Lehramt an Gymnasien">
											<?php
											$studiengang_bsc_gym = array(
												"Bachelor of Science für Lehramt an Gymnasien, Informatik/Englisch",
												"Bachelor of Science für Lehramt an Gymnasien, Informatik/Mathematik",
												"Bachelor of Science für Lehramt an Gymnasien, Informatik/Physik",
												"Bachelor of Science für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Chemie",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Deutsch",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Englisch",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Physik",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Sport",
												"Bachelor of Science für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften",
												"Bachelor of Science für Lehramt an Gymnasien, Physik/Geographie"
												);
								
											foreach($studiengang_bsc_gym as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
										<optgroup label="Bachelor of Education für Lehramt an Gymnasien">
											<?php
											$studiengang_bed_gym = array(
												"Bachelor of Education für Lehramt an Gymnasien, Informatik/Englisch",
												"Bachelor of Education für Lehramt an Gymnasien, Informatik/Mathematik",
												"Bachelor of Education für Lehramt an Gymnasien, Informatik/Physik",
												"Bachelor of Education für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Chemie",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Deutsch",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Englisch",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Physik",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Sport",
												"Bachelor of Education für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften",
												"Bachelor of Education für Lehramt an Gymnasien, Physik/Geographie"
												);
								
											foreach($studiengang_bed_gym as $val) {
												if(isset($_POST['studiengang']) && $_POST['studiengang'] == $val) {
													echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
												}
												else {
													echo '<option value="' . $val . '">' . $val . '</option>\n';
												}
											}
											?>
										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>Erworbener Titel:</td>
								<td>
									<select name="neuer_titel" size="1" style="width:180px;">
										<option value="">bitte auswählen</option>
										<?php
										$neuer_titel = array(
											"-",
											"B.Sc.",
											"B.Ed.",
											"M.Sc.",
											"M.Ed.",
											"Dr. rer. nat.",
											"Dr.-Ing.",
											"Dr. mult.",
											"Dr. h. c.",
											"Dr. habil.",
											"Dipl.-Inf.",
											"Dipl.-Ing.",
											"Dipl.-Math.",
											"Dipl.-Phys."
											);
							
										foreach($neuer_titel as $val) {
											if(isset($_POST['neuer_titel']) && $_POST['neuer_titel'] == $val) {
												echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
											}
											else {
												echo '<option value="' . $val . '">' . $val . '</option>\n';
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Beginn dieses Studiengangs</td>
								<td>
									<select name="studienbeginn" size="1" style="width:180px;">
										<option value="">bitte auswählen</option>
										<?php
										$studienbeginn = array(
											"2016, WS",
											"2016, SS",
											"2015, WS",
											"2015, SS",
											"2014, WS",
											"2014, SS",
											"2013, WS",
											"2013, SS",
											"2012, WS",
											"2012, SS",
											"2011, WS",						
											"2011, SS",
											"2010, WS",
											"2010, SS",
											"2009, WS",							
											"2009, SS",
											"2008, WS",
											"2008, SS",
											"2007, WS",
											"2007, SS",
											"2006, WS",
											"2006, SS",
											"2005, WS"
											);
							
										foreach($studienbeginn as $val) {
											if(isset($_POST['studienbeginn']) && $_POST['studienbeginn'] == $val) {
												echo '<option value="' . $val . '" selected>' . $val . '</option>\n';
											}
											else {
												echo '<option value="' . $val . '">' . $val . '</option>\n';
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Abschlussdatum
								</td>
								<td>
									<input type="text" name="studienabschluss" placeholder="TT.MM.JJJJ" size="10"  <?php if(isset($_POST['studienabschluss'])) echo "value=\"" . htmlspecialchars($_POST['studienabschluss'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
						</table>

						<br>
						<br>
						<h3>Präsentation mit Foto</h3>
						<p>
						Während der Übergabe der Abschlussurkunden wird eine Präsentation gezeigt, in der die Absolventen mit Informationen zu ihrem Abschluss zu sehen sind.<br>
						Für die Präsentation ist auch ein Portraitfoto von Ihnen vorgesehen, das Sie bitte bis spätestens eine Woche vor der Feier per E-Mail an <a href="mailto:alumpi@uni-bayreuth.de">alumpi@uni-bayreuth.de</a> schicken.
						Spätere Einsendungen können nicht mehr berücksichtigt werden, da die Präsentation rechtzeitig erstellt werden muss.<br>
						<br>
						
						Anforderungen an das Bild:
						<ul>
							<li>Seitenformat möglichst 4:3 (Höhe:Breite)</li>
							<li>Auflösung bitte mindestens 400x300 Pixel</li>
							<li>Dateityp: möglichst .jpg oder .png</li>
						</ul>
						</p>
					</div>
					
					<br>
					<h3>Zahlung</h3>

					<p>
					Bitte überweisen Sie den Betrag von <?php echo ABSOLVENTENFEIER_PREIS; ?> € pro Person bis spätestens 14 Tage nach Anmeldung auf das Konto des Absolventenvereins.<br>
					<br>
					<u>Kontodaten:</u><br>
					Absolventen- und Förderverein MPI Uni Bayreuth e.V.<br>
					IBAN: DE05 7735 0110 0038 0189 41<br>
					BIC: BYLADEM1SBT<br>
					Verwendungszweck: [Nachname],[Vorname]<br>
					
					<br>
					<br>
					Die entsprechenden Angaben finden Sie auch in der Bestätigungsmail zur Anmeldung.
					</p>
					
					
					<br>
					<br>
					<h3>Fragen und Anmerkungen</h3>

					<p>
					Fehlt Ihr Studiengang/Abschluss in der Auswahlliste? 
					Haben Sie weitere Fragen zum Ablauf der Feier oder möchten Sie im Orga-Team der Feier mithelfen? <br>
					Bei Fragen, Anmerkungen und Anregungen können Sie uns jederzeit über <a href="mailto:alumpi@uni-bayreuth.de">alumpi@uni-bayreuth.de</a> kontaktieren. 
					</p>

					
					<br>
					<br>
					<h2>Anmeldung zum Absolventenverein</h2>
					
					<p>
					Wir würden uns sehr freuen, wenn Sie sich zusätzlich zur Anmeldung zur Absolventenfeier als Mitglied zum Absolventenverein anmelden würden.	
					<br>
					</p>

					<h3>Vorteile der Vereinsmitgliedschaft</h3>
					<p>
					Mit dem Beitritt zum Absolventen- und Förderverein MPI Uni Bayreuth e.V. bleiben Sie der Fakultät, an der Sie Ihre Ausbildung 
					erhalten und einige wichtige Jahre Ihres Lebens verbracht haben, ein Stück weit verbunden.
					Sie haben damit die Möglichkeit, in regelmäßigen Abständen Informationen über Neuigkeiten an der Universität, 
					die Absolventen der Fakultät 1 betreffen, sowie über die Aktivitäten des Absolventenvereins selbst zu erhalten. 
					Der Verein möchte dabei als Bindeglied zwischen den Absolventen und ihrer alten Hochschule fungieren, dazu veranstalten 
					wir unter anderem Ehemaligentreffen, Absolventenforen oder Absolventenvorträge, bei denen die Absolventen untereinander 
					in Kontakt bleiben oder auch den aktuellen Studenten ihre Erfahrungen weitergeben können.<br>

					Als Vereinsmitglied haben Sie zudem die Möglichkeit, das Angebot des Hochschulsports als externer Teilnehmer nutzen.<br>

					Der geringe Jahresbeitrag von lediglich 10 Euro kommt direkt dem gemeinnützigen Vereinszweck laut <a href="../_pdfs/Satzung.pdf">Satzung</a> 
					zugute, d.h. vor allem den Ihnen nachfolgenden Studenten der Fakultät 1 durch eine stetig wachsende Vereinsarbeit, so dass Sie 
					damit ein wenig an den Ort Ihrer Ausbildung zurückgeben können. Für die Studenten organisieren wir unter anderem Exkursionen, 
					Workshops und Vorträge, um über die berufliche Zukunft zu informieren und Kontakt zu möglichen Arbeitgebern herzustellen. <br>

					Für unsere Neumitglieder wird der Beitrag im ersten Jahr nicht erhoben und ist erst im kommenden Frühjahr fällig. Zusätzlich können sich 
					eingeschriebene Studenten der Universität Bayreuth vom Mitgliedsbeitrag befreien lassen.<br>
					</p>
					
					<p>
					<input id="mitgliedsantragCheckbox" type="checkbox" name="mitgliedsantrag" onclick="toggleMitgliedsantragDisplay()" checked>
					Ja, ich möchte mich gemeinsam mit dieser Anmeldung zur Absolventenfeier als Mitglied zum Absolventenverein anmelden. 
					</p>
					
					<div id="mitgliedsantragDisplay">
					
						<h3>Zusätzliche Daten</h3>
						<p>
						Die folgenden Informationen werden zusätzlich zu den bereits oben genannten Daten benötigt, um gemeinsam mit der Anmeldung zur Absolventenfeier auch eine Anmeldung zum Absolventenverein vorzunehmen.
						<br>
						</p>
						
						<table style="width:100%">
							<colgroup>
								<col style="width:30%;">
								<col style="width:70%;">
							</colgroup>
							<tr>
								<td>
									Geburtsdatum
								</td>
								<td>
									<input type="text" name="geburtstag" placeholder="TT.MM.JJJJ" size="10" <?php if(isset($_POST['geburtstag'])) echo "value=\"" . htmlspecialchars($_POST['geburtstag'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
							<tr>
								<td>
									Kontakt
								</td>
								<td>
									<input type="text" name="telefon" placeholder="Telefonnummer (optional)" size="25" <?php if(isset($_POST['telefon'])) echo "value=\"" . htmlspecialchars($_POST['telefon'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
						</table>
						
						<p>
						Ich werde hiermit Mitglied und ermächtige hiermit den Absolventen- und Förderverein MPI Uni Bayreuth e.V. jederzeit widerruflich, den
						Mitgliedsbeitrag in Höhe von 10 Euro / Jahr von unten angegebenem Konto abzubuchen.
						Dies beinhaltet, dass ich die Satzung und Beitragsordnung in der derzeit gültigen Form anerkenne. <br>
						Ich bin außerdem damit einverstanden, dass meine Daten an die Universität Bayreuth zum Zwecke der Ehemaligenbetreuung weiter gegeben werden dürfen.<br>
						<br>
						</p>
						
						<table style="width:100%">
							<colgroup>
								<col style="width:30%;">
								<col style="width:70%;">
							</colgroup>
							<tr>
								<td>
									Kontoinhaber
								</td>
								<td>
									<input type="text" name="kontoinhaber" placeholder="Vorname Nachname" size="40" <?php if(isset($_POST['kontoinhaber'])) echo "value=\"" . htmlspecialchars($_POST['kontoinhaber'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
							<tr>
								<td>
									Kontodaten
								</td>
								<td>
									<input type="text" name="iban" placeholder="IBAN" size="34" <?php if(isset($_POST['iban'])) echo "value=\"" . htmlspecialchars($_POST['iban'], ENT_QUOTES, 'UTF-8') . "\"";?>>
									<input type="text" name="bic" placeholder="BIC" size="15" <?php if(isset($_POST['bic'])) echo "value=\"" . htmlspecialchars($_POST['bic'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
						</table>
						
						<p>
						Hinweis:
						Die Kontodaten werden zur Buchung der Mitgliedsbeiträge verwendet, bitte überweisen Sie den Beitrag zur Absolventenfeier unabhängig davon selbst.
						</p>
						
						
						
						<p>
						<input type="checkbox" name="newsletter" checked>
						Ich möchte den regelmäßigen Absolventen-Newsletter der Universität Bayreuth beziehen. 
						Der Newsletter wird per Post versendet, falls er gewünscht wird, müssen Angaben zur Anschrift erfolgen.
						</p>

						<table style="width:100%">
							<colgroup>
								<col style="width:30%;">
								<col style="width:70%;">
							</colgroup>
							<tr>
								<td>
									Straße, Hausnummer
								</td>
								<td>
									<input type="text" name="strasse" placeholder="Straße Hausnummer" size="30" <?php if(isset($_POST['strasse'])) echo "value=\"" . htmlspecialchars($_POST['strasse'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
							<tr>
								<td>
									Postleitzahl, Ort
								</td>
								<td>
									<input type="text" name="plz" placeholder="PLZ" size="10" <?php if(isset($_POST['plz'])) echo "value=\"" . htmlspecialchars($_POST['plz'], ENT_QUOTES, 'UTF-8') . "\"";?>>
									<input type="text" name="ort" placeholder="Ort" size="25" <?php if(isset($_POST['ort'])) echo "value=\"" . htmlspecialchars($_POST['ort'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
							<tr>
								<td>
									Land
								</td>
								<td>
									<input type="text" name="land" placeholder="Land" size="25" <?php if(isset($_POST['land'])) echo "value=\"" . htmlspecialchars($_POST['land'], ENT_QUOTES, 'UTF-8') . "\"";?>>
								</td>
							</tr>
						</table>
						
					</div>
					
					
					
					<div id="datenspeicherungDisplay" style="display:none">
						
						<br>
						<h2>Verwendung der Kontaktdaten</h2>
						<p>
						Unabhängig von der Anmeldung als Vereinsmitglied können Sie unsere Vereinsarbeit unterstützen, indem Sie uns erlauben Ihre E-Mail-Adresse zu speichern.
						Wir verwenden diese, um Sie im Sinne unserer Vereinsarbeit (d.h. beispielsweise über das nächste Homecoming-Event) zu informieren.
						Diese Adressliste wird von uns nicht weitergegeben und Sie erhalten maximal einige wenige Mails pro Jahr von uns.
						<br>
						</p>
						
						<p>
						<input id="datenspeicherungCheckbox" type="checkbox" name="datenspeicherung" checked>
						Ja, ich gestatte dem Absolventen- und Förderverein MPI Uni Bayreuth e.V. die Speicherung und Nutzung meiner Kontaktdaten im Sinne der Vereinsarbeit. 
						</p>
					
					
					</div>

					<br>
					<button class="absenden" type="submit">Anmeldung Absenden</button>

				</form>
		