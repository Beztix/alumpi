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


//Formulardaten angekommen
if(!empty($_POST)) {
	
	//Nicht alle Felder ausgefüllt
	if(empty($_POST['email']) || empty($_POST['pwd'])) {
		echo "<p class=\"error\">\n";
		echo "Es wurden nicht alle Felder ausgefüllt.<br>\n";
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
			echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
			echo "<br>\n";
			echo "Failed to connect to MySQL<br>";
			echo "</p>\n";
		}
		
		//DB-Verbindung erfolgreich
		else {
			
			//Email-Adresse und zugehöriges (gehashtes) Passwort aus der Datenbank holen
			//Verwendung von prepared statements zur Vermeidung von SQL-Injection
			$stmt = $mysqli->prepare('SELECT mid, email, pw, bestaetigt, foerderer, mitglied, orga, kuratorium, finanzer, vorstand, admin FROM vereinsmitglieder WHERE email = ?');
			$stmt->bind_param('s', $_POST['email']);
			$stmt->execute();
			$result = $stmt->get_result();

			//DB-Abfrage erfolgreich
			if($result) {
				
			
				//Username gefunden
				if ($recordObj = $result->fetch_assoc()) {
					

					//Wurde die E-Mail-Adresse des Users bereits bestaetigt?
					if($recordObj['bestaetigt'] === 'j') {
						
						//Überprüfen des eingegebenen Passwortes (mit eingebautem Hashing)
						//Passwort korrekt
						if(password_verify($_POST['pwd'], $recordObj['pw'])) {
						
							//Rechte des Users abfragen
							$foerderer = $mitglied = $orga = $kuratorium = $finanzer = $vorstand = $admin = False;
							
							if($recordObj['foerderer'] === 1) 	$foerderer = True;
							if($recordObj['mitglied'] === 1) 	$mitglied = True;
							if($recordObj['orga'] === 1) 		$orga = True;
							if($recordObj['kuratorium'] === 1) 	$kuratorium = True;
							if($recordObj['finanzer'] === 1) 	$finanzer = True;
							if($recordObj['vorstand'] === 1) 	$vorstand = True;
							if($recordObj['admin'] === 1) 		$admin = True;
							
							//Nutzer auf Server als eingelogged speichern (session wurde bereits durch index.php gestartet)
							$_SESSION = array(
									'login' => true,
									'userMID' => $recordObj['mid'],
									'foerderer' => $foerderer,
									'mitglied' => $mitglied,
									'orga' => $orga,
									'kuratorium' => $kuratorium,
									'finanzer' => $finanzer,
									'vorstand' => $vorstand,
									'admin' => $admin
							);
							
							//Seite neu laden (nun eingelogged)
							echo '<script type="text/javascript">';
							echo 'window.location.href = \'./index.php\';';
							echo '</script>';

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
						echo "Bei Problemen kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
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
				echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
				echo "</p>\n";
			}
			
		}// eof DB-Verbindung erfolgreich
		
	} //eof Alle Felder ausgefüllt

}//eof Formulardaten angekommen

?> 
