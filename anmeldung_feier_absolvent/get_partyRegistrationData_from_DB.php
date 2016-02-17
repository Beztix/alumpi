<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code um die Anmeldedaten zur Absolventenfeier eines Mitglieds aus der Datenbank auszulesen.
//
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}




//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once '../../../config-files/db_config.php';

//Array für die abgerufenen Daten in DB-Originalform
$data_db;

//Array für die abgerufenen Daten in (ggf. von DB-Originalform abweichender) Ausgabeform
$data_output;

//Ist der aktuelle User bereits zur Feier angemeldet
$userIsRegistered;


//Zur Datenbank verbinden
$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset("utf8");

//Fehler bei der DB-Verbindung		
if ($mysqli->connect_errno) {
	echo "<p class=\"error\">\n";
	echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>\n";
	echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
	echo "<br>\n";
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br>\n";
	echo "</p>\n";
}

//DB-Verbindung erfolgreich
else {
	/*
	echo "Datenbankverbindung erfolgreich!<br>";
	*/
	
	//Mitgliederdaten zur Email-Adresse des aktuellen Users aus der Datenbank holen
	//Verwendung von prepared statements zur Vermeidung von SQL-Injection
	$stmt = $mysqli->prepare('SELECT 
	mid, datum_der_feier, anzahl_gaeste, will_kontoeinzug, mitbringsel, abschlussarbeitsthema, lehrstuhl, studiengang, titel, studienbeginn, studienabschluss
	FROM absolventenfeier WHERE mid = ?');
	$stmt->bind_param('s', $_SESSION['userMID']);
	$stmt->execute();
	$result = $stmt->get_result();

	//DB-Abfrage erfolgreich
	if($result) {
		
		/*
		echo "Abfrage erfolgreich!<br>";
		*/
	
		//Username gefunden
		if ($recordObj = $result->fetch_assoc()) {
			//aktueller User ist zur Feier angemeldet
			$userIsRegistered = True;
			
			//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
			$data_db = $recordObj;
			
			//gefundene Mitgliedsdaten in Ausgabeform für die Webseite umwandeln
			$data_output['mid'] = $data_db['mid'];
			$data_output['datum_der_feier'] = date("d.m.Y", strtotime($data_db['datum_der_feier']));
			$data_output['anzahl_gaeste'] = $data_db['anzahl_gaeste'];
			$data_output['will_kontoeinzug'] = 'Ja'; if($data_db['will_kontoeinzug'] == 'n') {$data_output['will_kontoeinzug'] = 'Nein';}
			$data_output['mitbringsel'] = $data_db['mitbringsel'];
			$data_output['abschlussarbeitsthema'] = $data_db['abschlussarbeitsthema'];
			$data_output['lehrstuhl'] = $data_db['lehrstuhl'];
			$data_output['studiengang'] = $data_db['studiengang'];
			$data_output['titel'] = $data_db['titel'];
			$data_output['studienbeginn'] = $data_db['studienbeginn'];
			$data_output['studienabschluss'] = date("d.m.Y", strtotime($data_db['studienabschluss']));
			
		}
		
		//Kein entsprechender User gefunden
		else {
			//aktueller User ist nicht zur Feier angemeldet
			$userIsRegistered = False;
		}
	}
	
	//Fehler bei der DB-Abfrage
	else {
		echo "<p class=\"error\">\n";
		echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
		echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
		echo "<br>";
		echo $mysqli->error;
		echo "</p>\n";
	}
	
	
}// eof DB-Verbindung erfolgreich


?>