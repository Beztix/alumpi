<?php 

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zur Verifikation der E-Mail-Adresse
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}





//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once HOME_DIRECTORY . 'config-files/db_config.php';


$email = $_GET['email']; 
$resetCode =$_GET['resetCode']; 



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
	
	//resetCode zur E-Mail-Adresse des aktuellen Users aus der Datenbank holen
	//Verwendung von prepared statements zur Vermeidung von SQL-Injection
	$stmt = $mysqli->prepare('SELECT 
	resetCode
	FROM vereinsmitglieder WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();

	//DB-Abfrage erfolgreich
	if($result) {
		
		
		//E-Mail-Adresse gefunden
		if ($recordObj = $result->fetch_assoc()) {
			
			$resetCode_db = $recordObj['resetCode'];

			//Verifikationscode korrekt
			if($resetCode === $resetCode_db) {
	
				//Anzeige des Formulars zum Ändern des Passworts
				include 'content_passwordResetForm.php';
							
			}
			
			//Verifikationscode falsch
			else {
				echo "<p class=\"error\">";
				echo "Der verwendete Link zum Rücksetzen des Passworts ist nicht korrekt! Bitte verwenden Sie den Link aus der E-Mail um dass Passwort zurückzusetzen.<br>";
				echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
				echo "</p>";
			}
			
			
			
		}
		
		//Kein entsprechender User gefunden
		else {
			echo "<p class=\"error\">";
			echo "Der verwendete Link zum Rücksetzen des Passworts ist nicht korrekt! Bitte verwenden Sie den Link aus der E-Mail um dass Passwort zurückzusetzen.<br>";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
			echo "</p>";
		}
	}
	
	//Fehler bei der DB-Abfrage
	else {
		echo "<p class=\"error\">\n";
		echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
		echo "Falls dieses Problem weiterhin auftritt kontaktieren Sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
		echo "</p>\n";
	}
	
	
}// eof DB-Verbindung erfolgreich

		



?>