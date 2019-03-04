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

				
				
				//Einbinden der PHP-Datei zur Validierung der Eingaben
				include 'formValidation_passwordResetForm.php';
				
				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					//Nicht alle Felder ausgefüllt
					$error = check_required_fields_passwordReset($_POST);
					if(!empty($error)) {
						echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
						echo "<p class=\"error\">";
						echo $error;
						echo "</p>";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						//Fehler in der Formatierung der Eingabe
						$error = check_fields_format_passwordReset($_POST);
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
								echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "<br>";
								echo "Failed to connect to MySQL<br>";
								echo "</p>";
							}
							
							//DB-Verbindung erfolgreich
							else {
								
								
								//Teste, ob der resetCode korrekt ist
								$stmt = $mysqli->prepare("SELECT email, resetCode FROM vereinsmitglieder WHERE email = ?");
								$stmt->bind_param("s", $_GET['email']);
								
								
								//DB-Abfrage 1 erfolgreich
								if($stmt->execute()){
								
									$result = $stmt->get_result();
								
									//E-Mail-Adresse gefunden
									if ($recordObj = $result->fetch_assoc()) {
										
										//resetCode korrekt
										if($recordObj['resetCode'] === $_GET['resetCode']) {
											
											//Überprüfte Formulareingabe als neues Passwort hashen
											$pw_neu = password_hash($_POST['passwort'], PASSWORD_DEFAULT);

										
											//neues gehashtes Passwort in die DB schreiben
											$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET pw = ? WHERE email = ?");
											$stmt->bind_param("ss", $pw_neu, $_GET['email']);
									
											//DB-Abfrage 2 erfolgreich
											if($stmt->execute()) {
												
												//Seite neu laden (mit Übergabe einer GET-Variable, um Erfolgsmeldung auf der neu geladenen Seite anzuzeigen)
												header('Location: ./index.php?status=success');
											}								
																			
											//Fehler bei der DB-Abfrage 2
											else {
												echo "<p class=\"error\">";
												echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
												echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
												echo "</p>";
											}
										
										}
										
										//resetCode nicht korrekt
										else {
											echo "<p class=\"error\">";
											echo "Der verwendete Link zum Rücksetzen des Passworts ist nicht korrekt! Bitte verwenden Sie den Link aus der E-Mail um dass Passwort zurückzusetzen.<br>";
											echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
											echo "</p>";
										}
									}
									
									//E-Mail-Adresse nicht gefunden
									else {
										echo "<p class=\"error\">";
										echo "Der verwendete Link zum Rücksetzen des Passworts ist nicht korrekt! Bitte verwenden Sie den Link aus der E-Mail um dass Passwort zurückzusetzen.<br>";
										echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									}
									
								}
								
								//Fehler bei der DB-Abfrage 1
								else {
									echo "<p class=\"error\">";
									echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
									echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
									echo "</p>";
								}
							
							}// eof DB-Verbindung erfolgreich
							
						}//eof Alle Felder korrekt formatier	
						
					}//eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}
				

?> 