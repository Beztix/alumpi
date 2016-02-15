<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code um die Daten eines Miglieds aus der Datenbank auszulesen.
// Von dieser Datei werden zwei Arrays angelegt, $data_db speichert die abgerufenen Daten in DB-Originalform,
// $data_output speichert die abgerufenen Daten in Ausgabeform (Daten umformatiert etc.)
// Falls die Datenabfrage aus der DB scheitert, werden Fehlermeldungen mit echo ins HTML ausgegeben.
//======================================================================


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once '../../../config-files/db_config.php';

//Array für die abgerufenen Daten in DB-Originalform
$data_db;

//Array für die abgerufenen Daten in (ggf. von DB-Originalform abweichender) Ausgabeform
$data_output;


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
	
	//Mitgliederdaten zur MID des aktuellen Users aus der Datenbank holen
	//Verwendung von prepared statements zur Vermeidung von SQL-Injection
	$stmt = $mysqli->prepare('SELECT 
	mid, eintrittsdatum, geschlecht, titel, vorname, nachname, geburtstag, email, telefon, newsletter, strasse, plz, ort, land, iststudent, kontoinhaber, iban, bic, pw
	FROM vereinsmitglieder WHERE mid = ?');
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
			
			//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
			$data_db = $recordObj;
			
			//gefundene Mitgliedsdaten in Ausgabeform für die Webseite umwandeln
			$data_output['mid'] = $data_db['mid'];
			$data_output['eintrittsdatum'] = date("d.m.Y", strtotime($data_db['eintrittsdatum']));
			$data_output['geschlecht'] = $data_db['geschlecht'];
			$data_output['titel'] = $data_db['titel'];
			$data_output['vorname'] = $data_db['vorname'];
			$data_output['nachname'] = $data_db['nachname'];
			$data_output['geburtstag'] = date("d.m.Y", strtotime($data_db['geburtstag']));
			$data_output['email'] = $data_db['email'];
			$data_output['telefon'] = $data_db['telefon'];
			$data_output['newsletter'] = 'Ja'; if($data_db['newsletter'] == 'n') {$data_output['newsletter'] = 'Nein';}
			$data_output['strasse'] = $data_db['strasse'];
			$data_output['plz'] = $data_db['plz'];
			$data_output['ort'] = $data_db['ort'];
			$data_output['land'] = $data_db['land'];
			$data_output['iststudent'] = 'Ja'; if($data_db['iststudent'] == 'n') {$data_output['iststudent'] = 'Nein';}
			$data_output['kontoinhaber'] = $data_db['kontoinhaber'];
			$data_output['iban'] = $data_db['iban'];
			$data_output['bic'] = $data_db['bic'];
			
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
		echo "<br>";
		echo $mysqli->error;
		echo "</p>\n";
	}
	
	
}// eof DB-Verbindung erfolgreich


?>