<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Formulars zur Anmeldung zum Absolventenverein.
// Sie wird von der entsprechenden Seite der Homepage "Mitgliedsantrag" eingebunden. 
// Die Formulareingaben werden validiert und anschließend in der Datenbank gespeichert. Der Nutzer erhält
// eine Email mit einem Link, um seine Email-Adresse zu bestätigen.
// Nach erfolgter Bestätigung kann er sich auf der Homepage einloggen.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}

				
				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include_once '../../../config-files/db_config.php';
				
				//Einbinden der PHP-Datei zum Verschicken der Bestätigungs-Emails
				include_once '../_includes_functionality/send_email.php';
				
				
				
				//Einbinden der PHP-Datei zur Validierung der Eingaben
				include 'formValidation_memberRegistrationForm.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					
					//echo "test - formular abgeschickt <br>";
					
					
					//Nicht alle Felder ausgefüllt
					$error = check_required_fields_register($_POST);
					if(!empty($error)) {
						echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
						echo "<p class=\"error\">";
						echo $error;
						echo "</p>";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						//Fehler in der Formatierung der Eingabe
						$error = check_fields_format_register($_POST);
						if(!empty($error)) {
							echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
							echo "<p class=\"error\">";
							echo $error;
							echo "</p>";
						}
					
						//Alle Felder korrekt formatiert
						else {
						
							
							//echo "test - formular korrekt ausgefüllt abgeschickt <br>";
							
							
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
								
								//echo "test - DB-Verbindung erfolgreich<br>";
								
								
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
								$iban = strtoupper($_POST['iban']);
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
											echo "<h3 class=\"green\">Registrierung erfolgreich!</h3>";
											echo "<p class=\"green\">";
											echo "Sie erhalten in Kürze eine Email, diese enthält einen Bestätigungslink. Sobald sie ihre Email-Adresse bestätigt haben, können Sie sich im Mitgliederbreich einloggen.";
											echo "</p>";
										}
										
										//Fehler beim Schicken der Email an den Verein
										else {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
											echo "<p class=\"error\">";
											echo "Leider ist ein Fehler beim Versand der Bestätigungsemail an den Verein aufgetreten.<br>";
											echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
										
									}
									
									//Fehler beim Schicken der Email an das neue Mitglied
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
									
									//echo "test - Fehler bei DB-Abfrage<br>";
									
									if ($mysqli->errno === 1062) {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">";
										echo "Es existiert bereits ein Nutzer mit der eingegebenen Email-Adresse.<br>";
										echo "Falls die vorherige Registrierung nicht durch Sie vorgenommen wurde wenden Sie sich bitte an den Absolventenverein unter alumpi@uni-bayreuth.de<br>";
										echo "</p>";
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