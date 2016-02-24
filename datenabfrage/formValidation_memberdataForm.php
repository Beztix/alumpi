<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}




// Einbinden der PHP-Datei mit allgemeinen Validierungs-Funktionen
include_once '../_includes_functionality/global_formValidation.php';


// Überprüft, ob alle im Datenabfrage-Formular ausgefüllten Felder korrekt formatiert sind
// Gibt einen leeren String zurück falls ja oder gibt die Fehlermeldungen zurück falls nein

function check_fields_update($data_form, $data_db) {
	$error = "";
	
	
	
	if(!empty($data_form['vorname'])) {
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['vorname'])) {
			$error = $error . "Als Vorname sind nur Buchstaben erlaubt.<br>\n";
		}
	}
	if(!empty($data_form['nachname'])) {
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['nachname'])) {
			$error = $error . "Als Nachname sind nur Buchstaben erlaubt.<br>\n";
		}
	}
	if(!empty($data_form['geburtstag'])) {
		if (!preg_match("/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/",$data_form['geburtstag'])) {
			$error = $error . "Das eingegebene Geburtsdatum muss das Format TT.MM.JJJJ haben.<br>\n";
		}
	}
	if(!empty($data_form['email'])) {
		if (!filter_var($data_form['email'], FILTER_VALIDATE_EMAIL)) {
			$error = $error . "Die eingegebene Email-Adresse ist ungültig.<br>\n";
		}
	}
	
	
	//wenn der Newsletter neu abonniert wurde, muss die Adresse angegeben werden oder bereits vorhanden sein
	
	//newsletter jetzt abonniert
	if($data_form['newsletter'] === 'j') {
		//Eigabefelder leer UND Datenbankeintrag leer
		if((empty($data_form['strasse'])) && ($data_db['strasse'] === '')) {
			$error = $error . "Es wurde keine Straße eingegeben, obwohl der Newsletter abonniert wurde.<br>\n";
		}
		if((empty($data_form['plz'])) && ($data_db['plz'] === '')) {
			$error = $error . "Es wurde keine PLZ eingegeben, obwohl der Newsletter abonniert wurde..<br>\n";
		}	
		if((empty($data_form['ort'])) && ($data_db['ort'] === '')) {
			$error = $error . "Es wurde kein Ort eingegeben, obwohl der Newsletter abonniert wurde..<br>\n";
		}
		if((empty($data_form['land'])) && ($data_db['land'] === '')) {
			$error = $error . "Es wurde kein Land eingegeben, obwohl der Newsletter abonniert wurde..<br>\n";
		}		
	}

	
	if(!empty($data_form['strasse'])) {
		if (!preg_match("/^[a-zäöüß]+[.]?[ ]{1}[0-9]+([a-zäöüß]{1})?/iu",$data_form['strasse'])) {
			$error = $error . "Die eingegebene Straße und Hausnummer ist ungültig.<br>\n";
		}
	}
	if(!empty($data_form['plz'])) {
		if (!preg_match("/^[0-9]+$/",$data_form['plz'])) {
			$error = $error . "Als PLZ sind nur Ziffern erlaubt.<br>\n";
		}
	}	
	if(!empty($data_form['ort'])) {
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['ort'])) {
			$error = $error . "Als Ort sind nur Buchstaben erlaubt.<br>\n";
		}
	}
	if(!empty($data_form['land'])) {
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['land'])) {
			$error = $error . "Als Land sind nur Buchstaben erlaubt.<br>\n";
		}	
	}			
	if(!empty($data_form['kontoinhaber'])) {
		if (!preg_match("/^[a-zäöüß]+[ ]{1}[a-zäöüß]+$/iu",$data_form['kontoinhaber'])) {
			$error = $error . "Das Feld \"Kontoinhaber\" wurde nicht korrekt ausgefüllt, bitte Vor- und Nachname durch ein Leerzeichen getrennt eingeben.<br>\n";
		}
	}
	if(!empty($data_form['iban'])) {
		if (!checkIBAN($data_form['iban'])) {
			$error = $error . "Die eingegebene IBAN ist ungültig.<br>\n";
		}
	}
	if(!empty($data_form['bic'])) {
		if (!preg_match("/^[a-zA-Z]{6}[0-9a-zA-Z]{2}([0-9a-zA-Z]{3})?/",$data_form['bic'])) {
			$error = $error . "Die eingegebene BIC ist ungültig.<br>\n";
		}
	}
	
	//Wenn das Passwort-Feld nicht leer ist, muss das zweite Passwort-Feld identisch sein
	if(!empty($data_form['passwort'])) {
		if(!($data_form['passwort'] === $data_form['passwort2'])) {
			$error = $error . "Das eingegebene neue Passwort stimmt nicht mit der Passworteingabe im Kontrollfeld überein. Bitte geben Sie das Passwort in beide Felder ein, um fehlerhafte Änderungen zu vermeiden.<br>\n";
		}
		else {
			if(strlen($data_form['passwort']) < 6) {
				$error = $error . "Das neue Passwort muss mindestens 6 Zeichen lang sein.<br>\n";
			}
		}
	}
	
	
	
	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
	
}





?>