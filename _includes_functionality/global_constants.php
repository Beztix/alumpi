<?php

//======================================================================
// Diese PHP-Datei konfiguriert gloable Daten, die auf der gesamten Homepage zur Verfügung stehen sollen.
// Sie enthält v.a. Daten zur Absolventenfeier u.ä. die auf verschiedenen Unterseiten auftauchen, damit diese nicht
// einzeln geändert werden müssen.
// Diese Datei wird von jeder index.php eingebunden.
//======================================================================


	//Diese Variable definiert, wie die Informationen zur Absolventenfeier auf der Homepage dargestellt werden
	//False: Es werden allgemeine Infos über die Absolventenfeier genannt
	//True: Es werden die konkreten Infos aus den nachfolgenden Variablen auf der Homepage dargestellt
	const ABSOLVENTENFEIER_INFO_AKTIV = True;
	
	const ABSOLVENTENFEIER_ORT = 'Foyer des NWII-Gebäudes';
	const ABSOLVENTENFEIER_DATUM = '18.06.2016';
	const ABSOLVENTENFEIER_ANMELDESCHLUSS = '04.06.2016';
	const ABSOLVENTENFEIER_UHRZEIT = '15:00';
	const ABSOLVENTENFEIER_PREIS = '22';
	
	
	
	
	//Diese Variable definiert, ob die Anmeldung zur Absolventenfeier aktuell freigeschaltet ist
	const ABSOLVENTENFEIER_ANMELDUNG_AKTIV = True;

?>