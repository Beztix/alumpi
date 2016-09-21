<?php 

//======================================================================

//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';

//Einbinden der PHP-Datei zum Verschicken der Bestätigungs-Emails
include_once '../mitgliedsantrag/send_registrationVerificationEmail.php';



//===================================================
//      Bestätigungsmail erneut verschicken
//===================================================



//Formulardaten angekommen
if(isset($_POST['mail_verschicken'])) {

	
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
		$stmt = $mysqli->prepare('SELECT * FROM vereinsmitglieder WHERE mid = ?');
		$stmt->bind_param('s', $_POST['mid']);
		$stmt->execute();
		$result = $stmt->get_result();
		
		//DB-Abfrage erfolgreich
		if($result) {
			
			//Username gefunden
			if ($recordObj = $result->fetch_assoc()) {
			
				//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
				$data_db = $recordObj;
				
				$email = $data_db['email'];
				$geschlecht = $data_db['geschlecht'];
				$titel = $data_db['titel'];
				$vorname = $data_db['vorname'];
				$nachname = $data_db['nachname'];
				$code = $data_db['code'];
				$iststudent = $data_db['iststudent'];
				
				
				if($titel === 'B.Sc.' || $titel === 'M.Sc.' || $titel === 'B.Ed.' || $titel === 'M.Ed.') {
					$titleAndName = $geschlecht . " " . $vorname . " " . $nachname;
				}
				else {
						$titleAndName = $geschlecht . " " . $titel . " " . $vorname . " " . $nachname;
				}
					
				//Email an neues Mitglied schicken
				if (send_verificationEmail_memberRegistration($email, $titleAndName, $code, $iststudent)) {
					
					echo "<h3 class=\"green\">Verschicken der Mail erfolgreich!</h3>";
					
				}
				
				//Fehler beim Schicken der Email an das neue Mitglied
				else {
					echo "<h3 class=\"error\">Fehler bei der Verarbeitung des Formulars:</h3>\n";
					echo "<p class=\"error\">";
					echo "Leider ist ein Fehler beim Versand der Bestätigungsemail aufgetreten.<br>";
					echo "Bitte kontaktieren sie den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
					echo "</p>";
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









