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
include_once HOME_DIRECTORY . 'config-files/db_config.php';



		


//Formulardaten angekommen
if(isset($_POST['mitglied_loeschen'])) {
	

	
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
		
		//Mitgliedsdaten aus der Datenbank holen
		$stmt = $mysqli->prepare('SELECT * FROM vereinsmitglieder WHERE mid = ?');
		$stmt->bind_param('s', $_POST['mid']);
		$stmt->execute();
		$result = $stmt->get_result();
		
		//DB-Abfrage erfolgreich
		if($result) {
			
			//Mitglied gefunden
			if ($recordObj = $result->fetch_assoc()) {
				
				$nachname = $recordObj['nachname'];
				
				
				//Eingegebener Nachname passt zur MID
				if($nachname === $_POST['nachname']) {
					
					//Mitgliedsdaten löschen
					$stmt = $mysqli->prepare('DELETE FROM vereinsmitglieder WHERE mid = ?');
					$stmt->bind_param('s', $_POST['mid']);
					$stmt->execute();
					$affected_rows = $stmt->affected_rows;
					
					//DB-Abfrage erfolgreich
					if($affected_rows === 1) {
						echo "<h3 class=\"green\">Mitglied erfolgreich gelöscht!</h3>";
					}
					
					else if($affected_rows === 0) {
						echo "<p class=\"error\">\n";
						echo "Bei der Datenbank-Abfrage zum Löschen des Mitglieds ist eine Fehler aufgetreten, es wurde kein Mitglied gelöscht.<br>";
						echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
						echo "</p>\n";
					}
					
					else {
						echo "<p class=\"error\">\n";
						echo "Bei der Datenbank-Abfrage zum Löschen des Mitglieds ist eine Fehler aufgetreten, möglicherweise wurde mehr als ein Datensatz gelöscht.<br>";
						echo "Bitte nutzen Sie diese Funktion aktuell nicht mehr und kontaktieren Sie umgehend den Homepage-Verantwortlichen, siehe \"Kontakt\"!<br>";
						echo "</p>\n";
					}
					
				}
				

				//Nachname passt nicht zu MID
				else {
					echo "<p class=\"error\">\n";
					echo "Die eingegebene Mitglieds-ID passt nicht zum eingegebenen Nachnamen, bitte Eingaben überprüfen!<br>";
					echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
					echo "</p>\n";
				}
			
			}
		
			//Kein entsprechender User gefunden
			else {
				echo "<p class=\"error\">\n";
				echo "Die Mitglieds-ID wurde nicht in der Datenbank gefunden!<br>";
				echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
				echo "</p>\n";
			}
			
		}
		
		//Fehler bei der DB-Abfrage
		else {
			echo "<p class=\"error\">\n";
			echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
			echo "</p>\n";
		}
		
	}// eof DB-Verbindung erfolgreich

}//eof Formulardaten angekommen





