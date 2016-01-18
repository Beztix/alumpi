<?php

//======================================================================
// Diese PHP-Datei enthält das Navigationsmenü der Webseite, das auf jeder Seite der Homepage enthalten ist.
// Sie wird von der jeweiligen index.php eingebunden. 
// Über die in der index.php belegten PHP-Variable thisPage wird die aktuelle Seite identifiziert, ihr wird eine 
// entsprechende CSS-Klasse zugewiesen um sie mittels CSS hervorheben zu können.
// Bei Bedarf werden entsprechende Submenüs eingebunden.
//======================================================================

?>		




		<nav id="navigation">
			<ul>
				<li>
					<a <?php if ($thisPage=="startseite") {echo " class=\"currentpage\"";} ?>  href="../startseite/index.php">Startseite</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="absolventenfeier") {echo " class=\"currentpage\"";} ?> href="../absolventenfeier/index.php">Absolventenfeier</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="mitgliedsantrag") {echo " class=\"currentpage\"";} ?> href="../mitgliedsantrag/index.php">Mitgliedsantrag</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="mitgliederbereich") {echo " class=\"currentpage\"";} ?> href="../mitgliederbereich/index.php">Mitgliederbereich</a>
					<?php
					//Submenü des Mitgliederbereichs wird nur angezeigt wenn der Nutzer eingelogged ist
					if (!empty($_SESSION['login'])) {				
						include '../_includes/submenu_mitgliederbereich.php';
					} 
					?>
				</li>
				
				<li>
					<a <?php if ($thisPage=="testseite") {echo " class=\"currentpage\"";} ?> href="../testseite/index.php">Testseite</a>
				</li>
				
				<li>
					<a <?php if ($thisPage=="kontakt") {echo " class=\"currentpage\"";} ?> href="../kontakt/index.php">Kontakt</a>
				</li>
			</ul>
		</nav>
		