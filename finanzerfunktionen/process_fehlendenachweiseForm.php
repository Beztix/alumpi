<?php 

//======================================================================
//
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';




//===================================================
//      Mitgliederdaten abrufen
//===================================================


//Formulardaten angekommen
if(isset($_POST['fehlende_studentennachweise_abrufen'])) {

	
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
		
		$iststudent = 'j';
		$studentennachweis_vorhanden = 'n';
		
		//Mitgliederdaten aus der Datenbank holen
		$stmt = $mysqli->prepare('SELECT email FROM vereinsmitglieder WHERE iststudent = ? AND studentennachweis_vorhanden = ?');
		$stmt->bind_param('ss', $iststudent, $studentennachweis_vorhanden);
		$stmt->execute();
		$result = $stmt->get_result();
		
		//DB-Abfrage erfolgreich
		if($result) {
			
			//Zu generierende Datei (ausserhalb des öffentlichen www-verzeichnis!!)
			$file = HOME_DIRECTORY . 'generated_files/emailadressen_studentennachweisFehlt.csv';
			$output = fopen($file, 'w');

			//Zeilen der Datenbankabfrage in CSV-Datei schreiben
			while($recordObj = $result->fetch_assoc()) {
				fputcsv($output, $recordObj);
			}

			fclose($output);
			
			
			ob_end_clean();
			
			//Datei an User zum Download ausliefern
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_end_clean();
			flush();
			readfile($file);
			exit;
			
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





