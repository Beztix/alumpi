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


// Überprüft, ob alle im Registrierungs-Formular benötigten Felder ausgefüllt wurden
// Gibt einen leeren String zurück falls ja oder gibt die Fehlermeldungen zurück falls nein

function check_required_fields_passwordReset($data_form) {
	$error = "";
	
	if(empty($data_form['passwort'])) {
		$error = $error . "Bitte geben Sie ihr neues Passwort ein.<br>\n";
	}
	if(empty($data_form['passwort2'])) {
		$error = $error . "Bitte wiederholen Sie ihr eingegebenes Passwort im zweiten Feld.<br>\n";
	}

	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
}





// Überprüft, ob der Inhalt aller im Registrierungs-Formular benötigten Felder korrekt formatiert ist
// Gibt einen leeren String zurück falls ja oder gibt die Fehlermeldungen zurück falls nein

function check_fields_format_passwordReset($data_form) {
	$error = "";
	
	if(!($data_form['passwort'] === $data_form['passwort2'])) {
		$error = $error . "Das eingegebene neue Passwort stimmt nicht mit der Passworteingabe im Kontrollfeld überein. Bitte geben Sie das Passwort in beide Felder ein, um fehlerhafte Änderungen zu vermeiden.<br>\n";
	}
	else {
		if(strlen($data_form['passwort']) < 6) {
			$error = $error . "Das neue Passwort muss mindestens 6 Zeichen lang sein.<br>\n";
		}
	}
	

	// Gib die Fehlermeldungen zurück, leer falls alles ok.
	return $error;
}








?>