<?php


// ‹berpr¸ft, ob alle im Registrierungs-Formular benˆtigten Felder korrekt ausgef¸llt wurden
// Gibt einen leeren String zur¸ck falls ja oder gibt die Fehlermeldungen zur¸ck falls nein
function check_required_fields_register() {
	$error = "";
	
	// ¸berpr¸fe alle zwingend notwendigen Textfelder
	
	if(empty($_POST['vorname'])) {
		$error = $error . "Es wurde kein Vorname eingegeben.<br>\n";
	}
	if(empty($_POST['nachname'])) {
		$error = $error . "Es wurde kein Nachname eingegeben.<br>\n";
	}
	if(empty($_POST['geburtsdatum'])) {
		$error = $error . "Es wurde kein Geburtsdatum eingegeben.<br>\n";
	}
	if(empty($_POST['email'])) {
		$error = $error . "Es wurde keine Email-Adresse eingegeben.<br>\n";
	}
	if(empty($_POST['kontoinhaber'])) {
		$error = $error . "Es wurde kein Kontoinhaber eingegeben.<br>\n";
	}
	if(empty($_POST['iban'])) {
		$error = $error . "Es wurde keine IBAN eingegeben.<br>\n";
	}
	if(empty($_POST['bic'])) {
		$error = $error . "Es wurde keine BIC eingegeben.<br>\n";
	}
	
	
	// falls die Checkbox "newsletter" ausgew‰hlt wurde, muss eine Adresse eingegeben werden
	
	if(isset($_POST['newsletter'])) {
		
		if(empty($_POST['strasse'])) {
			$error = $error . "Es wurde keine Straﬂe eingegeben.<br>\n";
		}
		if(empty($_POST['plz'])) {
			$error = $error . "Es wurde keine PLZ eingegeben.<br>\n";
		}	
		if(empty($_POST['ort'])) {
			$error = $error . "Es wurde kein Ort eingegeben.<br>\n";
		}
		if(empty($_POST['land'])) {
			$error = $error . "Es wurde kein Land eingegeben.<br>\n";
		}		
	}

	// Gib die Fehlermeldungen zur¸ck, leer falls alles ok.
	return $error;
}




function clean_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>