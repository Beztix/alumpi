<?php

//======================================================================
//
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


function doesCurrentUserHaveAccess($foerderer_rechte, $mitglied_rechte, $orga_rechte, $kuratorium_rechte, $finanzer_rechte, $vorstand_rechte, $admin_rechte) {
	
	
	$zugriff_erlauben = False;
	
	//Foerderer sollen Zugriff haben und Nutzer ist Foerderer
	if($foerderer_rechte && $_SESSION['foerderer']) {
		$zugriff_erlauben = True;
	}
	
	//Mitglieder sollen Zugriff haben und Nutzer ist Mitglied
	if($mitglied_rechte && $_SESSION['mitglied']) {
		$zugriff_erlauben = True;
	}
	
	//Orga-Team soll Zugriff haben und Nutzer ist Orga-Team
	if($orga_rechte && $_SESSION['orga']) {
		$zugriff_erlauben = True;
	}
	
	//Kuratorium soll Zugriff haben und Nutzer ist Kuratoriums-Mitglied
	if($kuratorium_rechte && $_SESSION['kuratorium']) {
		$zugriff_erlauben = True;
	}
	
	//Finanzer sollen Zugriff haben und Nutzer ist Finanzer
	if($finanzer_rechte && $_SESSION['finanzer']) {
		$zugriff_erlauben = True;
	}
	
	//Vorstand soll Zugriff haben und Nutzer ist Finanzer
	if($vorstand_rechte && $_SESSION['vorstand']) {
		$zugriff_erlauben = True;
	}
	
	//Admin soll Zugriff haben und Nutzer ist Admin
	if($admin_rechte && $_SESSION['admin']) {
		$zugriff_erlauben = True;
	}
	

	
	return $zugriff_erlauben;
}
	
	
?>