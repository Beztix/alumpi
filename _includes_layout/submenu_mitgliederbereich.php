<?php

//======================================================================
// Diese PHP-Datei enthält das Sub-Navigationsmenü des Mitgliederbereichs, das von der Datei naviagtion.php
// bei Bedarf eingebunden wird.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}


?>	

<ul>
	<li>
		<a <?php if ($thisPage=="anmeldung_feier_absolvent") {echo " class=\"currentpage\"";} ?> href="../anmeldung_feier_absolvent/index.php">Anmeldung zur Absolventenfeier</a>
	</li>
	<li>
		<a <?php if ($thisPage=="bildergalerie") {echo " class=\"currentpage\"";} ?> href="../bildergalerie/index.php">Bildergalerie</a>
	</li>
	<li>
		<a <?php if ($thisPage=="datenabfrage") {echo " class=\"currentpage\"";} ?> href="../datenabfrage/index.php">Datenabfrage</a>
	</li>
	<li>
		<a <?php if ($thisPage=="logout") {echo " class=\"currentpage\"";} ?> href="../logout/index.php">Logout</a>
	</li>
</ul>