<?php 

//======================================================================
// 
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


//Einbinden der Konfigurationsdatei (Passwort etc. für die Datenbank)
include_once '../../../config-files/db_config.php';

//Einbinden der Datei mit den PHP-Hilfsfunktionen zur Nutzung von refValues()
include_once '../_includes_functionality/phpUtilityFunctions.php';





//Formulardaten angekommen
if(isset($_POST['anmeldung_suchen'])) {
	
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
		$query_string = 'SELECT * FROM absolventenfeier';
		$param_string = '';
		$where_array = array();
		
		
		//Hinzufügen der eingegebenen Kriterien
		
		if(!empty($_POST['fid'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE fid=?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND fid=?';
			}
			$param_string = $param_string . 'i';
			array_push($where_array, $_POST['fid']);
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
		
		if(!empty($_POST['datum_der_feier'])) {
			if($criteria_selected === False) {	
				$query_string = $query_string . ' WHERE datum_der_feier=?';
				$criteria_selected = True;
			}
			else {								
				$query_string = $query_string . ' AND datum_der_feier=?';
			}
			$param_string = $param_string . 's';
			$datum_der_feier = date('Y-m-d', strtotime($_POST['datum_der_feier']));
			array_push($where_array, $datum_der_feier);
		}
		
		
		
		//gar keine zu extrahierende Anmeldung ausgewählt
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
			
			echo "<h2>Gefundene Anmeldungen:</h2>\n";
			echo "<br>\n";
			
			
			//Gefundene Einträge in Tabelle formatiert ausgeben
			while($recordObj = $result->fetch_assoc()) {
				
				
				//gefundene Mitgliedsdaten in Originalform in separatem Array abspeichern
				$data_db = $recordObj;
				
				//gefundene Mitgliedsdaten in Ausgabeform für die Webseite umwandeln
				$data_output['fid'] = 							$data_db['fid'];
				$data_output['datum_der_feier'] =			 	date("d.m.Y", strtotime($data_db['datum_der_feier']));
				$data_output['mid'] = 							$data_db['mid'];
				$data_output['geschlecht'] = 					$data_db['geschlecht'];
				$data_output['titel'] = 						$data_db['titel'];
				$data_output['vorname'] = 						$data_db['vorname'];
				$data_output['nachname'] = 						$data_db['nachname'];
				$data_output['email'] = 						$data_db['email'];
				$data_output['anzahl_gaeste'] = 				$data_db['anzahl_gaeste'];
				$data_output['hat_bezahlt'] = 					'Ja'; if($data_db['hat_bezahlt'] == 'n') {$data_output['hat_bezahlt'] = 'Nein';}
				$data_output['mitbringsel'] = 					$data_db['mitbringsel'];
				$data_output['selbstfeier'] = 					'Ja'; if($data_db['selbstfeier'] == 'n') {$data_output['selbstfeier'] = 'Nein';}
				$data_output['abschlussarbeitsthema'] = 		$data_db['abschlussarbeitsthema'];
				$data_output['lehrstuhl'] = 					$data_db['lehrstuhl'];
				$data_output['studiengang'] = 					$data_db['studiengang'];
				$data_output['neuer_titel'] = 					$data_db['neuer_titel'];
				$data_output['studienbeginn'] = 				$data_db['studienbeginn'];
				$data_output['studienabschluss'] = 				date("d.m.Y", strtotime($data_db['studienabschluss']));
				$data_output['gesamtpreis'] = 					$data_db['gesamtpreis'];
			
				
				
				echo '<table class="striped outlined" style="width:100%;"><colgroup><col style="width:40%;"><col style="width:60%;"></colgroup>' . "\n";
				
				
				echo '<tr><td>Feier-ID, Datum der Feier, Mitglieds-ID</td><td>' . "\n";
				echo "<strong>" . htmlspecialchars($data_output['fid'], ENT_QUOTES, 'UTF-8') . "</strong>" . ', '; 
				echo htmlspecialchars($data_output['datum_der_feier'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['mid'], ENT_QUOTES, 'UTF-8'); 		
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Geschlecht, Titel, Vorname, Nachname</td><td>' . "\n";
				echo htmlspecialchars($data_output['geschlecht'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo htmlspecialchars($data_output['titel'], ENT_QUOTES, 'UTF-8') . ', '; 
				echo "<strong>" . htmlspecialchars($data_output['vorname'], ENT_QUOTES, 'UTF-8') . "</strong>" . ', ';
				echo "<strong>" . htmlspecialchars($data_output['nachname'], ENT_QUOTES, 'UTF-8') . "</strong>";
				echo '</td></tr>' . "\n";
				
				
				echo '<tr><td>E-Mail-Adresse, hat bezaht</td><td>' . "\n";
				echo htmlspecialchars($data_output['email'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['hat_bezahlt'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Selbst Absolvent, Anzahl Gäste</td><td>' . "\n";
				echo htmlspecialchars($data_output['selbstfeier'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['anzahl_gaeste'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Mitbringsel</td><td>' . "\n";
				echo htmlspecialchars($data_output['mitbringsel'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Abschlussarbeitsthema</td><td>' . "\n";
				echo htmlspecialchars($data_output['abschlussarbeitsthema'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
										
				echo '<tr><td>Lehrstuhl</td><td>' . "\n";
				echo htmlspecialchars($data_output['lehrstuhl'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
										
				echo '<tr><td>Studiengang, neuer Titel</td><td>' . "\n";
				echo htmlspecialchars($data_output['studiengang'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['neuer_titel'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";
				
				echo '<tr><td>Studienbeginn, Studienabschluss</td><td>' . "\n";
				echo htmlspecialchars($data_output['studienbeginn'], ENT_QUOTES, 'UTF-8') . ', ';
				echo htmlspecialchars($data_output['studienabschluss'], ENT_QUOTES, 'UTF-8');
				echo '</td></tr>' . "\n";

				echo '<tr><td>Gesamtpreis</td><td>' . "\n";
				echo htmlspecialchars($data_output['gesamtpreis'], ENT_QUOTES, 'UTF-8') . ' €';
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




