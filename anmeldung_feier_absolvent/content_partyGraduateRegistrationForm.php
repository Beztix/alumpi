<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>


				<br>
				<p>
				Sie sind bisher <strong>nicht</strong> für die diesjährige Absolventenfeier als Absolvent angemeldet. <br>
				</p>
				<br>
				
				<h2>Anmeldeformular</h2>
				
				


				<form action="index.php" method="POST" enctype="multipart/form-data">
				
					<p>
					Möchten Sie sich zur diesjährigen Absolventenfeier am <?php echo ABSOLVENTENFEIER_DATUM; ?> <strong>als aktueller Absolvent</strong> anmelden, 
					so füllen Sie bitte dieses Formular aus.<br>
					Falls Sie als Gast und nicht als aktueller Absolvent an der diesjährigen Absolventenfeier teilnehmen möchten, 
					so melden Sie sich bitte nicht über dieses Formular an, siehe <a href="../anmeldung_absolventenfeier/index.php#gast">Anmeldung zur Absolventenfeier als Gast</a>.
					<br>
					Bitte überprüfen Sie vor der Anmeldung zur Feier mit diesem Formular ihre Mitgliedsdaten auf der Seie <a href="../datenabfrage/index.php">Datenabfrage</a> auf Korrektheit,
					da diese Daten für die Anmeldung verwendet werden.
					</p>

					<table style="width:100%">
						<colgroup>
							<col style="width:65%;">
							<col style="width:35%;">
						</colgroup>
						<tr>
							<td>
								Anzahl Gäste, die ich zur Feier mitbringe und hiermit mit anmelden möchte <br>
								(kommen Sie alleine, so sind dies 0)
							</td>
							<td>
								<input type="text" name="anzahl_gaeste" placeholder="" size="3" <?php if(isset($_POST['anzahl_gaeste'])) echo "value=\"" . htmlspecialchars($_POST['anzahl_gaeste'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
						<tr>
							<td>
								Mein Beitrag zum Nachspeisenbuffet <br>
								(leer, falls keine Nachspeise mitgebracht werden kann)
							</td>
							<td>
								<input type="text" name="mitbringsel" placeholder="" size="40" <?php if(isset($_POST['mitbringsel'])) echo "value=\"" . htmlspecialchars($_POST['mitbringsel'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>
					
					<br>
					<br>
					<h3>Urkundenverleihung</h3>
					<p>
					Als aktueller Absolvent wird Ihnen nach der Festrede eine Abschlussurkunde durch den Dekan überreicht. 
					Es wird darauf hingewiesen, dass diese Urkunde kein Hochschulzeugnis ersetzt. <br>
					<br>
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
									<option value="" selected="selected">bitte auswählen</option>
									<optgroup label="Mathematik">
										<option value="Mathematik I - Komplexe Analysis">Mathematik I - Komplexe Analysis</option>
										<option value="Mathematik II - Computeralgebra">Mathematik II - Computeralgebra</option>
										<option value="Mathematik III - Angewandte und Numerische Analysis">Mathematik III - Angewandte und Numerische Analysis</option>
										<option value="Mathematik IV - Zahlentheorie">Mathematik IV - Zahlentheorie</option>
										<option value="Mathematik V - Angewandte Mathematik">Mathematik V - Angewandte Mathematik</option>
										<option value="Mathematik VI - Nichtlineare Analysis und Mathematische Physik">Mathematik VI - Nichtlineare Analysis und Mathematische Physik</option>
										<option value="Mathematik VII - Stochastik">Mathematik VII - Stochastik</option>
										<option value="Mathematik VIII - Algebraische Geometrie">Mathematik VIII - Algebraische Geometrie</option>
										<option value="Ingenieurmathematik">Ingenieurmathematik</option>
										<option value="Wirtschaftsmathematik">Wirtschaftsmathematik</option>
										<option value="Mathematik und ihre Didaktik">Mathematik und ihre Didaktik</option>
									</optgroup>
									<optgroup label="Physik">
										<option value="Experimentalphysik I">Experimentalphysik I</option>
										<option value="Experimentalphysik II">Experimentalphysik II</option>
										<option value="Experimentalphysik III">Experimentalphysik III</option>
										<option value="Experimentalphysik IV">Experimentalphysik IV</option>
										<option value="Experimentalphysik V">Experimentalphysik V</option>
										<option value="Theoretische Physik I">Theoretische Physik I</option>
										<option value="Theoretische Physik II">Theoretische Physik II</option>
										<option value="Theoretische Physik III">Theoretische Physik III</option>
										<option value="Theoretische Physik IV">Theoretische Physik IV</option>
										<option value="Theoretische Physik V">Theoretische Physik V</option>
										<option value="Didaktik der Physik">Didaktik der Physik</option>
										<option value="Kristallographie">Kristallographie</option>
										<option value="Bayreuther Institut für Makromolekülforschung">Bayreuther Institut für Makromolekülforschung</option>
									</optgroup>
									<optgroup label="Informatik">
										<option value="Angewandte Informatik I - Softwaretechnik">Angewandte Informatik I - Softwaretechnik</option>
										<option value="Angewandte Informatik II - Parallele und verteilte Systeme">Angewandte Informatik II - Parallele und verteilte Systeme</option>
										<option value="Angewandte Informatik III - Robotik und Eingebettete Systeme">Angewandte Informatik III - Robotik und Eingebettete Systeme</option>
										<option value="Angewandte Informatik IV - Datenbanken und Informationssysteme">Angewandte Informatik IV - Datenbanken und Informationssysteme</option>
										<option value="Angewandte Informatik V - Graphische Datenverarbeitung">Angewandte Informatik V - Graphische Datenverarbeitung</option>
										<option value="Angewandte Informatik VI - Algorithmen und Datenstrukturen">Angewandte Informatik VI - Algorithmen und Datenstrukturen</option>
										<option value="Angewandte Informatik VII - Theoretische Informatik">Angewandte Informatik VII - Theoretische Informatik</option>
										<option value="Wirtschaftsinformatik">Wirtschaftsinformatik</option>
										<option value="Bioinformatik">Bioinformatik</option>
									</optgroup>
								</select>
							</td>
						</tr>
						<tr>
							<td>Studiengang:</td>
							<td>
								<select name="studiengang" size="1" style="width:450px;">
									<option value="" selected="selected">bitte auswählen</option>
									
									<optgroup label="Promotion">
										<option value="Promotion, Informatik"> - Informatik</option>
										<option value="Promotion, Mathematik"> - Mathematik</option>
										<option value="Promotion, Physik"> - Physik</option>
									</optgroup>
									<optgroup label="Diplom">
										<option value="Diplom, Mathematik"> - Mathematik</option>
										<option value="Diplom, Technomathematik"> - Technomathematik</option>
										<option value="Diplom, Wirtschaftsmathematik"> - Wirtschaftsmathematik</option>
										<option value="Diplom, Physik"> - Physik</option>
										<option value="Diplom, technische Physik"> - Technische Physik</option>
									</optgroup>
									<optgroup label="Bachelor of Science (kein Lehramt)">
										<option value="Bachelor of Science, Mathematik"> - Mathematik</option>
										<option value="Bachelor of Science, Technomathematik"> - Technomathematik</option>
										<option value="Bachelor of Science, Wirtschaftsmathematik"> - Wirtschaftsmathematik</option>
										<option value="Bachelor of Science, Physik"> - Physik</option>
										<option value="Bachelor of Science, Informatik"> - Informatik</option>
										<option value="Bachelor of Science, Angewandte Informatik"> - Angewandte Informatik</option>
									</optgroup>
									<optgroup label="Master of Science (kein Lehramt)">
										<option value="Master of Science, Mathematik"> - Mathematik</option>
										<option value="Master of Science, Technomathematik"> - Technomathematik</option>
										<option value="Master of Science, Wirtschaftsmathematik"> - Wirtschaftsmathematik</option>
										<option value="Master of Science, Physik"> - Physik</option>
										<option value="Master of Science, Computer Science"> - Computer Science</option>
										<option value="Master of Science, Angewandte Informatik"> - Angewandte Informatik</option>
									</optgroup>
									<optgroup label="Abschlüsse für Lehramt an Berufsschulen">
										<option value="Bachelor of Education für Berufliche Bildung, Fachrichtung Metalltechnik"> - Bachelor of Education in Metalltechnik</option>
										<option value="Bachelor of Science für Berufliche Bildung, Fachrichtung Metalltechnik"> - Bachelor of Science in Metalltechnik</option>
										<option value="Master of Education in Science für Berufliche Bildung, Fachrichtung Metalltechnik"> - Master of Education in Science, Metalltechnik</option>
										<option value="1. Staatsexamen für Berufliche Bildung, Fachrichtung Metalltechnik"> - 1. Staatsexamen in Metalltechnik</option>
									</optgroup>
									<optgroup label="1. Staatsexamen für Lehramt an Realschulen">
										<option value="1. Staatsexamen für Lehramt Informatik/Englisch an Realschulen"> - Informatik/Englisch</option>
										<option value="1. Staatsexamen für Lehramt Informatik/Mathematik an Realschulen"> - Informatik/Mathematik</option>
										<option value="1. Staatsexamen für Lehramt Informatik/Physik an Realschulen"> - Informatik/Physik</option>
										<option value="1. Staatsexamen für Lehramt Informatik/Wirtschaftswissenschaften an Realschulen"> - Informatik/Wirtschaftswissenschaften</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Chemie an Realschulen"> - Mathematik/Chemie</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Deutsch an Realschulen"> - Mathematik/Deutsch</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Englisch an Realschulen"> - Mathematik/Englisch</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Physik an Realschulen"> - Mathematik/Physik</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Sport an Realschulen"> - Mathematik/Sport</option>
										<option value="1. Staatsexamen für Lehramt Mathematik/Wirtschaftswissenschaften an Realschulen">  - Mathematik/Wirtschaftswissenschaften</option>
									</optgroup>
									<optgroup label="1. Staatsexamen für Lehramt an Gymnasien">
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Informatik/Englisch "> - Informatik/Englisch</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Informatik/Mathematik"> - Informatik/Mathematik</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Informatik/Physik"> - Informatik/Physik</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften"> - Informatik/Wirtschaftswissenschaften</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Chemie"> - Mathematik/Chemie</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Deutsch"> - Mathematik/Deutsch</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Englisch"> - Mathematik/Englisch</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Physik"> - Mathematik/Physik</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Sport"> - Mathematik/Sport</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften"> - Mathematik/Wirtschaftswissenschaften</option>
										<option value="1. Staatsexamen für Lehramt an Gymnasien, Physik/Geographie"> - Physik/Geographie</option>
									</optgroup>
									<optgroup label="Master of Education in Science für Lehramt an Gymnasien">
										<option value="Master of Education in Science für Lehramt an Gymnasien, Informatik/Englisch "> - Informatik/Englisch</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Informatik/Mathematik"> - Informatik/Mathematik</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Informatik/Physik"> - Informatik/Physik</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften"> - Informatik/Wirtschaftswissenschaften</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Chemie"> - Mathematik/Chemie</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Deutsch"> - Mathematik/Deutsch</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Englisch"> - Mathematik/Englisch</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Physik"> - Mathematik/Physik</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Sport"> - Mathematik/Sport</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften"> - Mathematik/Wirtschaftswissenschaften</option>
										<option value="Master of Education in Science für Lehramt an Gymnasien, Physik/Geographie"> - Physik/Geographie</option>
									</optgroup>
									<optgroup label="Bachelor of Science für Lehramt an Gymnasien">
										<option value="Bachelor of Science für Lehramt an Gymnasien, Informatik/Englisch "> - Informatik/Englisch</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Informatik/Mathematik"> - Informatik/Mathematik</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Informatik/Physik"> - Informatik/Physik</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften"> - Informatik/Wirtschaftswissenschaften</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Chemie"> - Mathematik/Chemie</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Deutsch"> - Mathematik/Deutsch</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Englisch"> - Mathematik/Englisch</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Physik"> - Mathematik/Physik</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Sport"> - Mathematik/Sport</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften"> - Mathematik/Wirtschaftswissenschaften</option>
										<option value="Bachelor of Science für Lehramt an Gymnasien, Physik/Geographie"> - Physik/Geographie</option>
									</optgroup>
									<optgroup label="Bachelor of Education für Lehramt an Gymnasien">
										<option value="Bachelor of Education für Lehramt an Gymnasien, Informatik/Englisch "> - Informatik/Englisch</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Informatik/Mathematik"> - Informatik/Mathematik</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Informatik/Physik"> - Informatik/Physik</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Informatik/Wirtschaftswissenschaften"> - Informatik/Wirtschaftswissenschaften</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Chemie"> - Mathematik/Chemie</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Deutsch"> - Mathematik/Deutsch</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Englisch"> - Mathematik/Englisch</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Physik"> - Mathematik/Physik</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Sport"> - Mathematik/Sport</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Mathematik/Wirtschaftswissenschaften"> - Mathematik/Wirtschaftswissenschaften</option>
										<option value="Bachelor of Education für Lehramt an Gymnasien, Physik/Geographie"> - Physik/Geographie</option>
									</optgroup>
								</select>
							</td>
						</tr>
						<tr>
							<td>Erworbener Titel:</td>
							<td>
								<select name="neuer_titel" size="1" style="width:180px;">
									<option value="">bitte auswählen</option>
									<option value="B.Sc.">B.Sc.</option>
									<option value="B.Ed.">B.Ed.</option>
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
							<td>Beginn dieses Studiengangs</td>
							<td>
								<select name="studienbeginn" size="1" style="width:180px;">
									<option>bitte auswählen</option>
									<option value="2015, WS">2015/16 WS</option>
									<option value="2015, SS">2015 SS</option>
									<option value="2014, WS">2014/15 WS</option>
									<option value="2014, SS">2014 SS</option>
									<option value="2013, WS">2013/14 WS</option>				
									<option value="2013, SS">2013 SS</option>
									<option value="2012, WS">2012/13 WS</option>
									<option value="2012, SS">2012 SS</option>
									<option value="2011, WS">2011/12 WS</option>									
									<option value="2011, SS">2011 SS</option>
									<option value="2010, WS">2010/11 WS</option>
									<option value="2010, SS">2010 SS</option>
									<option value="2009, WS">2009/10 WS</option>									
									<option value="2009, SS">2009 SS</option>
									<option value="2008, WS">2008/09 WS</option>
									<option value="2008, SS">2008 SS</option>
									<option value="2007, WS">2007/08 WS</option>
									<option value="2007, SS">2007 SS</option>
									<option value="2006, WS">2006/07 WS</option>
									<option value="2006, SS">2006 SS</option>
									<option value="2005, WS">2005/06 WS</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Abschlussdatum
							</td>
							<td>
								<input type="text" name="studienabschluss" placeholder="TT.MM.JJJJ" size="10"  <?php if(isset($_POST['studienabschlus'])) echo "value=\"" . htmlspecialchars($_POST['studienabschluss'], ENT_QUOTES, 'UTF-8') . "\"";?>>
							</td>
						</tr>
					</table>

					<br>
					<br>
					<h3>Präsentation mit Foto</h3>
					<p>
					Während der Übergabe der Abschlussurkunden wird eine Präsentation gezeigt, in der die Absolventen mit Informationen zu ihrem Abschluss zu sehen sind.<br>
					Für die Präsentation ist auch ein Portraitfoto von Ihnen vorgesehen, das Sie bitte bis spätestens eine Woche vor der Feier per E-Mail an alumpi@uni-bayreuth.de schicken.
					Spätere Einsendungen können nicht mehr berücksichtigt werden, da die Präsentation rechtzeitig erstellt werden muss.<br>
					<br>
					
					Anforderungen an das Bild:
					<ul>
						<li>Seitenformat möglichst 4:3 (Höhe:Breite)</li>
						<li>Auflösung bitte mindestens 300x400 Pixel</li>
						<li>Dateityp: .jpg oder .png</li>
					</ul>
					</p>
					
					
					<br>
					<h3>Zahlung</h3>

					<p>
					Bitte überweisen Sie den Betrag von <?php echo ABSOLVENTENFEIER_PREIS; ?> € pro Person bis spätestens 3 Tage vor der Feier auf das Konto des Absolventenvereins.<br>
					<br>
					<u>Kontodaten:</u><br>
					Absolventen- und Förderverein MPI Uni Bayreuth e.V.<br>
					IBAN: DE05 7735 0110 0038 0189 41<br>
					BIC: BYLADEM1SBT<br>
					Verwendungszweck: [Nachname],[Vorname]<br>
					
					<br>
					Die entsprechenden Angaben finden Sie auch in der Bestätigungsmail zur Anmeldung.
					</p>
					
					
					<br>
					<br>
					<h3>Fragen und Anmerkungen</h3>

					<p>
					Fehlt Ihr Studiengang/Abschluss in der Auswahlliste? 
					Haben Sie weitere Fragen zum Ablauf der Feier oder möchten Sie im Orga-Team der Feier mithelfen? <br>
					Bei Fragen, Anmerkungen und Anregungen können Sie uns jederzeit über alumpi@uni-bayreuth.de kontaktieren. 
					</p>


					<button class="absenden" type="submit">Anmeldung Absenden</button>

				</form>
		