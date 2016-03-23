<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Auswertung des Formulars zur Änderung der Mitgliedsdaten.
// Sie wird von der entsprechenden Seite der Homepage "Datenabfrage" eingebunden. 
// Die Formulareingaben werden validiert und die Änderungen werden in der Datenbank gespeichert. 
// Dem Nutzer werden die eingetragenen Änderungen auf der Homepage angezeigt.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}






				//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
				include_once '../../../config-files/db_config.php';
				

				
				
				
				//Formulardaten angekommen
				if(isset($_POST['mitglieder_abrufen'])) {
					
					

					
					//Zur Datenbank verbinden
					$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
					$mysqli->set_charset("utf8");
					
					//Fehler bei der DB-Verbindung		
					if ($mysqli->connect_errno) {
						echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
						echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
						echo "<br>";
						echo "Failed to connect to MySQL<br>";
					}
					
					//DB-Verbindung erfolgreich
					else {
						
						//Mitgliederdaten aus der Datenbank holen
						$stmt = $mysqli->prepare('SELECT 
						mid, eintrittsdatum, geschlecht, titel, vorname, nachname, geburtstag, email, telefon, newsletter, strasse, plz, ort, land, iststudent, kontoinhaber, iban, bic, pw
						FROM vereinsmitglieder');
						$stmt->execute();
						$result = $stmt->get_result();

						
						//DB-Abfrage erfolgreich
						if($result) {
							
							$file = '../../../generated_files/mitgliederdaten.csv';
							
							$output = fopen($file, 'w');

							while($recordObj = $result->fetch_assoc()) {
								 fputcsv($output, $recordObj);
							}
							fclose($output);
							
							
							header('Content-Description: File Transfer');
							header('Content-Type: application/octet-stream');
							header('Content-Disposition: attachment; filename='.basename($file));
							header('Content-Transfer-Encoding: binary');
							header('Expires: 0');
							header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
							header('Pragma: public');
							header('Content-Length: ' . filesize($file));
							ob_clean();
							flush();
							readfile($file);
							exit;
							
							
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
					

					
					

				}//eof Formulardaten angekommen



				//Formular (noch) nicht abgeschickt
				else {
					/*
					echo "test - formular noch nicht abgeschickt";
					*/
				}