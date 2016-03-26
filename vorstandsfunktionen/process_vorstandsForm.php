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



//Hilfsfunktion, um Werte als Reference statt als Value zu übergeben
//(benötigt für mysqli bin_params in Kombination mit call_user_func_array(), da hier die Werte als Reference übergeben werden müssen)
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}



//===================================================
//      Mitgliederdaten abrufen
//===================================================


//Formulardaten angekommen
if(isset($_POST['mitglieder_abrufen'])) {
	

	
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
		
		//Mitgliederdaten aus der Datenbank holen
		$stmt = $mysqli->prepare('SELECT 
		mid, eintrittsdatum, geschlecht, titel, vorname, nachname, geburtstag, email, telefon, newsletter, strasse, plz, ort, land, iststudent, kontoinhaber, iban, bic, pw
		FROM vereinsmitglieder');
		$stmt->execute();
		$result = $stmt->get_result();
		
		//DB-Abfrage erfolgreich
		if($result) {
			
			//Zu generierende Datei (ausserhalb des öffentlichen www-verzeichnis!!)
			$file = '../../../generated_files/mitgliederdaten.csv';
			$output = fopen($file, 'w');

			//Zeilen der Datenbankabfrage in CSV-Datei schreiben
			while($recordObj = $result->fetch_assoc()) {
				 fputcsv($output, $recordObj);
			}
			fclose($output);
			
			//Datei an User zum Download ausliefern
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
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
				$query_string = $query_string . ' AND foerderer=?';
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
				$query_string = $query_string . ' AND mitglied=?';
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
				$query_string = $query_string . ' AND orga=?';
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
				$query_string = $query_string . ' AND kuratorium=?';
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
				$query_string = $query_string . ' AND finanzer=?';
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
				$query_string = $query_string . ' AND vorstand=?';
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
				$query_string = $query_string . ' AND admin=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, 1);
		}
		
		
		
		//gar keine zu extrahierende E-Mail-Adressen ausgewählt
		if(!$checkbox_selected) {
			echo "<p class=\"error\">\n";
			echo "Es wurden keine zu extrahierenden E-Mail-Adressen ausgewählt.<br>";
			echo "</p>\n"; 
			exit;
		}


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
			
			//Datei an User zum Download ausliefern
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
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
		
	}// eof DB-Verbindung erfolgreich

}//eof Formulardaten angekommen







//===================================================
//      Mitglied suchen
//===================================================


