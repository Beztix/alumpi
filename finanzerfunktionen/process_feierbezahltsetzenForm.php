<?php 

//======================================================================

//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';


		

//===================================================
//      Rechte ändern
//===================================================


//Formulardaten angekommen
if(isset($_POST['feier_bezahlt_setzen'])) {
	

	
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
		
		
		//Bzehaltstatus in die Datenbank schreiben
		$stmt = $mysqli->prepare("UPDATE absolventenfeier SET hat_bezahlt = ? WHERE fid = ?");
		$stmt->bind_param("si", $_POST['hat_bezahlt'], $_POST['fid']);
		$stmt->execute();
		$affected_rows = $stmt->affected_rows;

		
		//DB-Abfrage erfolgreich
		if($affected_rows === 1) {
			
			//Erfolgsmeldung anzeigen
			echo "<p class=\"green\">\n";
			echo "Bezahltstatus erfolgreich eingetragen, bitte korrekten Eintrag in den Orga-Team-Funktionen überprüfen.";
			echo "</p>\n";
		}	
		
		//Fehler bei der DB-Abfrage
		else if($affected_rows === 0) {
			echo "<p class=\"error\">\n";
			echo "Bei der Datenbank-Abfrage ist ein Fehler aufgetreten, es wurden kein Status geändert, überprüfen Sie bitte die eingegebene MID.<br>";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
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





