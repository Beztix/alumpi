		<section id="content">
		
			<section class="top_image">
				<img src="../_images_content/man-looking-at-bookshelf.jpg" alt="man looking at bookshelf">
			</section>
			
			
			
			<section class="text">
		
				
	
				<?php
				//Wenn die Session-Variable "login" für den aktuellen User nicht gesetzt wurde, ist dieser nicht eingeloggt
				if (empty($_SESSION['login'])) {#
				
					//Anzeigen des Login-Formulars
					include 'login_form.php';
					
					//Einbinden der PHP-Datei zur Auswertung des Login-Formulars
					include '../_includes/login.php'; 
				}
				
				//Der User ist bereits eingelogged
				else {
					
					//Anzeigen des Content für eingeloggte User
					include 'loggedin_content.php';
				}
				?>
				
			
			</section>
			
			
			
			
        </section>
		