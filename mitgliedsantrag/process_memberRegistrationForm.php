<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Formulars zur Anmeldung zum Absolventenverein.
// Sie wird von der entsprechenden Seite der Homepage "Mitgliedsantrag" eingebunden. 
// Die Formulareingaben werden validiert und anschließend in der Datenbank gespeichert. Der Nutzer erhält
// eine Email mit einem Link, um seine Email-Adresse zu bestätigen.
// Nach erfolgter Bestätigung kann er sich auf der Homepage einloggen.
//======================================================================



				/*
				echo "SESSION:<br>";
				print_r($_SESSION);
				echo "<br>";
				echo "<br>";
				*/
				
				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include '../../../config-files/db_config.php';
				
				//Einbinden der PHP-Datei zur Validierung der Eingaben
				include 'formValidation_memberRegistrationForm.php';

				//Einbinden der PHP-Datei zum Verschicken der Bestätigungs-Emails
				include '../_includes_functionality/send_email.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					/*
					echo "test - formular abgeschickt <br>";
					*/
					
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
						
							/*
							echo "test - formular korrekt ausgefüllt abgeschickt <br>";
							echo "<br>";
							echo "Eingegebener Vorname: " . $_POST['vorname'] . "<br>";
							echo "Eingegebener Nachname: " . $_POST['nachname'] . "<br>";
							echo "<br>";
							*/
							
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
								echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
								echo "</p>";
							}
							
							//DB-Verbindung erfolgreich
							else {
								
								/*
								echo "Datenbankverbindung erfolgreich!<br>";
								echo "<br>";
								echo "<br>";
								echo "<h3>Formular:</h3> <br>";
								echo "<br>";
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
								echo $_POST['iststudent'] . "<br>";
								echo $_POST['newsletter'] . "<br>";
								echo $_POST['strasse'] . "<br>";
								echo $_POST['plz'] . "<br>";
								echo $_POST['ort'] . "<br>";
								echo $_POST['land'] . "<br>";
								
								echo "<br>";
								echo "<br>";
								echo "<h3>SQL-Input:</h3> <br>";
								echo "<br>";
								*/
								
								
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
								$rechtegruppe = 1;						//immer 1 (normales Mitglied) bei Registrierung
								$beitrag = 10;							//??? ggf. Fördermitglied ???
								
								
								
								
								/*
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
								echo $iban . "<br>";
								echo $bic . "<br>";
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
								*/

								
								
								//Mitgliederdaten in die Datenbank einfügen
								//Verwendung von prepared statements zur Vermeidung von SQL-Injection
								$stmt = $mysqli->prepare("INSERT INTO vereinsmitglieder   
								(eintrittsdatum, geschlecht, titel, nachname, vorname, email, strasse, plz, ort, land, geburtstag, kontoinhaber, iban, bic, bezahlt, newsletter, pw, usergruppe, telefon, studentennachweis_vorhanden, iststudent, code, bestaetigt, rechtegruppe, beitrag) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
								$stmt->bind_param("sssssssssssssssssisssssid", $eintrittsdatum, $geschlecht, $titel, $nachname, $vorname, $email, $strasse, $plz, $ort, $land, $geburtstag, $kontoinhaber, $iban, $bic, $bezahlt, $newsletter, $pw, $usergruppe, $telefon, $studentennachweis_vorhanden, $iststudent, $code, $bestaetigt, $rechtegruppe, $beitrag);
							
							
								//DB-Abfrage erfolgreich
								if($stmt->execute()) {
									
									$titleAndName = $geschlecht . " " . $titel . " " . $vorname . " " . $nachname;
									
									//Email an neues Mitglied schicken
									if (send_verification_email($email, $titleAndName, $code, $iststudent)) {
										
										//Email an den Verein schicken
										if(send_notification_email($email, $titleAndName, $iststudent)) {
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
									
									if ($mysqli->errno == 1062) {
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
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}
				



?>