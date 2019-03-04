<?php 

//======================================================================

//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';



//Formulardaten angekommen
if(isset($_POST['studentennachweise_zuruecksetzen'])) {

	
	//Zur Datenbank verbinden
	$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$mysqli->set_charset("utf8");
	
	//Fehler bei der DB-Verbindung		
	if ($mysqli->connect_errno) {
		echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>";
		echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
		echo "<br>";
		echo "Failed to connect to MySQL<br>";
	}
	
	//DB-Verbindung erfolgreich
	else {
		$studentennachweis = 'n';
		
		//Mitgliederdaten aus der Datenbank holen
		$stmt = $mysqli->prepare('UPDATE vereinsmitglieder SET studentennachweis_vorhanden = ?');
		$stmt->bind_param("s", $studentennachweis);
		
		//DB-Abfrage erfolgreich
		if($stmt->execute()) {
			
			//Erfolgsmeldung anzeigen
			echo "<p class=\"green\">\n";
			echo "Die vorhandenen Studentennachweise wurden erfolgreich zurückgesetzt!";
			echo "</p>\n";
			
		}
		
		//Fehler bei der DB-Abfrage
		else {
			echo "<p class=\"error\">\n";
			echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
			echo "</p>\n";
		}
		
	}// eof DB-Verbindung erfolgreich

}//eof Formulardaten angekommen





