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
include_once '../../../config-files/db_config.php';

//Einbinden der Datei mit den PHP-Hilfsfunktionen zur Nutzung von refValues()
include_once '../_includes_functionality/phpUtilityFunctions.php';


//===================================================
//      E-Mail-Adressen zusammenstellen
//===================================================


//Formulardaten angekommen
if(isset($_POST['emails_abrufen'])) {
	
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
		
		
		//---------------
		//Zusammenbauen der DB-Abfrage, je nachdem welche checkboxen ausgewählt wurden
		//---------------
		
		//initialisieren der anfrage-teile
		$checkbox_selected = False;
		$query_string = 'SELECT email FROM vereinsmitglieder';
		$param_string = '';
		$where_array = array();
		
		
		//Hinzufügen der ausgewählten Kriterien
		
		if(isset($_POST['foerderer'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE foerderer=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR foerderer=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['mitglied'])) {
			if($checkbox_selected === False) {
				$query_string = $query_string . ' WHERE mitglied=?';
				$checkbox_selected = True;
			}
			else {
				$query_string = $query_string . ' OR mitglied=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['orga'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE orga=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR orga=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['kuratorium'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE kuratorium=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR kuratorium=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['finanzer'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE finanzer=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR finanzer=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['vorstand'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE vorstand=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR vorstand=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		if(isset($_POST['admin'])) {
			if($checkbox_selected === False) {	
				$query_string = $query_string . ' WHERE admin=?';
				$checkbox_selected = True;
			}
			else {								
				$query_string = $query_string . ' OR admin=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		
		
		//gar keine zu extrahierende E-Mail-Adressen ausgewählt
		if(!$checkbox_selected) {
			echo "<p class=\"error\">\n";
			echo "Es wurden keine zu extrahierenden E-Mail-Adressen ausgewählt.<br>";
			echo "</p>\n"; 
		}

		
		else {
			
			//Parameter für den bind_param aufruf zusammenbauen (erster Parameter ist der param_string, weitere Pameter sind die zu bindenen Werte)
			$param_array = $where_array;
			array_unshift($param_array, $param_string);
			

			//Mitgliederdaten aus der Datenbank holen
			$stmt = $mysqli->prepare($query_string);
			//Rufe bind_param() auf dem Objekt stmt mit den Parametern aus dem param_array auf, verwende Hilfsfunktion um Übergabe als Reference zu realisieren
			call_user_func_array(array(&$stmt, 'bind_param'), refValues($param_array));
			$stmt->execute();
			$result = $stmt->get_result();
			
			//DB-Abfrage erfolgreich
			if($result) {
				
				//Zu generierende Datei (ausserhalb des öffentlichen www-verzeichnis!!)
				$file = '../../../generated_files/emailadressen.csv';
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
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
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
				echo "<br>";
				echo $mysqli->error;
				echo "</p>\n";
			}
		
		}
		
	}// eof DB-Verbindung erfolgreich

}//eof Formulardaten angekommen








