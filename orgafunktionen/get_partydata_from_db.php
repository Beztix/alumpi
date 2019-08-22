<?php

//======================================================================
// 
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';



//Array für die abgerufenen Daten in (ggf. von DB-Originalform abweichender) Ausgabeform
$data_output;


//Zur Datenbank verbinden
$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset("utf8");

//Fehler bei der DB-Verbindung		
if ($mysqli->connect_errno) {
	echo "<p class=\"error\">\n";
	echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>\n";
	echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
	echo "<br>\n";
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br>\n";
	echo "</p>\n";
}

//DB-Verbindung erfolgreich
else {
	
	
	
	$datum_der_feier = date('Y-m-d', strtotime(ABSOLVENTENFEIER_DATUM));
	
	$stmt = $mysqli->prepare('SELECT * FROM absolventenfeier WHERE datum_der_feier = ?');
	$stmt->bind_param('s', $datum_der_feier);
	$stmt->execute();
	$result = $stmt->get_result();

	//DB-Abfrage erfolgreich
	if($result) {
		
		$anzahl_absolventen = 0;
		$anzahl_mitgebrachter_gaeste = 0;
		$anzahl_separater_gaeste = 0;

		$anzahl_laufkarten = 0;
		
		
		//Für jeden Eintrag
		while ($recordObj = $result->fetch_assoc()) {
			if($recordObj['laufkarte']) {
				$anzahl_laufkarten += 1 + $recordObj['anzahl_gaeste'];
			} else {
				if($recordObj['abschlussarbeitsthema'] == NULL) {
					$anzahl_separater_gaeste += 1 + $recordObj['anzahl_gaeste'];
				} else {
					$anzahl_absolventen += 1;
					$anzahl_mitgebrachter_gaeste += $recordObj['anzahl_gaeste'];
				}
			}
		}
		
		$data_output['anzahl_absolventen'] = $anzahl_absolventen;
		$data_output['anzahl_mitgebrachter_gaeste'] = $anzahl_mitgebrachter_gaeste;
		$data_output['anzahl_separater_gaeste'] = $anzahl_separater_gaeste;
		$data_output['anzahl_laufkarten'] = $anzahl_laufkarten;
		$data_output['anzahl_anmeldungen_gesamt'] = $anzahl_absolventen + $anzahl_mitgebrachter_gaeste + $anzahl_separater_gaeste + $anzahl_laufkarten;
	}
	
	//Fehler bei der DB-Abfrage
	else {
		echo "<p class=\"error\">\n";
		echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
		echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
		echo "<br>";
		echo $mysqli->error;
		echo "</p>\n";
	}
	
	
}// eof DB-Verbindung erfolgreich


?>