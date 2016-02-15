<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================

// Einbinden der PHP-Datei mit allgemeinen Validierungs-Funktionen
include_once '../_includes_functionality/global_formValidation.php';



function check_requiredFields_partyRegistrationAsGraduate($data_form) {
	
	$error = "";
	
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


?>