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

//Einbinden der PHP-Datei zur Validierung der Eingaben
include 'formValidation_memberdataForm.php';




//Formulardaten angekommen
if(!empty($_POST)) {
	
	
	//Fehler in der Formatierung der Eingabe
	$error = check_fields_update($_POST, $data_db);
	if(!empty($error)) {
		echo "<h3 class=\"error\">Fehler bei der Änderung:</h3>\n";
		echo "<p class=\"error\">";
		echo $error;
		echo "</p>";
	}

	
	//Alle Felder korrekt formatiert
	else {
	
		//Zur Datenbank verbinden, um das Passwort zu überprüfen
		$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$mysqli->set_charset("utf8");
		
		//Fehler bei der DB-Verbindung		
		if ($mysqli->connect_errno) {
			echo "<p class=\"error\">\n";
			echo "Leider ist aktuell keine Verbindung zur AluMPI-Datenbank möglich!<br>\n";
			echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>\n";
			echo "<br>\n";
			echo "Failed to connect to MySQL<br>";
			echo "</p>\n";
		}
		
		//DB-Verbindung erfolgreich
		else {
			
			//(gehashtes) Passwort aus der Datenbank holen
			//Verwendung von prepared statements zur Vermeidung von SQL-Injection
			$stmt = $mysqli->prepare('SELECT pw FROM vereinsmitglieder WHERE mid = ?');
			$stmt->bind_param('s', $data_db['mid']);
			$stmt->execute();
			$result = $stmt->get_result();

			
			//DB-Abfrage des Passworts erfolgreich
			if($result) {
				
				//User gefunden
				if ($recordObj = $result->fetch_assoc()) {

					//Überprüfen des eingegebenen Passwortes (mit eingebautem Hashing)
					
					//Passwort korrekt
					if(password_verify($_POST['aktuellespasswort'], $recordObj['pw'])) {
					
						//Zur Datenbank verbinden, um die Daten zu aktualisieren
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
							
							//abgerufene Mitgliedsdaten wieder in Variablen speichern und ggf. durch überprüfte Formulareingabe ersetzen
			
							$titel_neu = $data_db['titel'];					if(!empty($_POST['titel'])) {$titel_neu = $_POST['titel'];}
							$vorname_neu = $data_db['vorname'];				if(!empty($_POST['vorname'])) {$vorname_neu = $_POST['vorname'];}
							$nachname_neu = $data_db['nachname'];			if(!empty($_POST['nachname'])) {$nachname_neu = $_POST['nachname'];}
							$geburtstag_neu = $data_db['geburtstag'];		if(!empty($_POST['geburtstag'])) {$geburtstag_neu = date('Y-m-d', strtotime($_POST['geburtstag']));}
							$email_neu = $data_db['email'];					if(!empty($_POST['email'])) {$email_neu = $_POST['email'];}
							$telefon_neu = $data_db['telefon'];				if(!empty($_POST['telefon'])) {$telefon_neu = $_POST['telefon'];}
							$newsletter_neu = $data_db['newsletter'];		if(!empty($_POST['newsletter'])) {$newsletter_neu = $_POST['newsletter'];}
							$strasse_neu = $data_db['strasse'];				if(!empty($_POST['strasse'])) {$strasse_neu = $_POST['strasse'];}
							$plz_neu = $data_db['plz'];						if(!empty($_POST['plz'])) {$plz_neu = $_POST['plz'];}
							$ort_neu = $data_db['ort'];						if(!empty($_POST['ort'])) {$ort_neu = $_POST['ort'];}
							$land_neu = $data_db['land'];					if(!empty($_POST['land'])) {$land_neu = $_POST['land'];}
							$iststudent_neu = $data_db['iststudent'];		if(!empty($_POST['iststudent'])) {$iststudent_neu = $_POST['iststudent'];}
							$kontoinhaber_neu = $data_db['kontoinhaber'];	if(!empty($_POST['kontoinhaber'])) {$kontoinhaber_neu = $_POST['kontoinhaber'];}
							$iban_neu = $data_db['iban'];					if(!empty($_POST['iban'])) {$iban_neu = $_POST['iban'];}
							$bic_neu = $data_db['bic'];						if(!empty($_POST['bic'])) {$bic_neu = $_POST['bic'];}
							$pw_neu = $data_db['pw'];						if(!empty($_POST['neuespasswort'])) {$pw_neu = password_hash($_POST['neuespasswort'], PASSWORD_DEFAULT);}
							

							//(Ggf. neue) Mitgliederdaten in die Datenbank schreiben
							//Verwendung von prepared statements zur Vermeidung von SQL-Injection
							$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET
							titel = ?, 
							vorname = ?,
							nachname = ?,
							geburtstag = ?,
							email = ?, 
							telefon = ?, 
							newsletter = ?, 
							strasse = ?,
							plz = ?,
							ort = ?, 
							land = ?, 
							iststudent = ?, 
							kontoinhaber = ?, 
							iban = ?, 
							bic = ?, 
							pw = ?
							WHERE mid = ?");
							$stmt->bind_param("sssssssssssssssss", $titel_neu, $vorname_neu, $nachname_neu, $geburtstag_neu, $email_neu, $telefon_neu, $newsletter_neu, $strasse_neu, $plz_neu, $ort_neu, $land_neu, $iststudent_neu, $kontoinhaber_neu, $iban_neu, $bic_neu, $pw_neu, $data_db['mid']);
						
					
							//DB-Abfrage der Datenaktualisierung erfolgreich
							if($stmt->execute()) {
								
								//Seite neu laden (mit Übergabe einer GET-Variable, um Erfolgsmeldung auf der neu geladenen Seite anzuzeigen)
								header('Location: ./index.php?status=success');
								
							}								
															
						
							//Fehler bei der DB-Abfrage
							else {
								
								echo "<p class=\"error\">";
								echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden!<br>";
								echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte an den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
								echo "</p>";
								
							}
						
						
						}// eof DB-Verbindung erfolgreich
					
					}// eof Passwort korrekt
				
				
					//Passwort falsch
					else {
						echo "<p class=\"error\">\n";
						echo "Das eingegebene Passwort ist falsch!<br>";
						echo "</p>\n";
					}
					
				}// eof User gefunden
					
					
				//Kein entsprechender User gefunden
				else {
					echo "<p class=\"error\">\n";
					echo "Fehler: Es wurde keine Eintrag zu ihrer MID in der Datenbank gefunden! Bitte kontaktieren Sie den IT-Verantwortlichen.<br>";
					echo "</p>\n";
				}
			
			}// eof DB-Abfrage des Passworts erfolgreich
			
			//Fehler bei der DB-Abfrage
			else {
				echo "<p class=\"error\">\n";
				echo "Leider kann aktuell keine Abfrage auf der AluMPI-Datenbank ausgeführt werden.<br>";
				echo "Falls dieses Problem weiterhin auftritt kontaktieren sie bitte den Homepage-Verantwortlichen, siehe \"Kontakt\"<br>";
				echo "</p>\n";
			}
			
		}// eof DB-Verbindung erfolgreich
	
	
	} //eof Alle Felder korrekt formatiert

	
}//eof Formulardaten angekommen

