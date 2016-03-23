<?php

//======================================================================
// Diese PHP-Datei konfiguriert gloable Daten, die auf der gesamten Homepage zur Verfügung stehen sollen.
// Sie enthält v.a. Daten zur Absolventenfeier u.ä. die auf verschiedenen Unterseiten auftauchen, damit diese nicht
// einzeln geändert werden müssen.
// Diese Datei wird von jeder index.php eingebunden.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}



	//Diese Variable definiert, wie die Informationen zur Absolventenfeier auf der Homepage dargestellt werden
	//False: Es werden allgemeine Infos über die Absolventenfeier genannt
	//True: Es werden die konkreten Infos aus den nachfolgenden Variablen auf der Homepage dargestellt
	const ABSOLVENTENFEIER_INFO_AKTIV = True;
	
	const ABSOLVENTENFEIER_ORT = 'Foyer des NWII-Gebäudes';
	const ABSOLVENTENFEIER_DATUM = '11.06.2016';
	const ABSOLVENTENFEIER_ANMELDESCHLUSS = '28.05.2016';
	const ABSOLVENTENFEIER_UHRZEIT = '15:00';
	const ABSOLVENTENFEIER_PREIS = '25';
	
	
	
	
	//Diese Variable definiert, ob die Anmeldung zur Absolventenfeier aktuell freigeschaltet ist
	const ABSOLVENTENFEIER_ANMELDUNG_AKTIV = True;

?>