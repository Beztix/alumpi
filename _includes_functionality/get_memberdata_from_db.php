<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code um die Daten eines Miglieds aus der Datenbank auszulesen.
//
//======================================================================


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include 'db_config.php';


//Variablen für die abgerufenen Daten
$mid = $titel = $vorname = $nachname = $email = $telefon = $strasse = $plz = $ort = $kontoinhaber = $konto = $blz = '';


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
	
	echo "Email-Adresse der Session: " . $_SESSION['userEmail'] . "<br>\n";
	
	
	//Email-Adresse und zugehöriges (gehashtes) Passwort aus der Datenbank holen
	//Verwendung von prepared statements zur Vermeidung von SQL-Injection
	$stmt = $mysqli->prepare('SELECT 
	mid, titel, vorname, nachname, email, telefon, strasse, plz, ort, kontoinhaber, konto, blz
	FROM vereinsmitglieder WHERE email = ?');
	$stmt->bind_param('s', $_SESSION['userEmail']);
	$stmt->execute();
	$result = $stmt->get_result();

	//DB-Abfrage erfolgreich
	if($result) {
		
		/*
		echo "Abfrage erfolgreich!<br>";
		*/
	
		//Username gefunden
		if ($recordObj = $result->fetch_assoc()) {
			
			
			echo "Email gefunden!<br>";
			echo "DB-Email: " . $recordObj['email'] . "<br>";
			echo "DB-mid: " . $recordObj['mid'] . "<br>";
			
			//gefundene Mitgliedsdaten in Variablen zur Verwendung im Seiteninhalt abspeichern.
			$mid = $recordObj['mid'];
			$titel = $recordObj['titel'];
			$vorname = $recordObj['vorname'];
			$nachname = $recordObj['nachname'];
			$email = $recordObj['email'];
			$telefon = $recordObj['telefon'];
			$strasse = $recordObj['strasse'];
			$plz = $recordObj['plz'];
			$ort = $recordObj['ort'];
			$kontoinhaber = $recordObj['kontoinhaber'];
			$konto = $recordObj['konto'];
			$blz = $recordObj['blz'];
			
		}
		
		//Kein entsprechender User gefunden
		else {
			echo "<p class=\"error\">\n";
			echo "Die eingegebene Email-Adresse wurde nicht in der Datenbank gefunden!<br>";
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