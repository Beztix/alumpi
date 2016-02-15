<?php

//======================================================================
// Diese PHP-Datei enthält alle Funktionen, um die Formulareingaben auf der Homepage zu validieren.
// Die einzelnen Funktionen werden verwendet um zu überprüfen ob das jeweilige Formular vollständig 
// ausgefüllt wurde und ob die Eingaben dem gewünschten Format entsprechen (Email-Adresse, Datum o.ä.).
//======================================================================



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





?>