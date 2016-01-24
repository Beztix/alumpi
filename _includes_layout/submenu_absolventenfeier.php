<?php

//======================================================================
// Diese PHP-Datei enthält das Sub-Navigationsmenü der Seite Absolventenfeier, das von der Datei navigation.php
// bei Bedarf eingebunden wird.
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
//======================================================================

?>	

<ul>
	<li>
		<a <?php if ($thisPage=="anmeldung_absolventenfeier") {echo " class=\"currentpage\"";} ?> href="../anmeldung_absolventenfeier/index.php">Anmeldung</a>
	</li>
</ul>