//Formulardaten angekommen
if(isset($_POST['mitglied_suchen'])) {
	
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
		//Zusammenbauen der DB-Abfrage, je nachdem welche Kriterien eingegeben wurden
		//---------------
		
		//initialisieren der anfrage-teile
		$criteria_selected = False;
		$query_string = 'SELECT * FROM vereinsmitglieder';
		$param_string = '';
		$where_array = array();
		
		
		//Hinzufügen der eingegebenen Kriterien
		
		if(!empty($_POST['mid'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE mid=?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND mid=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, $_POST['mid']);
		}
		
		if(!empty($_POST['vorname'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE vorname=?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND vorname=?';
			}
			$param_string = $param_string . 's';
			array_push($where_array, $_POST['vorname']);
		}
		
		if(!empty($_POST['nachname'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE nachname=?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND nachname=?';
			}
			$param_string = $param_string . 's';
			array_push($where_array, $_POST['nachname']);
		}
		
		if(!empty($_POST['vor_datum'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE eintrittsdatum<?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND eintrittsdatum<?';
			}
			$param_string = $param_string . 's';
			$vor_datum = date('Y-m-d', strtotime($_POST['vor_datum']));
			array_push($where_array, $vor_datum);
		}
		
		if(!empty($_POST['nach_datum'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE eintrittsdatum>?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND eintrittsdatum>?';
			}
			$param_string = $param_string . 's';
			$nach_datum = date('Y-m-d', strtotime($_POST['nach_datum']));
			array_push($where_array, $nach_datum);
		}
		
		
		//gar keine zu extrahierende E-Mail-Adressen ausgewählt
		if(!$criteria_selected) {
			echo "<p class=\"error\">\n";
			echo "Es wurden keine Auswahlkriterien eingegeben.<br>";
			echo "</p>\n"; 
			exit;
		}

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
			
			echo "<h3>Gefundene Mitglieder:</h3>\n";
			echo "<br>\n";
			
			
			//Gefundene Einträge in Tabelle formatiert ausgeben
			while($recordObj = $result->fetch_assoc()) {
				
				
				//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
				$data_db = $recordObj;
				
				//gefundene Mitgliedsdaten in Ausgabeform für die Webseite umwandeln
				$data_output['mid'] = 							$data_db['mid'];
				$data_output['eintrittsdatum'] =			 	date("d.m.Y", strtotime($data_db['eintrittsdatum']));
				$data_output['geschlecht'] = 					$data_db['geschlecht'];
				$data_output['titel'] = 						$data_db['titel'];
				$data_output['vorname'] = 						$data_db['vorname'];
				$data_output['nachname'] = 						$data_db['nachname'];
				$data_output['geburtstag'] = 					date("d.m.Y", strtotime($data_db['geburtstag']));
				$data_output['email'] = 						$data_db['email'];
				$data_output['telefon'] = 						' --- '; if(!empty($data_db['telefon'])) {$data_output['telefon'] = $data_db['telefon'];};
				$data_output['newsletter'] = 					'Ja'; if($data_db['newsletter'] == 'n') {$data_output['newsletter'] = 'Nein';}
				$data_output['bestaetigt'] = 					'Ja'; if($data_db['bestaetigt'] == 'n') {$data_output['bestaetigt'] = 'Nein';}
				$data_output['strasse'] = 						' --- '; if(!empty($data_db['strasse'])) {$data_output['strasse'] = $data_db['strasse'];}
				$data_output['plz'] = 							' --- '; if(!empty($data_db['plz'])) {$data_output['plz'] = $data_db['plz'];}
				$data_output['ort'] = 							' --- '; if(!empty($data_db['ort'])) {$data_output['ort'] = $data_db['ort'];}
				$data_output['land'] = 							' --- '; if(!empty($data_db['land'])) {$data_output['land'] = $data_db['land'];}
				$data_output['iststudent'] = 					'Ja'; if($data_db['iststudent'] == 'n') {$data_output['iststudent'] = 'Nein';}
				$data_output['studentennachweis_vorhanden'] = 	'Ja'; if($data_db['studentennachweis_vorhanden'] == 'n') {$data_output['studentennachweis_vorhanden'] = 'Nein';}
				$data_output['kontoinhaber'] = 					' --- '; if(!empty($data_db['kontoinhaber'])) {$data_output['kontoinhaber'] = $data_db['kontoinhaber'];}
				$data_output['iban'] = 							' --- '; if(!empty($data_db['iban'])) {$data_output['iban'] = $data_db['iban'];}
				$data_output['bic'] = 							' --- '; if(!empty($data_db['bic'])) {$data_output['bic'] = $data_db['bic'];}
				$data_output['bezahlt'] = 						'Ja'; if($data_db['bezahlt'] == 'n') {$data_output['bezahlt'] = 'Nein';}
				$data_output['beitrag'] = 						$data_db['beitrag'];
				$data_output['foerderer'] = 					$data_db['foerderer'];
				$data_output['mitglied'] = 						$data_db['mitglied'];
				$data_output['orga'] = 							$data_db['orga'];
				$data_output['kuratorium'] = 					$data_db['kuratorium'];
				$data_output['finanzer'] = 						$data_db['finanzer'];
				$data_output['vorstand'] = 						$data_db['vorstand'];
				$data_output['admin'] = 						$data_db['admin'];
				
				echo '<table class="striped outlined" style="width:100%;"><colgroup><col style="width:40%;"><col style="width:60%;"></colgroup>' . "\n";
				
				
				echo '<tr><td>Mitglieds-ID, Eintrittdatum</td><td>' . "\n";
				echo htmlspecialchars($data_output['mid'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['eintrittsdatum'], ENT_QUOTES, 'UTF-8'); 		
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Geschlecht, Titel, Vorname, Nachname</td><td>' . "\n";
				echo htmlspecialchars($data_output['geschlecht'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['titel'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo "<strong>" . htmlspecialchars($data_output['vorname'], ENT_QUOTES, 'UTF-8') . "</strong>" . ', ';
				echo "<strong>" . htmlspecialchars($data_output['nachname'], ENT_QUOTES, 'UTF-8') . "</strong>";
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Geburtsdatum</td><td>' . "\n";
				echo htmlspecialchars($data_output['geburtstag'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>E-Mail-Adresse, Telefonnummer</td><td>' . "\n";
				echo htmlspecialchars($data_output['email'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['telefon'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Newsletter abonniert, Anmeldung bestätigt</td><td>' . "\n";
				echo htmlspecialchars($data_output['newsletter'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['bestaetigt'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Straße, Hausnummer</td><td>' . "\n";
				echo htmlspecialchars($data_output['strasse'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>PLZ, Ort, Land</td><td>' . "\n";
				echo htmlspecialchars($data_output['plz'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['ort'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['land'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
										
				echo '<tr><td>Kontoinhaber</td><td>' . "\n";
				echo htmlspecialchars($data_output['kontoinhaber'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
										
				echo '<tr><td>IBAN, BIC</td><td>' . "\n";
				echo htmlspecialchars($data_output['iban'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['bic'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Student, Nachweis vorhanden</td><td>' . "\n";
				echo htmlspecialchars($data_output['iststudent'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['studentennachweis_vorhanden'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";

				echo '<tr><td>Beitrag, Bezahlt</td><td>' . "\n";
				echo htmlspecialchars($data_output['beitrag'], ENT_QUOTES, 'UTF-8') . ' €, ';
				echo htmlspecialchars($data_output['bezahlt'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";

				echo '<tr><td>Foerderer, Mitglied, Orga, Kuratorium, Finanzer, Vorstand, Admin</td><td>' . "\n";
				echo htmlspecialchars($data_output['foerderer'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['mitglied'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['orga'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['kuratorium'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['finanzer'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['vorstand'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['admin'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";				
						
				echo '</table><br><br>' . "\n";
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

}//eof Formulardaten angekommen





		

//===================================================
//      Rechte ändern
//===================================================


//Formulardaten angekommen
if(isset($_POST['rechte_aendern'])) {
	

	
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
		
		
		//Neue Rechte in die Datenbank schreiben
		$stmt = $mysqli->prepare("UPDATE vereinsmitglieder SET
		foerderer = ?, 
		mitglied = ?,
		orga = ?,
		kuratorium = ?,
		finanzer = ?, 
		vorstand = ?, 
		admin = ?
		WHERE mid = ?");
		$stmt->bind_param("iiiiiiii", $_POST['foerderer'], $_POST['mitglied'], $_POST['orga'], $_POST['kuratorium'], $_POST['finanzer'], $_POST['vorstand'], $_POST['admin'], $_POST['mid']);
	

		//DB-Abfrage erfolgreich
		if($stmt->execute()) {
			
			//Seite neu laden (mit Übergabe einer GET-Variable, um Erfolgsmeldung auf der neu geladenen Seite anzuzeigen)
			echo "<p class=\"green\">\n";
			echo "Rechte erfolgreich eingetragen, bitte korrekten Eintrag mittels der Suche nach der MID überprüfen";
			echo "</p>\n";
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





