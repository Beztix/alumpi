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



		

//===================================================
//      Rechte ändern
//===================================================


//Formulardaten angekommen
if(isset($_POST['rechte_aendern'])) {
	

	
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
		
		//Neue Rechte in die Datenbank schreiben
		$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET
		foerderer = ?, 
		mitglied = ?,
		orga = ?,
		kuratorium = ?,
		finanzer = ?, 
		vorstand = ?, 
		admin = ?
		WHERE mid = ?");
		$stmt->bind_param("iiiiiiii", $_POST['foerderer'], $_POST['mitglied'], $_POST['orga'], $_POST['kuratorium'], $_POST['finanzer'], $_POST['vorstand'], $_POST['admin'], $_POST['mid']);
		$stmt->execute();
		$affected_rows = $stmt->affected_rows;

		
		//DB-Abfrage erfolgreich
		if($affected_rows === 1) {
			
			//Erfolgsmeldung anzeigen
			echo "<p class=\"green\">\n";
			echo "Rechte erfolgreich eingetragen, bitte korrekten Eintrag mittels der Suche nach der MID überprüfen";
			echo "</p>\n";
		}	
		
		//Fehler bei der DB-Abfrage
		else if($affected_rows === 0) {
			echo "<p class=\"error\">\n";
			echo "Bei der Datenbank-Abfrage ist ein Fehler aufgetreten, es wurden keine Rechte gesetzt, überprüfen Sie bitte die eingegebene MID.<br>";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
			echo "</p>\n";
		}
		else {
			echo "<p class=\"error\">\n";
			echo "Bei der Datenbank-Abfrage ist eine Fehler aufgetreten, möglicherweise wurden mehr als ein Datensatz verändert.<br>";
			echo "Bitte nutzen Sie diese Funktion aktuell nicht mehr und kontaktieren Sie umgehend den Homepage-Verantwortlichen, siehe \"Kontakt\"!<br>";
			echo "</p>\n";
		}
		
	}// eof DB-Verbindung erfolgreich

}//eof Formulardaten angekommen





