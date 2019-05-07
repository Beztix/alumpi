<?php

//======================================================================
// Diese PHP-Datei enthält das Sub-Navigationsmenü der Seite Absolventenfeier, das von der Datei navigation.php
// bei Bedarf eingebunden wird.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


?>	

<ul>
	<li>
		<a <?php if ($thisPage=="absolventenfeier_anmeldeinformationen") {echo " class=\"currentpage\"";} ?> href="../absolventenfeier_anmeldeinformationen/index.php">Anmeldeinformationen</a>
	</li>
	<?php
	//Unterseiten zur Anmeldung werden nur angezeigt wenn die Anmeldung aktiv ist
	if(ABSOLVENTENFEIER_ANMELDUNG_AKTIV) {
		include 'submenu_absolventenfeier_anmeldung.php';
	}
	?>
	<li>
		<a <?php if ($thisPage=="absolventengalerie") {echo " class=\"currentpage\"";} ?> href="../absolventengalerie/index.php">Absolventengalerie</a>
	</li>
</ul>