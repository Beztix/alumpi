<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Login-Formulars für Mitglieder.
// Sie wird von der entsprechenden Seite der Homepage "Mitgliederbereich" eingebunden. 
// Die Formulareingaben werden validiert, das zugehörige Passwort wird (gehashed) aus der Datenbank ausgelesen
// und mit der Eingabe verglichen. Bei Erfolg wird der Nutzer mit einer entsprechenden Session-Variable auf dem
// Server als eingelogged gespeichert.
//======================================================================




				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include '../../../config-files/db_config.php';

				
				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					/*
					echo "test - formular abgeschickt <br>";
					*/
					
					//Nicht alle Felder ausgefüllt
					if(empty($_POST['email']) || empty($_POST['pwd'])) {
						echo "<p class=\"error\">\n";
						echo "Es wurden nicht alle Felder ausgefüllt.<br>\n";
						echo "</p>\n";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						/*
						echo "test - formular ausgefüllt abgeschickt <br>";
						echo "<br>";
						echo "Eingegebene Email-Adresse: " . $_POST['email'] . "<br>";
						echo "Eingegebenes Passwort: " . $_POST['pwd'] . "<br>";
						echo "<br>";
						*/
						
						//Zur Datenbank verbinden
						$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						$mysqli->set_charset("utf8");
						
						//Fehler bei der DB-Verbindung		
						if ($mysqli->connect_errno) {
							echo "<p class=\"error\">\n";
							echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>\n";
							echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
							echo "<br>\n";
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br>\n";
							echo "</p>\n";
						}
						
						//DB-Verbindung erfolgreich
						else {
							
							/*
							echo "Datenbankverbindung erfolgreich!<br>";
							*/
							
							//Email-Adresse und zugehöriges (gehashtes) Passwort aus der Datenbank holen
							//Verwendung von prepared statements zur Vermeidung von SQL-Injection
							$stmt = $mysqli->prepare('SELECT mid, email, pw, bestaetigt FROM vereinsmitglieder WHERE email = ?');
							$stmt->bind_param('s', $_POST['email']);
							$stmt->execute();
							$result = $stmt->get_result();

							//DB-Abfrage erfolgreich
							if($result) {
								
								/*
								echo "test - Abfrage erfolgreich!<br>";
								*/
							
								//Username gefunden
								if ($recordObj = $result->fetch_assoc()) {
									
									/*
									echo "test - Email gefunden!<br>";
									echo "DB-Email: " . $recordObj['email'] . "<br>";
									echo "DB-Passwort: " . $recordObj['pw'] . "<br>";
									*/
									
									//Wurde die E-Mail-Adresse des Users bereits bestaetigt?
									if($recordObj['bestaetigt'] == 'j') {
										
										//Überprüfen des eingegebenen Passwortes (mit eingebautem Hashing)
										//Passwort korrekt
										if(password_verify($_POST['pwd'], $recordObj['pw'])) {
										
											/*
											echo "test - Passwort korrekt!<br>";
											*/
											
											
											//Nutzer auf Server als eingelogged speichern (session wurde bereits durch index.php gestartet)
											$_SESSION = array(
													'login' => true,
													'userMID' => $recordObj['mid']
											);
											
											//Seite neu laden (nun eingelogged)
											header('Location: ./index.php');
											
										}
										
										//Passwort falsch
										else {
											echo "<p class=\"error\">\n";
											echo "Das eingegebene Passwort ist falsch!<br>";
											echo "</p>\n";
										}
										
										
									}
									else {
										echo "<p class=\"error\">\n";
										echo "Die eingegebene E-Mail-Adresse wurde noch nicht bestätigt. ";
										echo "Verwenden Sie dazu bitte den Verifikationslink aus der Bestätigungsmail der Anmeldung als Mitglied.<br>";
										echo "Bei Problemen kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>\n";
									}
									
									
									
								}
								
								//Kein entsprechender User gefunden
								else {
									echo "<p class=\"error\">\n";
									echo "Die eingegebene E-Mail-Adresse wurde nicht in der Datenbank gefunden!<br>";
									echo "</p>\n";
								}
							}
							
							//Fehler bei der DB-Abfrage
							else {
								echo "<p class=\"error\">\n";
								echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "<br>";
								echo $mysqli->error;
								echo "</p>\n";
							}
							
							
						}// eof DB-Verbindung erfolgreich
						
					} //eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}
				

?> 