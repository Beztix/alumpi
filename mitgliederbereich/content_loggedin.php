<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				Sie sind nun im Mitgliederbereich eingelogged.
				<br>
				<br>
				<div id="submenu_in_content">
				<?php 
				include '../_includes_layout/submenu_mitgliederbereich.php';
				?>
				</div>
				
				<br>
				<br>
				
				<p class="green">
				<?php
				if($_SESSION['foerderer']) {
					echo "Sie haben Förderer-Zugriffsrechte.<br>\n";
				}
				if($_SESSION['orga']) {
					echo "Sie haben Orga-Team-Zugriffsrechte.<br>\n";
				}
				if($_SESSION['kuratorium']) {
					echo "Sie haben Kuratoriums-Zugriffsrechte.<br>\n";
				}
				if($_SESSION['finanzer']) {
					echo "Sie haben Finanzer-Zugriffsrechte.<br>\n";
				}
				if($_SESSION['vorstand']) {
					echo "Sie haben Vorstands-Zugriffsrechte.<br>\n";
				}
				if($_SESSION['admin']) {
					echo "Sie haben Admin-Zugriffsrechte.<br>\n";
				}
				?>
				</p>