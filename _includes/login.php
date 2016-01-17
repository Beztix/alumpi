<?php

				echo "SESSION:<br>";
				print_r($_SESSION);
				echo "<br>";
				echo "<br>";

				include '../_includes/db_config.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					echo "test - formular abgeschickt <br>";
					
					//Nicht alle Felder ausgefüllt
					if(empty($_POST['email']) || empty($_POST['pwd'])) {
						echo "Es wurden nicht alle Felder ausgefüllt.";
					}
					
					//Alle Felder ausgefüllt
					else {
						echo "test - formular ausgefüllt abgeschickt <br>";
						
						echo "<br>";
						echo "Eingegebener Username: " . $_POST['email'] . "<br>";
						echo "Eingegebenes Passwort: " . $_POST['pwd'] . "<br>";
						echo "<br>";
						
						
						//Zur Datenbank verbinden
						$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						
						//Fehler bei der DB-Verbindung		
						if ($mysqli->connect_errno) {
							echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
							echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
							echo "<br>";
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						
						//DB-Verbindung erfolgreich
						else {
							echo "Datenbankverbindung erfolgreich!<br>";
							
							//Username und (gehashtes) Passwort aus der Datenbank holen
							//Verwendung von prepared statements zur Vermeidung von SQL-Injection
							$stmt = $mysqli->prepare('SELECT username, password FROM users WHERE username = ?');
							$stmt->bind_param('s', $_POST['email']);
							$stmt->execute();
							$result = $stmt->get_result();

							//DB-Abfrage erfolgreich
							if($result) {
								echo "Abfrage erfolgreich!<br>";
							
								//Username gefunden
								if ($recordObj = $result->fetch_assoc()) {
									echo "Username gefunden!<br>";
									echo "DB-Username: " . $recordObj['username'] . "<br>";
									echo "DB-Passwort: " . $recordObj['password'] . "<br>";
									
									//Überprüfen des eingegebenen Passwortes (mit eingebautem Hashing)
									//Passwort korrekt
									if(password_verify($_POST['pwd'], $recordObj['password'])) {
									
										echo "Passwort korrekt!<br>";
										
										//Session starten
										session_start();
										
										//Nutzer auf Server als eingelogged speichern
										$_SESSION = array(
												'login' => true,
												'user'  => array('username'  => $recordObj['username'])
										);
										
										//Seite neu laden
										header('Location: ./index.php');
									}
									
									//Passwort falsch
									else {
										echo "Passwort falsch!<br>";
										
										
										echo password_hash($_POST['pwd'], PASSWORD_DEFAULT) . "<br>";
										
									}
								}
								
								//Kein entsprechender User gefunden
								else {
									echo "Username nicht gefunden!<br>";
								}
							}
							
							//Fehler bei der DB-Abfrage
							else {
								echo "Leider ist kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "<br>";
								 echo $mysqli->error;
							}
							
							
						}// eof DB-Verbindung erfolgreich
						
					} //eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					echo "test - formular noch nicht abgeschickt";
				}

				?> 