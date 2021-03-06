﻿<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



// Einbinden der PHP-Datei mit allgemeinen Validierungs-Funktionen
include_once '../_includes_functionality/global_formValidation.php';



function check_requiredFields_partyRegistrationAsGraduate($data_form) {
	
	$error = "";
	
	if(empty($data_form['vorname'])) {
		$error = $error . "Es wurde kein Vorname eingegeben.<br>\n";
	}
	if(empty($data_form['nachname'])) {
		$error = $error . "Es wurde kein Nachname eingegeben.<br>\n";
	}
	if(empty($data_form['email'])) {
		$error = $error . "Es wurde keine Email-Adresse eingegeben.<br>\n";
	}
	
	if(empty($data_form['anzahl_gaeste']) && !($data_form['anzahl_gaeste'] == '0')) {
		$error = $error . "Die Anzahl der Gäste wurde nicht eingegeben.<br>\n";
	}
	
	if(empty($data_form['abschlussarbeitsthema'])) {
		$error = $error . "Der Titel der Abschlussarbeit wurde nicht eingegeben.<br>\n";
	}
	
	if(empty($data_form['lehrstuhl'])) {
		$error = $error . "Es wurde kein Lehrstuhl ausgewählt.<br>\n";
	}
	
	if(empty($data_form['studiengang'])) {
		$error = $error . "Es wurde kein Studiengang ausgewählt.<br>\n";
	}
	
	if(empty($data_form['neuer_titel'])) {
		$error = $error . "Es wurde kein erworbener Titel ausgewählt.<br>\n";
	}
	
	if(empty($data_form['studienbeginn'])) {
		$error = $error . "Es wurde kein Beginn des Studiums ausgewählt.<br>\n";
	}
	
	if(empty($data_form['studienabschluss'])) {
		$error = $error . "Es wurde kein Abschlussdatum eingegeben.<br>\n";
	}
	
	
	return $error;
}




function check_fieldsFormatting_partyRegistrationAsGraduate($data_form) {

	$error ="";
	
	// Überprüfe ob die Namensfelder nur Buchstaben enthalten
	if (!preg_match("/^[a-zäöüß-]+$/iu",$data_form['vorname'])) {
		$error = $error . "Als Vorname sind nur Buchstaben erlaubt.<br>\n";
	}
	if (!preg_match("/^[a-zäöüß-]+$/iu",$data_form['nachname'])) {
		$error = $error . "Als Nachname sind nur Buchstaben erlaubt.<br>\n";
	}
	
	// Überprüfe die Email-Adresse auf korrektes Format
	if (!filter_var($data_form['email'], FILTER_VALIDATE_EMAIL)) {
		$error = $error . "Die eingegebene Email-Adresse ist ungültig.<br>\n";
	}
	
	// Überprüfe, ob die Anzahl Gäste nur aus einer Zahl besteht
	if (!preg_match("/^[0-9]+$/iu",$data_form['anzahl_gaeste'])) {
		$error = $error . "Als Anzahl an Gästen sind nur Ziffern erlaubt.<br>\n";
	}
	
	// Überprüfe das Abschlussdatum auf korrektes Format
	if (!isValidDate($data_form['studienabschluss'])) {
		$error = $error . "Das eingegebene Abschlussdatum ist kein korrektes Datum. Die Eingabe muss die Form TT.MM.JJJJ haben.<br>\n";
	}
	
	return $error;
}


function check_required_fields_additional_register($data_form) {
	$error = "";
	
	// überprüfe alle zwingend notwendigen Textfelder
	
	if(empty($data_form['geburtstag'])) {
		$error = $error . "Es wurde kein Geburtsdatum eingegeben.<br>\n";
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
	
	
	// falls die Checkbox "newsletter" nicht ausgewählt wurde, muss eine Adresse eingegeben werden
	if(isset($data_form['newsletter'])) {
		
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


function check_fields_format_additional_register($data_form) {
	$error = "";
	
	// Überprüfe das Geburtsdatum auf korrektes Format
	if (!isValidDate($data_form['geburtstag'])) {
		$error = $error . "Das eingegebene Geburtsdatum ist kein korrektes Datum. Die Eingabe muss die Form TT.MM.JJJJ haben.<br>\n";
	}
	
	// Überprüfe die IBAN
	if (!checkIBAN($data_form['iban'])) {
		$error = $error . "Die eingegebene IBAN ist ungültig.<br>\n";
	}
	
	// Überprüfe die BIC
	if (!checkBIC($data_form['bic'])) {
		$error = $error . "Die eingegebene BIC ist ungültig.<br>\n";
	}
	
	
	// falls die Checkbox "newsletter" nicht ausgewählt wurde, muss eine Adresse eingegeben werden
	if(isset($data_form['newsletter'])) {
		
		//Straße und Hausnummer überprüfen macht keinen Sinn (Zu viele Ausnahmefälle)
		
		if (!preg_match("/^[0-9]+$/",$data_form['plz'])) {
			$error = $error . "Als PLZ sind nur Ziffern erlaubt.<br>\n";
		}
		if($data_form['land'] === 'Deutschland') {
			if (!preg_match("/^[0-9]{5}$/",$data_form['plz'])) {
				$error = $error . "Keine korrekte deutsche PLZ.<br>\n";
			}
		}
		
		if($data_form['land'] === 'Deutschland') {
			if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['ort'])) {
				$error = $error . "Als Ort sind nur Buchstaben erlaubt.<br>\n";
			}
		}
		if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['land'])) {
			$error = $error . "Als Land sind nur Buchstaben erlaubt.<br>\n";
		}	
	}

	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
}




?>