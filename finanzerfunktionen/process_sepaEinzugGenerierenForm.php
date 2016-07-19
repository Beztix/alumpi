<?php 

//======================================================================

//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once '../../../config-files/db_config.php';


//Einbinden der Datei zum Erzeugen des SEPA-XML-Files
include_once '../_includes_functionality/SepaXmlCreator.php';



//Formulardaten angekommen
if(isset($_POST['sepa_einzug_generieren'])) {

	
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
		
		$studentennachweis_vorhanden = 'n';
		$eintrittsdatum_grenze = date('Y-01-01');
		$jahr = date('Y');
		
		//Mitgliederdaten aus der Datenbank holen
		$stmt = $mysqli->prepare('SELECT * FROM vereinsmitglieder WHERE studentennachweis_vorhanden = ? AND eintrittsdatum < ?');
		$stmt->bind_param('ss', $studentennachweis_vorhanden, $eintrittsdatum_grenze);
		$stmt->execute();
		$result = $stmt->get_result();
		
		//DB-Abfrage erfolgreich
		if($result) {
			
			//Zu generierende Datei (ausserhalb des öffentlichen www-verzeichnis!!)
			$file = '../../../generated_files/sepa_lastschriften_mitgliedsbeitraege.xml';
			
			// Erzeugen einer neuen Instanz
			$creator = new SepaXmlCreator();
			
			/*
			 * Mit den Account-Werten wird das eigene Konto beschreiben
			 * erster Parameter = Name
			 * zweiter Parameter = IBAN
			 * dritter Paramenter = BIC
			 */ 
			$creator->setAccountValues('Oliver Stauffert', 'DE05773501100038018941', 'BYLADEM1SBT');
	
			/*
			 * Setzen der von der Bundesbank übermittelte Gläubiger-ID 
			 */
			$creator->setGlaeubigerId("DE58zzz0000159557");
			
			/*
			 * Ausführung auf nächsten Tag setzen
			 */
			$creator->setAusfuehrungOffset(1);
			
			
			/*
			 * Formatierung setzen - true: XML-Datei mit Tabs und Zeilenumbrüchen, sonst ohne
			 */
			$creator->setFormatted(true);
			

			//Extrahierte Mitgliedsdaten verarbeiten: Jeweils einzeln einen Buchungseintrag in der XML-Datei generieren
			while($recordObj = $result->fetch_assoc()) {
				
				// Erzeugung eines neuen Buchungssatzez
				$buchung = new SepaBuchung();
				
				$buchung->setBetrag($recordObj['beitrag']);				// Einzugsbetrag
				$buchung->setBic($recordObj['bic']);					// BIC des Zahlungspflichtigen Institutes
				$buchung->setName($recordObj['kontoinhaber']);			// Name des Zahlungspflichtigen
				$buchung->setIban($recordObj['iban']);					// IBAN des Zahlungspflichtigen
				$buchung->setVerwendungszweck('Mitgliedsbeitrag ' . $jahr . ' Absolventen- und Förderverein MPI Uni Bayreuth e.V.');	// Verwendungszweck
				
				// Referenz auf das vom Kunden erteilte Lastschriftmandat
				// ID = Mitglieds-ID
				// Erteilung = Beitrittsdatum
				// False = seit letzter Lastschrift wurde am Mandat nichts geändert
				$buchung->setMandat($recordObj['mid'], $recordObj['eintrittsdatum'], false);
				
				
				// Buchung zur Liste hinzufügen
				$creator->addBuchung($buchung); 
			}
			
			$sepaxml = $creator->generateBasislastschriftXml();
			file_put_contents($file, $sepaxml);
			
			
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





