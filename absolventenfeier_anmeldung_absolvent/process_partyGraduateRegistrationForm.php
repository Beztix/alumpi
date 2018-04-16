<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Formulars zur Anmeldung zur Absolventenfeier als Absolvent.
// Sie wird von der entsprechenden Seite der Homepage "Anmeldung zur Absolventenfeier als Absolvent" eingebunden. 
// Die Formulareingaben werden validiert und anschließend in der Datenbank gespeichert. 
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



				
				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include_once HOME_DIRECTORY . 'config-files/db_config.php';
				
				//Einbinden der PHP-Datei zur Validierung der Eingaben
				include 'formValidation_partyGraduateRegistrationForm.php';

				//Einbinden der PHP-Datei zum Verschicken der Emails
				include 'send_partyGraduateRegistrationEmail.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					//Nicht alle Felder ausgefüllt
					$error = check_requiredFields_partyRegistrationAsGraduate($_POST);
					if(!empty($error)) {
						echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
						echo "<p class=\"error\">";
						echo $error;
						echo "</p>";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						//Fehler in der Formatierung der Eingabe
						$error = check_fieldsFormatting_partyRegistrationAsGraduate($_POST);
						if(!empty($error)) {
							echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
							echo "<p class=\"error\">";
							echo $error;
							echo "</p>";
						}
					
						//Alle Felder korrekt formatiert
						else {
					
							//Zur Datenbank verbinden
							$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
							$mysqli->set_charset("utf8");
							
							//Fehler bei der DB-Verbindung		
							if ($mysqli->connect_errno) {
								echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
								echo "<p class=\"error\">";
								echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "<br>";
								echo "Failed to connect to MySQL<br>";
								echo "</p>";
							}
							
							//DB-Verbindung erfolgreich
							else {
								
								
								//Überprüften Formularinput in PHP-Variablen umspeichern und ggf. anpassen
				
								date_default_timezone_set("Europe/Berlin");
								$datum_der_feier = date('Y-m-d', strtotime(ABSOLVENTENFEIER_DATUM));
								$geschlecht = $_POST['geschlecht'];
								$titel = $_POST['titel'];
								$nachname = $_POST['nachname'];
								$vorname = $_POST['vorname'];
								$email = $_POST['email'];						
								$anzahl_gaeste = $_POST['anzahl_gaeste'];
								$selbstfeier = 'j';
								$abschlussarbeitsthema = $_POST['abschlussarbeitsthema'];
								$lehrstuhl = $_POST['lehrstuhl'];
								$studiengang = $_POST['studiengang'];
								$neuer_titel = $_POST['neuer_titel'];
								$studienbeginn = $_POST['studienbeginn'];
								$studienabschluss = date('Y-m-d', strtotime($_POST['studienabschluss'])); 
								
								//gesamt angemeldete gaeste als integer ausrechnen
								$int_gaeste = intval($anzahl_gaeste);
								$gesamtgaeste = $int_gaeste + 1;
								//einzelpreis mit punkt als trennzeichen generieren
								$einzelpreis = str_replace(',', '.', ABSOLVENTENFEIER_PREIS);
								//gesamtpreis berechnen
								$gesamtpreis = bcmul($gesamtgaeste, $einzelpreis, 2);
								

								
								//Anmeldedaten zur Feier in die Datenbank einfügen
								//Verwendung von prepared statements zur Vermeidung von SQL-Injection
								$stmt = $mysqli->prepare("INSERT INTO absolventenfeier   
								(datum_der_feier, geschlecht, titel, nachname, vorname, email, anzahl_gaeste, selbstfeier, abschlussarbeitsthema, lehrstuhl, studiengang, neuer_titel, studienbeginn, studienabschluss, gesamtpreis) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
								$stmt->bind_param("ssssssisssssssd", $datum_der_feier, $geschlecht, $titel, $nachname, $vorname, $email, $anzahl_gaeste, $selbstfeier, $abschlussarbeitsthema, $lehrstuhl, $studiengang, $neuer_titel, $studienbeginn, $studienabschluss, $gesamtpreis);
							
							
							
							
								//DB-Abfrage erfolgreich
								if($stmt->execute()) {
									
									if($titel === 'B.Sc.' || $titel === 'M.Sc.' || $titel === 'B.Ed.' || $titel === 'M.Ed.') {
										$titleAndName = $geschlecht . " " . $vorname . " " . $nachname;
									}
									else {
										$titleAndName = $geschlecht . " " . $titel . " " . $vorname . " " . $nachname;
									}
									
									//Bestätigungs-Email senden
									if (send_partyGraduateRegistration_email($email, $titleAndName, ABSOLVENTENFEIER_DATUM, $anzahl_gaeste, $gesamtpreis)) {
									
									
										echo "<h3 class=\"green\">Anmeldung erfolgreich!</h3>";
										echo "<p class=\"green\">";
										echo "Sie erhalten in Kürze eine Email, die Ihre Anmeldung zur diesjährigen Absolventenfeier bestätigt.<br>";
										echo "</p>";
						
									
									}
									
									//Fehler beim Schicken der Email
									else {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">";
										echo "Leider ist ein Fehler beim Versand der Bestätigungsemail an Sie aufgetreten.<br>";
										echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									}
									
					
									
								}								
																	
								
								//Fehler bei der DB-Abfrage
								else {
									
									if ($mysqli->errno === 1062) {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">\n";
										echo "Für Ihre Email-Adresse wurde bereits eine Anmeldung zur diesjährigen Absolventenfeier vorgenommen.<br>\n";
										echo "<br>\n";
										echo "Falls die vorherige Anmeldung nicht durch Sie vorgenommen wurde (oder Sie sich versehentlich zuvor als Gast anstatt als aktueller Absolvent angemeldet haben)\n"; 
										echo "wenden Sie sich bitte an den Absolventenverein unter alumpi@uni-bayreuth.de<br>\n";
										echo "</p>\n";
									}
									else {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">";
										echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
										echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									}
									
								}
								
								
							}// eof DB-Verbindung erfolgreich
							
						} //eof Alle Felder korrekt formatiert
						
					} //eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}
				



?>