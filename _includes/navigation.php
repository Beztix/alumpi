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
					//Submenü des Mitgliederbereichs wird nur angezeigt wenn der Nutzer eingelogged ist UND sich auf einer Seite des Mitgliederbereichs befindet
					if (!empty($_SESSION['login']) and (
						$thisPage=="mitgliederbereich" or 
						$thisPage=="bildergallerie" or
						$thisPage=="datenabfrage" or
						$thisPage=="logout")) 
						{				
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
		