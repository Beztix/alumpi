<?php

//======================================================================
// Diese PHP-Datei dient der Authentifizierung. 
// Sie muss von jeder Seite eingebunden wurden, die gegen den Zugriff nicht eingeloggter Nutzer geschützt werden soll.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}

	include_once 'calculateAccessPermissions.php';

	//Session ID erneuern um Angriff über Session Fixation zu verhindern
	session_regenerate_id();
 
	//Wenn die Session-Variable "login" für den aktuellen User nicht gesetzt wurde, ist dieser nicht eingeloggt: Weiterleiten auf die Login-Seite
	if (empty($_SESSION['login'])) {
		header('Location: ../mitgliederbereich/index.php');
		exit;
	}
	
	
	//Nutzer ist eingelogged, Test auf in der Seite selbst gesetzte Zugriffrechte
	$zugriff_erlauben = doesCurrentUserHaveAccess($foerderer_zugriff, $mitglied_zugriff, $orga_zugriff, $kuratorium_zugriff, $finanzer_zugriff, $vorstand_zugriff, $admin_zugriff);
	
	
	
	//Wenn aufgrund der Zugriffsrechte kein Zugriff erlaubt werden soll: Weiterleiten auf Mitgliederbereich-Startseite, Anzeigen einer Fehlermeldung
	if(!$zugriff_erlauben) {
		header('Location: ../mitgliederbereich/index.php?status=no_permission');
		exit;
	}
	
	
	
?>