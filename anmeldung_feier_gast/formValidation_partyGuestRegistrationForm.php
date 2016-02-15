<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================



function check_requiredFields_partyRegistrationAsGuest($data_form) {
	
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
	
	
	return $error;
}




function check_fieldsFormatting_partyRegistrationAsGuest($data_form) {

	$error ="";
	
	// Überprüfe ob die Namensfelder nur Buchstaben enthalten
	if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['vorname'])) {
		$error = $error . "Als Vorname sind nur Buchstaben erlaubt.<br>\n";
	}
	if (!preg_match("/^[a-zäöüß]+$/iu",$data_form['nachname'])) {
		$error = $error . "Als Nachname sind nur Buchstaben erlaubt.<br>\n";
	}
	
	// Überprüfe die Email-Adresse auf korrektes Format
	if (!filter_var($data_form['email'], FILTER_VALIDATE_EMAIL)) {
		$error = $error . "Die eingegebene Email-Adresse ist ungültig.<br>\n";
	}
	
	return $error;
}


?>