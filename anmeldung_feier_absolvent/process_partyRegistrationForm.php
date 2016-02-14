﻿<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Formulars zur Anmeldung zur Absolventenfeier als Absolvent.
// Sie wird von der entsprechenden Seite der Homepage "Anmeldung zur Absolventenfeier als Absolvent" eingebunden. 
// Die Formulareingaben werden validiert und anschließend in der Datenbank gespeichert. 
//======================================================================



				/*
				echo "SESSION:<br>";
				print_r($_SESSION);
				echo "<br>";
				echo "<br>";
				*/
				
				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include_once '../../../config-files/db_config.php';
				
				//Einbinden der PHP-Datei zur Validierung der Eingaben
				include 'validate_partyRegistrationForm.php';

				//Einbinden der PHP-Datei zum Verschicken der Bestätigungs-Emails
				//include 'send_email.php';

				//Formulardaten angekommen
				if(!empty($_POST)) {
					
					/*
					echo "test - formular abgeschickt <br>";
					*/
					
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
								

								
								
								//Überprüften Formularinput in PHP-Variablen umspeichern und ggf. anpassen
				
								date_default_timezone_set("Europe/Berlin");
								$datum_der_feier = date('Y-m-d', strtotime(ABSOLVENTENFEIER_DATUM)); 
								$anzahl_gaeste = $_POST['anzahl_gaeste'];
								$mid = $_SESSION['userMID'];
								$will_kontoeinzug = $_POST['will_kontoeinzug'];
								$mitbringsel = $_POST['mitbringsel'];
								$selbstfeier = 'j';
								$abschlussarbeitsthema = $_POST['abschlussarbeitsthema'];
								$lehrstuhl = $_POST['lehrstuhl'];
								$studiengang = $_POST['studiengang'];
								$titel = $_POST['titel'];
								$studienbeginn = $_POST['studienbeginn'];
								$studienabschluss = date('Y-m-d', strtotime($_POST['studienabschluss'])); 
								
							
								//--------------------------
								// TODO: BILD
								//--------------------------
								
								
								//Anmeldedaten zur Feier in die Datenbank einfügen
								//Verwendung von prepared statements zur Vermeidung von SQL-Injection
								$stmt = $mysqli->prepare("INSERT INTO absolventenfeier   
								(datum_der_feier, anzahl_gaeste, mid, will_kontoeinzug, mitbringsel, selbstfeier, abschlussarbeitsthema, lehrstuhl, studiengang, titel, studienbeginn, studienabschluss) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
								$stmt->bind_param("siisssssssss", $datum_der_feier, $anzahl_gaeste, $mid, $will_kontoeinzug, $mitbringsel, $selbstfeier, $abschlussarbeitsthema, $lehrstuhl, $studiengang, $titel, $studienbeginn, $studienabschluss);
							
							
								//DB-Abfrage erfolgreich
								if($stmt->execute()) {
									
									/*
									//Email an neues Mitglied schicken
									if (send_partyRegistration_email()) {
									
									*/
										echo "<h3 class=\"green\">Anmeldung erfolgreich!</h3>";
										echo "<p class=\"green\">";
										echo "Sie erhalten in Kürze eine Email, die Ihre Anmeldung zur diesjährigen Absolventenfeier bestätigt.<br>";
										echo "</p>";
						
									/*
									}
									
									//Fehler beim Schicken der Email an das neue Mitglied
									else {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">";
										echo "Leider ist ein Fehler beim Versand der Bestätigungsemail an Sie aufgetreten.<br>";
										echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
										echo "</p>";
									}
									*/
					
									
								}								
																	
								
								//Fehler bei der DB-Abfrage
								else {
									
									if ($mysqli->errno == 1062) {
										echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
										echo "<p class=\"error\">";
										echo "Für Ihre Mitglieds-ID wurde bereits eine Anmeldung zur diesjährigen Absolventenfeier vorgenommen.<br>";
										echo "Falls die vorherige Anmeldung nicht durch Sie vorgenommen wurde wenden Sie sich bitte an den Absolventenverein unter alumpi@uni-bayreuth.de<br>";
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