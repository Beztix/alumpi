<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Login-Formulars für Mitglieder.
// Sie wird von der entsprechenden Seite der Homepage "Mitgliederbereich" eingebunden. 
// Die Formulareingaben werden validiert, das zugehörige Passwort wird (gehashed) aus der Datenbank ausgelesen
// und mit der Eingabe verglichen. Bei Erfolg wird der Nutzer mit einer entsprechenden Session-Variable auf dem
// Server als eingelogged gespeichert.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}





				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include_once HOME_DIRECTORY . 'config-files/db_config.php';
				
				//Einbinden der PHP-Datei zum Verschicken der Emails
				include '../_includes_functionality/send_email.php';

				
				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					//Nicht alle Felder ausgefüllt
					if(empty($_POST['email'])) {
						echo "<p class=\"error\">\n";
						echo "Es wurden keine E-Mail-Adresse eingegeben.<br>\n";
						echo "</p>\n";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						//Zur Datenbank verbinden
						$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						$mysqli->set_charset("utf8");
						
						//Fehler bei der DB-Verbindung		
						if ($mysqli->connect_errno) {
							echo "<p class=\"error\">\n";
							echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>\n";
							echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
							echo "<br>\n";
							echo "Failed to connect to MySQL<br>";
							echo "</p>\n";
						}
						
						//DB-Verbindung erfolgreich
						else {

							//Teste, ob angegebene E-Mail-Adresse existiert
							$stmt = $mysqli->prepare("SELECT email FROM vereinsmitglieder WHERE email = ?");
							$stmt->bind_param("s", $_POST['email']);
						
							//DB-Abfrage 1 erfolgreich
							if($stmt->execute()){
								
								$result = $stmt->get_result();
								
								
								//E-Mail-Adresse gefunden
								if ($recordObj = $result->fetch_assoc()) {
											
									//resetCode zum Rücksetzen des Passworts erzeugen
									date_default_timezone_set("Europe/Berlin");
									$currentDate = date("Y-m-d");				//aktuelles Datum
									$resetCode = md5($_POST['email'] . $currentDate);	//Reset-Code zum Zurücksetzen des Passworts
								
									//resetCode in die DB schreiben
									$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET
									resetCode = ? 
									WHERE email = ?");
									$stmt->bind_param("ss", $resetCode, $_POST['email']);

								
									//DB-Abfrage 2 erfolgreich
									if($stmt->execute()) {
										
										//E-Mail zum Rücksetzen versenden
										if(send_passwordReset_email($_POST['email'], $resetCode)) {
											echo "<h3 class=\"green\">E-Mail versendet!</h3>";
											echo "<p class=\"green\">";
											echo "Sie erhalten in Kürze eine E-Mail, diese enthält einen Link um das Passwort zurückzusetzen.";
											echo "</p>";
										}
										
										//Fehler beim Schicken der E-Mail
										else {
											echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
											echo "<p class=\"error\">";
											echo "Leider ist ein Fehler beim Versand der E-Mail aufgetreten.<br>";
											echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
										
										
									}//eof DB-Abfrage 2 erfolgreich							
																		
									//Fehler bei der DB-Abfrage 2
									else {
										echo "<p class=\"error\">";
										echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
										echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									} 

								}//eof E-Mail-Adresse gefunden
								
								
								//E-Mail-Adresse nicht gefunden
								else {
									
									//trotzdem Erfolgsmeldung, um keine Informationen preiszugeben!
									echo "<h3 class=\"green\">E-Mail versendet!</h3>";
									echo "<p class=\"green\">";
									echo "Sie erhalten in Kürze eine E-Mail, diese enthält einen Link um das Passwort zurückzusetzen.";
									echo "</p>";
								}
								
							}//eof DB-Abfrage 1 erfolgreich
						
							//Fehler bei der DB-Abfrage 1
							else {
								
								echo "<p class=\"error\">";
								echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "</p>";
							
							}//eof Fehler bei der DB-Abfrage 1
						
						}//eof DB-Verbindung erfolgreich
						
					} //eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}
				

?> 