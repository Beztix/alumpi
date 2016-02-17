<?php

//======================================================================
// Diese PHP-Datei enthält den PHP-Code zum Logout für Mitglieder.
// Sie wird von der entsprechenden Seite der Homepage "Logout" eingebunden. 
// Die zur Identifikation eingeloggter Nutzer verwendete Session-Variable wird gelöscht.
//======================================================================

	session_start(); 
	session_destroy();
	unset($_SESSION);
    session_regenerate_id(true);
	header('Location: ../mitgliederbereich/index.php');
?>