<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================


// Einbinden der PHP-Datei mit allgemeinen Validierungs-Funktionen
include_once '../_includes_functionality/global_formValidation.php';


// Überprüft, ob alle im Registrierungs-Formular benötigten Felder ausgefüllt wurden
// Gibt einen leeren String zurück falls ja oder gibt die Fehlermeldungen zurück falls nein

function check_required_fields_register($data_form) {
	$error = "";
	
	// überprüfe alle zwingend notwendigen Textfelder
	
	if(empty($data_form['vorname'])) {
		$error = $error . "Es wurde kein Vorname eingegeben.<br>\n";
	}
	if(empty($data_form['nachname'])) {
		$error = $error . "Es wurde kein Nachname eingegeben.<br>\n";
	}
	if(empty($data_form['geburtstag'])) {
		$error = $error . "Es wurde kein Geburtsdatum eingegeben.<br>\n";
	}
	if(empty($data_form['email'])) {
		$error = $error . "Es wurde keine Email-Adresse eingegeben.<br>\n";
	}
	if(empty($data_form['kontoinhaber'])) {
		$error = $error . "Es wurde kein Kontoinhaber eingegeben.<br>\n";
	}
	if(empty($data_form['iban'])) {
		$error = $error . "Es wurde keine IBAN eingegeben.<br>\n";
	}
	if(empty($data_form['bic'])) {
		$error = $error . "Es wurde keine BIC eingegeben.<br>\n";
	}
	
	
	// falls die Checkbox "newsletter" nicht(!) ausgewählt wurde, muss eine Adresse eingegeben werden
	if(!isset($data_form['newsletter'])) {
		
		if(empty($data_form['strasse'])) {
			$error = $error . "Es wurde keine Straße eingegeben.<br>\n";
		}
		if(empty($data_form['plz'])) {
			$error = $error . "Es wurde keine PLZ eingegeben.<br>\n";
		}	
		if(empty($data_form['ort'])) {
			$error = $error . "Es wurde kein Ort eingegeben.<br>\n";
		}
		if(empty($data_form['land'])) {
			$error = $error . "Es wurde kein Land eingegeben.<br>\n";
		}		
	}

	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
}





// Überprüft, ob der Inhalt aller im Registrierungs-Formular benötigten Felder korrekt formatiert ist
// Gibt einen leeren String zurück falls ja oder gibt die Fehlermeldungen zurück falls nein

function check_fields_format_register($data_form) {
	$error = "";
	
	// Überprüfe ob die Namensfelder nur Buchstaben enthalten
	if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['vorname'])) {
		$error = $error . "Als Vorname sind nur Buchstaben erlaubt.<br>\n";
	}
	if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['nachname'])) {
		$error = $error . "Als Nachname sind nur Buchstaben erlaubt.<br>\n";
	}
	
	// Überprüfe das Geburtsdatum auf korrektes Format
	if (!isValidDate($data_form['geburtstag'])) {
		$error = $error . "Das eingegebene Geburtsdatum ist kein korrektes Datum. Die Eingabe muss die Form TT.MM.JJJJ haben.<br>\n";
	}

	// Überprüfe die Email-Adresse auf korrektes Format
	if (!filter_var($data_form['email'], FILTER_VALIDATE_EMAIL)) {
		$error = $error . "Die eingegebene Email-Adresse ist ungültig.<br>\n";
	}

	// Überprüfe den Kontoinhaber
	if (!preg_match("/^[a-zäöüß]+[ ]{1}[a-zäöüß]+$/iu",$data_form['kontoinhaber'])) {
		$error = $error . "Das Feld \"Kontoinhaber\" wurde nicht korrekt ausgefüllt, bitte Vor- und Nachname durch ein Leerzeichen getrennt eingeben.<br>\n";
	}
	
	// Überprüfe die IBAN
	if (!checkIBAN($data_form['iban'])) {
		$error = $error . "Die eingegebene IBAN ist ungültig.<br>\n";
	}
	
	// Überprüfe die BIC
	if (!preg_match("/^[a-zA-Z]{6}[0-9a-zA-Z]{2}([0-9a-zA-Z]{3})?/",$data_form['bic'])) {
		$error = $error . "Die eingegebene BIC ist ungültig.<br>\n";
	}
	
	
	// falls die Checkbox "newsletter" nicht(!) ausgewählt wurde, muss eine Adresse eingegeben werden
	if(!isset($data_form['newsletter'])) {
		
		//Überprüfe Straße und Hausnummer auf korrektes Format (Straße ggf. mit Punkt abgekürzt, Hausnummer ggf. mit Buchstabe am Ende)
		if (!preg_match("/^[a-zäöüß]+[.]?[ ]{1}[0-9]+([a-zäöüß]{1})?/iu",$data_form['strasse'])) {
			$error = $error . "Die eingegebene Straße und Hausnummer ist ungültig.<br>\n";
		}
		
		if (!preg_match("/^[0-9]+$/",$data_form['plz'])) {
			$error = $error . "Als PLZ sind nur Ziffern erlaubt.<br>\n";
		}
		if($data_form['land'] == 'Deutschland') {
			if (!preg_match("/^[0-9]{5}$/",$data_form['plz'])) {
				$error = $error . "Keine korrekte deutsche PLZ.<br>\n";
			}
		}
		
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['ort'])) {
			$error = $error . "Als Ort sind nur Buchstaben erlaubt.<br>\n";
		}
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['land'])) {
			$error = $error . "Als Land sind nur Buchstaben erlaubt.<br>\n";
		}	
	}

	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
}








?>