<?php

//======================================================================
// Diese PHP-Datei konfiguriert gloable Daten, die auf der gesamten Homepage zur Verfügung stehen sollen.
// Sie enthält v.a. Daten zur Absolventenfeier u.ä. die auf verschiedenen Unterseiten auftauchen, damit diese nicht
// einzeln geändert werden müssen.
// Diese Datei wird von jeder index.php eingebunden.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



	//Diese Variable definiert das Home-Verzeichnis, das außerhalb des öffentlich zugänglichen Webspaces liegen soll!
	//In diesem müssen sich die Ordner 'generated_files', 'config-files' und 'alumpiHP_libraries' mit den zugehörigen Dateien befinden.
	const HOME_DIRECTORY = '/home/alumpi/';


	
	const ERSTER_VORSTAND = 'Armin Kögel';
	

	//Diese Variable definiert, wie die Informationen zur Absolventenfeier auf der Homepage dargestellt werden
	//False: Es werden allgemeine Infos über die Absolventenfeier genannt
	//True: Es werden die konkreten Infos aus den nachfolgenden Variablen auf der Homepage dargestellt
	const ABSOLVENTENFEIER_INFO_AKTIV = False;
	
	const ABSOLVENTENFEIER_ORT = 'Foyer des NWII-Gebäudes';
	const ABSOLVENTENFEIER_DATUM = '23.06.2019';
	const ABSOLVENTENFEIER_ANMELDESCHLUSS = '09.06.2018';
	const ABSOLVENTENFEIER_UHRZEIT = '15:00';
	const ABSOLVENTENFEIER_PREIS = '32';
	const ABSOLVENTENFEIER_PREIS_LAUFKARTE = '15';
	
	
	//Diese Variable definiert, ob die Anmeldung zur Absolventenfeier aktuell freigeschaltet ist
	const ABSOLVENTENFEIER_ANMELDUNG_AKTIV = False;

	//Diese Variable definiert, ob die Anmeldung zur Jubilaeumsfeier aktuell freigeschaltet ist
	const JUBILAEUMSFEIER_ANMELDUNG_AKTIV = True;
	
	//Diese Variable definiert, ob Mitglieder ihre Anmeldedaten noch einsehen können, oder der Text "keine Anmeldung möglich" angezeigt wird
	//(Relevant für die Zeit nach Anmeldeschluss aber vor der Feier)
	const ABSOLVENTENFEIER_ANMELDEDATEN_SICHTBAR = False;
	
	


?>
