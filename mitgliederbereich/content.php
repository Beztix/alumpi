<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/banner_intern.jpg" alt="">
			</section>
			
			
			
			<section class="text">
		
				
				
	
				<?php
				

				//Wenn die Session-Variable "login" für den aktuellen User nicht gesetzt wurde, ist dieser nicht eingeloggt
				if (empty($_SESSION['login'])) {
				
					//Anzeigen des Login-Formulars
					include 'content_not_loggedin.php';
					
				}
				
				//Der User ist bereits eingelogged
				else {
					
					//Anzeigen des Content für eingeloggte User
					include 'content_loggedin.php';
				}
				
				
				//Abfrage einer GET-Variable, diese zeigt an dass der Nutzer aufgrund fehler Zugriffsrechte auf diese Seite umgeleitet wurde
				if(isset($_GET['status'])){
						if($_GET['status'] === 'no_permission') {
							echo "<br>\n";
							echo "<p class=\"error\">\n";
							echo "Sie verfügen nicht über die erforderlichen Zugriffsrechte, um die angeforderte Seite aufzurufen.<br>\n";
							echo "</p>\n";
						}
				}
				?>
				
			
			</section>
			
			
			
			
        </section>
		