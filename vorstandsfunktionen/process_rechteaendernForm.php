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
		echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
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
	

		//DB-Abfrage erfolgreich
		if($stmt->execute()) {
			
			//Erfolgsmeldung anzeigen
			echo "<p class=\"green\">\n";
			echo "Rechte erfolgreich eingetragen, bitte korrekten Eintrag mittels der Suche nach der MID überprüfen";
			echo "</p>\n";
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





