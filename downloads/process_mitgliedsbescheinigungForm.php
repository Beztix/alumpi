<?php 

//======================================================================
// 
//======================================================================


//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';

include_once 'generate_mitgliedsbescheinigung.php';


//Array für die abgerufenen Daten in DB-Originalform
$data_db;


//===================================================
//      Mitgliedsdaten abrufen
//===================================================



//Formulardaten angekommen
if(isset($_POST['mitgliedsbescheinigung'])) {

	
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
		
		//Mitgliederdaten zur MID des aktuellen Users aus der Datenbank holen
		//Verwendung von prepared statements zur Vermeidung von SQL-Injection
		$stmt = $mysqli->prepare('SELECT 
		geschlecht, titel, vorname, nachname, strasse, plz, ort, land
		FROM vereinsmitglieder WHERE mid = ?');
		$stmt->bind_param('s', $_SESSION['userMID']);
		$stmt->execute();
		$result = $stmt->get_result();

		//DB-Abfrage erfolgreich
		if($result) {
			
			//Username gefunden
		if ($recordObj = $result->fetch_assoc()) {
			
			//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
			$data_db = $recordObj;
			
			$geschlecht = $data_db['geschlecht'];
			$titel = $data_db['titel'];
			$vorname = $data_db['vorname'];
			$nachname = $data_db['nachname'];
			$strasse = $data_db['strasse'];
			$plz = $data_db['plz'];
			$ort = $data_db['ort'];
			$land = $data_db['land'];
			
			if($titel === 'B.Sc.' || $titel === 'M.Sc.' || $titel === 'B.Ed.' || $titel === 'M.Ed.') {
				$titleAndName = $geschlecht . " " . $vorname . " " . $nachname;
			}
			else {
					$titleAndName = $geschlecht . " " . $titel . " " . $vorname . " " . $nachname;
			}
			
			$jahr = date("Y");
			$vorstand = ERSTER_VORSTAND;
			$datum = date("d.m.Y");
			
			
			generate_mitgliedsbescheinigung($titleAndName, $strasse, $plz, $ort, $land, $jahr, $vorstand, $datum);
			
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





