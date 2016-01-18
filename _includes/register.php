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
					
					//Nicht alle Felder ausgefüllt
					$error = check_required_fields_register();
					if(!empty($error)) {
						echo "<p class=\"error\">";
						echo $error;
						echo "</p>";
					}
					
					//Alle Felder ausgefüllt
					else {
						
						//Fehler in der Formatierung der Eingabe
						$error = check_fields_format_register();
						if(!empty($error)) {
						echo "<p class=\"error\">";
						echo $error;
						echo "</p>";
						}
					
						//Alle Felder korrekt formatiert
						else {
						
							echo "test - formular korrekt ausgefüllt abgeschickt <br>";
							
							echo "<br>";
							echo "Eingegebener Vorname: " . $_POST['vorname'] . "<br>";
							echo "Eingegebener Nachname: " . $_POST['nachname'] . "<br>";
							echo "<br>";
							
							
							//Zur Datenbank verbinden
							$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
							$mysqli->set_charset("utf8");
							
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
								echo "<br>";
								echo "<br>";
								echo "<h3>Formular:</h3> <br>";
								echo "<br>";
								//Formularinput
								echo $_POST['geschlecht'] . "<br>";
								echo $_POST['titel'] . "<br>";
								echo $_POST['vorname'] . "<br>";
								echo $_POST['nachname'] . "<br>";
								echo $_POST['geburtstag'] . "<br>";
								echo $_POST['email'] . "<br>";
								echo $_POST['telefon'] . "<br>";
								echo $_POST['kontoinhaber'] . "<br>";
								echo $_POST['iban'] . "<br>";
								echo $_POST['bic'] . "<br>";
								echo $_POST['student'] . "<br>";
								echo $_POST['newsletter'] . "<br>";
								echo $_POST['strasse'] . "<br>";
								echo $_POST['plz'] . "<br>";
								echo $_POST['ort'] . "<br>";
								echo $_POST['land'] . "<br>";
								
								echo "<br>";
								echo "<br>";
								echo "<h3>SQL-Input:</h3> <br>";
								echo "<br>";
								
								
								//Überprüften Formularinput in PHP-Variablen zum Einfügen in die DB speichern
								
								date_default_timezone_set("Europe/Berlin");
								$eintrittsdatum = date("Y-m-d");	//aktuelles Datum
								$geschlecht = $_POST['geschlecht'];
								$titel = $_POST['titel'];
								$nachname = $_POST['nachname'];
								$vorname = $_POST['vorname'];
								$email = $_POST['email'];
								$strasse = $_POST['strasse'];
								$plz = $_POST['plz'];
								$ort = $_POST['ort'];
								$land = $_POST['land'];
								$geburtstag = date('Y-m-d', strtotime($_POST['geburtstag'])); //Datum in Format YYYY-MM-DD für DB
								$kontoinhaber = $_POST['kontoinhaber'];
								$konto = $_POST['iban'];
								$blz = $_POST['bic'];
								$bezahlt = "n";						//immer n bei Registrierung
								$newsletter = "n"; if(isset($_POST['newsletter'])) { $newsletter = "j";}	//j falls newsletter angewählt, n sonst
								$pw = $geburtstag;					//Standardpasswort ist Geburtstag
								$usergruppe = null;					//????
								$telefon = $_POST['telefon'];
								$studentennachweis_vorhanden = "n";	//immer n bei Registrierung
								$iststudent = "n"; if(isset($_POST['student'])) { $iststudent = "j";}		//j falls student angewählt, n sonst
								$code = md5($email);				//Bestätigungscode zum Überprüfen der Email
								$bestaetigt = "n";					//immer n bei Registrierung
								$rechtegruppe = 1;					//immer 1 (normales Mitglied) bei Registrierung
								$beitrag = 10;						//??? ggf. Fördermitglied ???
								
								
								
								
								
								echo $eintrittsdatum . "<br>";
								echo $geschlecht . "<br>";
								echo $titel . "<br>";
								echo $nachname . "<br>";
								echo $vorname . "<br>";
								echo $email . "<br>";
								echo $strasse . "<br>";
								echo $plz . "<br>";
								echo $ort . "<br>";
								echo $land . "<br>";
								echo $geburtstag . "<br>";
								echo $kontoinhaber . "<br>";
								echo $konto . "<br>";
								echo $blz . "<br>";
								echo $bezahlt . "<br>";
								echo $newsletter . "<br>";
								echo $pw . "<br>";
								echo $usergruppe . "<br>";
								echo $telefon . "<br>";
								echo $studentennachweis_vorhanden . "<br>";
								echo $iststudent . "<br>";
								echo $code . "<br>";
								echo $bestaetigt . "<br>";
								echo $rechtegruppe . "<br>";
								echo $beitrag . "<br>";
								

								
								
								//Username und (gehashtes) Passwort aus der Datenbank holen
								//Verwendung von prepared statements zur Vermeidung von SQL-Injection
								$stmt = $mysqli->prepare("INSERT INTO vereinsmitglieder   
								(eintrittsdatum, geschlecht, titel, nachname, vorname, email, strasse, plz, ort, land, geburtstag, kontoinhaber, konto, blz, bezahlt, newsletter, pw, usergruppe, telefon, studentennachweis_vorhanden, iststudent, code, bestaetigt, rechtegruppe, beitrag) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
								$stmt->bind_param("sssssssssssssssssisssssid", $eintrittsdatum, $geschlecht, $titel, $nachname, $vorname, $email, $strasse, $plz, $ort, $land, $geburtstag, $kontoinhaber, $konto, $blz, $bezahlt, $newsletter, $pw, $usergruppe, $telefon, $studentennachweis_vorhanden, $iststudent, $code, $bestaetigt, $rechtegruppe, $beitrag);
							
							
								//DB-Abfrage erfolgreich
								if($stmt->execute()) {
									echo "Abfrage erfolgreich!<br>";
								
								/*
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
									*/
								}
								
								
								
								//Fehler bei der DB-Abfrage
								else {
									
									if ($mysqli->errno == 1062) {
										echo "<p class=\"error\">";
										echo "Es existiert bereits ein Nutzer mit der eingegebenen Email-Adresse.<br>";
										echo "Falls die Registrierung nicht durch Sie vorgenommen wurde wenden Sie sich bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									}
									else {
										echo "<p class=\"error\">";
										echo "Leider ist kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
										echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "<br>";
										echo $mysqli->error;
										echo "</p>";
									}
									
								}
								
								
							}// eof DB-Verbindung erfolgreich
							
						} //eof Alle Felder korrekt formatiert
						
					} //eof Alle Felder ausgefüllt

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					echo "test - formular noch nicht abgeschickt";
				}
				



?>