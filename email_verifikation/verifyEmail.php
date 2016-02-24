<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Verifikation der E-Mail-Adresse
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}





//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once '../../../config-files/db_config.php';


$email = $_GET['email']; 
$verificationCode =$_GET['verificationCode']; 



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
	/*
	echo "Datenbankverbindung erfolgreich!<br>";
	*/
	
	//verificationCode zur E-Mail-Adresse des aktuellen Users aus der Datenbank holen
	//Verwendung von prepared statements zur Vermeidung von SQL-Injection
	$stmt = $mysqli->prepare('SELECT 
	code
	FROM vereinsmitglieder WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();

	//DB-Abfrage erfolgreich
	if($result) {
		
		
		/*
		echo "Abfrage erfolgreich!<br>";
		*/
		
		//E-Mail-Adresse gefunden
		if ($recordObj = $result->fetch_assoc()) {
			
			$code_db = $recordObj['code'];

			//Verifikationscode korrekt
			if($verificationCode === $code_db) {
	
				$bestaetigt = 'j';
	
				//Setze Mitglied in DB als bestätigt
				$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET
				bestaetigt = ?
				WHERE email = ?");
				$stmt->bind_param("ss", $bestaetigt, $email);
			
				//DB-Abfrage erfolgreich
				if($stmt->execute()) {
					
					echo "<p class=\"green\">\n";
					echo "Der Verifikationscode ist korrekt!<br>";
					echo "Ihre Email-Adresse wurde bestätigt, Sie können sich ab sofort im Mitgliedsbereich anmelden.<br>";
					echo "</p>\n";
				}								
													
				
				//Fehler bei der DB-Abfrage
				else {
				
					echo "<p class=\"error\">";
					echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
					echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
					echo "<br>";
					echo $mysqli->error;
					echo "</p>";
				}
				
				
			}
			
			//Verifikationscode falsch
			else {
				echo "<p class=\"error\">\n";
				echo "Der Verifikationscode ist nicht korrekt!<br>";
				echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
				echo "</p>\n";
			}
			
			
			
		}
		
		//Kein entsprechender User gefunden
		else {
			echo "<p class=\"error\">\n";
			echo "Die E-Mail-Adresse wurde nicht in der Datenbank gefunden!<br>";
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

		



?>