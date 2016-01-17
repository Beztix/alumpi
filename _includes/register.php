<?php 

//======================================================================
// Diese PHP-Datei dient der Auswertung des Formulars zur Anmeldung zum Absolventenverein. 
// Sie muss auf der Seite eingebunden werden, auf der sich das Anmeldeformular befindet.
//======================================================================


				echo "SESSION:<br>";
				print_r($_SESSION);
				echo "<br>";
				echo "<br>";

				include '../_includes/db_config.php';
				include '../_includes/form_validation.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					echo "test - formular abgeschickt <br>";
					
					//Nicht alle Felder korrekt ausgef�llt
					$error = check_required_fields_register();
					if(!empty($error)) {
						echo $error;
					}
					
					//Alle Felder korrekt ausgef�llt
					else {
						echo "test - formular korrekt ausgef�llt abgeschickt <br>";
						
						echo "<br>";
						echo "Eingegebener Username: " . $_POST['email'] . "<br>";
						echo "Eingegebenes Passwort: " . $_POST['pwd'] . "<br>";
						echo "<br>";
						
						
						//Zur Datenbank verbinden
						$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						
						//Fehler bei der DB-Verbindung		
						if ($mysqli->connect_errno) {
							echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank m�glich!<br>";
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
									
									//�berpr�fen des eingegebenen Passwortes (mit eingebautem Hashing)
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
								echo "Leider ist kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgef�hrt werden!<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "<br>";
								 echo $mysqli->error;
							}
							
							
						}// eof DB-Verbindung erfolgreich
						
					} //eof Alle Felder ausgef�llt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					echo "test - formular noch nicht abgeschickt";
				}
				



?>