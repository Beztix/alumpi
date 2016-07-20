<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}




// Überprüft, ob der übergebene String eine korrekte IBAN ist (Format und Checksumme stimmen).
// Gibt true zurück falls ja oder gibt false zurück falls nein

function checkIBAN($iban) {
 
  // Normalize input (remove spaces and make upcase)
  $iban = strtoupper(str_replace(' ', '', $iban));
 
  if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {
    $country = substr($iban, 0, 2);
    $check = intval(substr($iban, 2, 2));
    $account = substr($iban, 4);
 
    // To numeric representation
    $search = range('A','Z');
    foreach (range(10,35) as $tmp)
      $replace[]=strval($tmp);
    $numstr=str_replace($search, $replace, $account.$country.'00');
 
    // Calculate checksum
    $checksum = intval(substr($numstr, 0, 1));
    for ($pos = 1; $pos < strlen($numstr); $pos++) {
      $checksum *= 10;
      $checksum += intval(substr($numstr, $pos,1));
      $checksum %= 97;
    }
 
    return ((98-$checksum) == $check);
  } else
    return false;
}




// Überprüft, ob der übergebene String eine korrekte BIC ist (Format mittels Regex).
// Gibt true zurück falls ja oder gibt false zurück falls nein

function checkBIC($bic) {
	
	if(preg_match("/^[a-zA-Z]{6}[0-9a-zA-Z]{2}([0-9a-zA-Z]{3})?$/",$bic)) {
		return true;
	}
	else {
		return false;
	}
	
}





function isValidDate($date) {
	if (!preg_match("/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$/",$date)) {
		return false;
	}
	else {
		if(!strtotime($date)) 
		{ 
			return false;
		}
		else {
			list($day, $month, $year) = explode('.', $date); 
			if(!checkdate($month, $day, $year)) {
				return false;
			}
			else {
				return true;
			}
		}
	}
}








?>