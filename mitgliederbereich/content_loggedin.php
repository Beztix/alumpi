<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

				Sie sind nun im Mitgliederbereich eingelogged.
				<br>
				<div id="submenu_in_content">
				<?php 
				include '../_includes_layout/submenu_mitgliederbereich.php';
				?>
				</div>