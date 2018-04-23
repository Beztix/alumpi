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
					if(isset($_POST['mitgliedsantrag'])) {
						$error = $error . check_required_fields_additional_register($_POST);
					}
					
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
						if(isset($_POST['mitgliedsantrag'])) {
							$error = $error . check_fields_format_additional_register($_POST);
						}
						
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
								
								//==== Anmeldung zur Absolventenfeier ====
								
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
									
										//Anmeldung zur Absolventenfeier war erfolgreich
										
										echo "<h3 class=\"green\">Anmeldung zur Absolventenfeier erfolgreich!</h3>";
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
								

								
								//==== Anmeldung zum Absolventenverein ====
								
								if(isset($_POST['mitgliedsantrag'])) {
																		
									//Überprüften Formularinput in PHP-Variablen umspeichern und ggf. anpassen

									date_default_timezone_set("Europe/Berlin");
									$eintrittsdatum = date("Y-m-d");		//aktuelles Datum
									$geschlecht = $_POST['geschlecht'];
									$titel = $_POST['titel'];
									$nachname = $_POST['nachname'];
									$vorname = $_POST['vorname'];
									$email = $_POST['email'];
									$strasse = $_POST['strasse'];
									$plz = $_POST['plz'];
									$ort = $_POST['ort'];
									$land = $_POST['land'];
									$geburtstag = date('Y-m-d', strtotime($_POST['geburtstag'])); 				//Datum in Format YYYY-MM-DD für DB
									$kontoinhaber = $_POST['kontoinhaber'];
									$iban = strtoupper(str_replace(' ','',$_POST['iban']));
									$bic = strtoupper($_POST['bic']);
									$bezahlt = "n";							//immer n bei Registrierung
									$newsletter = "j"; if(isset($_POST['newsletter'])) { $newsletter = "n";}	//n falls newsletter angewählt, j sonst
									$pw = password_hash($_POST['geburtstag'], PASSWORD_DEFAULT);				//Standardpasswort ist der Geburtstag, speichere gehasht in DB
									$usergruppe = null;						//????
									$telefon = $_POST['telefon'];
									$studentennachweis_vorhanden = "n";		//immer n bei Registrierung
									$iststudent = "n"; if(isset($_POST['iststudent'])) { $iststudent = "j";}		//j falls student angewählt, n sonst
									$code = md5($email . $eintrittsdatum);	//Bestätigungscode zum Überprüfen der Email-Adresse
									$bestaetigt = "n";						//immer n bei Registrierung
									$beitrag = 10;							//??? ggf. Fördermitglied ???
									$mitglied = 1;							//User als Mitglied eintragen
									
									
									
								
									
									//Mitgliederdaten in die Datenbank einfügen
									//Verwendung von prepared statements zur Vermeidung von SQL-Injection
									$stmt = $mysqli->prepare("INSERT INTO vereinsmitglieder   
																			(eintrittsdatum, 	geschlecht, 	titel, 	nachname, 	vorname, 	email, 	strasse, 	plz, 	ort, 	land, 	geburtstag, 	kontoinhaber, 	iban, 	bic, 	bezahlt, 	newsletter, 	pw, 	telefon, 	studentennachweis_vorhanden, 	iststudent, 	code, 	bestaetigt, 	beitrag, 	mitglied) 
									VALUES 									(?, 				?, 				?, 		?, 			?, 			?, 		?, 			?, 		?, 		?, 		?, 				?, 				?, 		?, 		?, 			?, 				?, 		?, 			?, 								?, 				?, 		?, 				?, 			?)");
									$types = 								"s					s				s		s			s			s		s			s		s		s		s				s				s		s		s			s				s		s			s								s				s		s				d			s";
									$types_collapsed = preg_replace('/\s+/', '', $types);  //whitespace zur übergabe an bind_param entfernen
									$stmt->bind_param($types_collapsed, 	$eintrittsdatum, 	$geschlecht, 	$titel, $nachname, 	$vorname, 	$email, $strasse, 	$plz, 	$ort, 	$land, 	$geburtstag, 	$kontoinhaber, 	$iban, 	$bic, 	$bezahlt, 	$newsletter, 	$pw, 	$telefon, 	$studentennachweis_vorhanden, 	$iststudent, 	$code, 	$bestaetigt, 	$beitrag, 	$mitglied);
								
								
									//DB-Abfrage erfolgreich
									if($stmt->execute()) {
										
										if($titel === 'B.Sc.' || $titel === 'M.Sc.' || $titel === 'B.Ed.' || $titel === 'M.Ed.') {
											$titleAndName = $geschlecht . " " . $vorname . " " . $nachname;
										}
										else {
											$titleAndName = $geschlecht . " " . $titel . " " . $vorname . " " . $nachname;
										}
										
										//Email an neues Mitglied schicken
										if (send_verificationEmail_memberRegistration($email, $titleAndName, $code, $iststudent)) {
											
											//echo "test - Send Verification Email erfolgreich<br>";
											
											//Email an den Verein schicken
											if(send_notificationEmail_memberRegistration($email, $titleAndName, $iststudent)) {
												echo "<h3 class=\"green\">Anmeldung zum Absolventenverein erfolgreich!</h3>";
												echo "<p class=\"green\">";
												echo "Sie erhalten in Kürze eine Email, diese enthält einen Bestätigungslink. Sobald sie ihre Email-Adresse bestätigt haben, können Sie sich im Mitgliederbreich einloggen.";
												echo "</p>";
											}
											
											//Fehler beim Schicken der Email an den Verein
											else {
												echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Anmeldung zum Absolventenverein:</h3>\n";
												echo "<p class=\"error\">";
												echo "Leider ist ein Fehler beim Versand der Bestätigungsemail an den Verein aufgetreten.<br>";
												echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
												echo "</p>";
											}
											
										}
										
										//Fehler beim Schicken der Email an das neue Mitglied
										else {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Anmeldung zum Absolventenverein:</h3>\n";
											echo "<p class=\"error\">";
											echo "Leider ist ein Fehler beim Versand der Bestätigungsemail an Sie aufgetreten.<br>";
											echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
						
										
									}								
																		
									
									//Fehler bei der DB-Abfrage
									else {
										
										if ($mysqli->errno === 1062) {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Anmeldung zum Absolventenverein:</h3>\n";
											echo "<p class=\"error\">";
											echo "Es existiert bereits ein Nutzer mit der eingegebenen Email-Adresse.<br>";
											echo "Falls die vorherige Registrierung nicht durch Sie vorgenommen wurde wenden Sie sich bitte an den Absolventenverein unter alumpi@uni-bayreuth.de<br>";
											echo "</p>";
										}
										else {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Anmeldung zum Absolventenverein:</h3>\n";
											echo "<p class=\"error\">";
											echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
											echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
										
									}
									
									
								}
								
								
								//Keine Anmeldung zum Verein
								else {
									echo "<p class=\"green\">";
									echo "Sie haben keine Anmeldung zum Absolventenverein durchgeführt, Sie können dies zu einem späteren Zeitpunkt über die Unterseite \"Mitgliedsantrag\" der Homepage tun.<br>";
									echo "</p>";
								}
								
								
								
								
								
								//==== Speicherung der Kontaktdaten ====
								
								if(!isset($_POST['mitgliedsantrag']) && isset($_POST['datenspeicherung'])) {
																		
									//Überprüften Formularinput in PHP-Variablen umspeichern und ggf. anpassen

									date_default_timezone_set("Europe/Berlin");									
									$geschlecht = $_POST['geschlecht'];
									$titel = $_POST['titel'];
									$nachname = $_POST['nachname'];
									$vorname = $_POST['vorname'];
									$email = $_POST['email'];
								
									
									//Daten in die Datenbank einfügen
									//Verwendung von prepared statements zur Vermeidung von SQL-Injection
									$stmt = $mysqli->prepare("INSERT INTO adressliste   
																			(geschlecht, 	titel, 	nachname, 	vorname, 	email) 
									VALUES 									(?, 			?, 		?, 			?, 			?)");
									$types = 								"s				s		s			s			s";
									$types_collapsed = preg_replace('/\s+/', '', $types);  //whitespace zur übergabe an bind_param entfernen
									$stmt->bind_param($types_collapsed, 	$geschlecht, 	$titel, $nachname, 	$vorname, 	$email);
								
								
									//DB-Abfrage erfolgreich
									if($stmt->execute()) {
										
										echo "<p class=\"green\">";
										echo "Sie haben der Speicherung ihrer E-Mail-Adresse durch den Absolventenverein zugestimmt, vielen Dank!<br>";
										echo "</p>";
										
									}								
																		
									
									//Fehler bei der DB-Abfrage
									else {
										
										if ($mysqli->errno === 1062) {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Speicherung der E-Mail-Adresse:</h3>\n";
											echo "<p class=\"error\">";
											echo "Es existiert bereits ein Eintrag mit der eingegebenen Email-Adresse.<br>";
											echo "Falls die vorherige Registrierung nicht durch Sie vorgenommen wurde wenden Sie sich bitte an den Absolventenverein unter alumpi@uni-bayreuth.de<br>";
											echo "</p>";
										}
										else {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars zur Speicherung der E-Mail-Adresse:</h3>\n";
											echo "<p class=\"error\">";
											echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
											echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
										
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