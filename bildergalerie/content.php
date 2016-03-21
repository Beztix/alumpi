<?php
//Abfrage der in den index.php definierten Konstante, um direkten Zugriff auf diese PHP-Datei zu verhindern
if(!defined('AccessConstant')) {die('Direct access not permitted');}
?>

		<section id="content">
		
		
			<?php 
			//Einbinden von auth.php, um diese Seite nur eingeloggten Mitgliedern zur Verfügung zu stellen
			require '../_includes_functionality/auth.php'; echo "\n"; 
			?>
		
		
			<section class="top_image">
				<img src="../_images_content/banner_absolventenfeier_party.jpg" alt="Party bei der Absolventenfeier">
			</section>
		
		
		
            <section class="text">

				<h1>Bildergalerie</h1>
				
				<p>
				Dies ist die interne Bildergalerie des Absolventenvereins.
				Hier finden sich die Fotos der Veranstaltungen des Vereins, v.a. der Absolventenfeiern.
				</p>
				<br>
				
				<article class="bildergalerie">
					<h3>Absolventenfeier 2015</h3>
					
					

					<!-- thumbnail image wrapped in a link -->
					<a href="#img1">
						<img class="absolventenbild" src="../_images_content/absolventenfeier15absolventen.jpg" alt="Gruppenbild Absolventen 2015">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img1">
						<img src="../_images_content/absolventenfeier15absolventen.jpg" alt="Gruppenbild Absolventen 2015">
					</a>

			
					<br>
					
					<a href="../_zips/absolventenfeier2015.zip">ZIP-Archiv</a>
					
				</article>
				
				
				
				<article class="bildergalerie">
					<h3>Absolventenfeier 2014</h3>
					
					
					<!-- thumbnail image wrapped in a link -->
					<a href="#img2">
						<img class="absolventenbild_links" src="../_images_content/absolventenfeier14absolventen1.jpg" alt="Gruppenbild 1 Absolventen 2014">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img2">
					  <img src="../_images_content/absolventenfeier14absolventen1.jpg" alt="Gruppenbild 1 Absolventen 2014">
					</a>
					
					<!-- thumbnail image wrapped in a link -->
					<a href="#img3">
						<img class="absolventenbild_rechts" src="../_images_content/absolventenfeier14absolventen2.jpg" alt="Gruppenbild 2 Absolventen 2014">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img3">
					  <img src="../_images_content/absolventenfeier14absolventen2.jpg" alt="Gruppenbild 2 Absolventen 2014">
					</a>
					
					
					<br style="clear:both">
				
					<a href="../_zips/absolventenfeier2014.zip">ZIP-Archiv</a>
					
				</article>
				
				
				
				<article class="bildergalerie">
					<h3>Absolventenfeier 2012</h3>
					
					<!-- thumbnail image wrapped in a link -->
					<a href="#img4">
						<img class="absolventenbild" src="../_images_content/absolventenfeier12absolventen.jpg" alt="Gruppenbild Absolventen 2012">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img4">
						<img src="../_images_content/absolventenfeier12absolventen.jpg" alt="Gruppenbild Absolventen 2012">
					</a>
				
				
					<br>
					
					<a href="../_zips/absolventenfeier2012.zip">ZIP-Archiv</a>
					
				</article>
				
				
				
				<article class="bildergalerie">
					<h3>Absolventenfeier 2011</h3>
					
					
					<!-- thumbnail image wrapped in a link -->
					<a href="#img5">
						<img class="absolventenbild" src="../_images_content/absolventenfeier11absolventen.jpg" alt="Gruppenbild Absolventen 2011">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img5">
						<img src="../_images_content/absolventenfeier11absolventen.jpg" alt="Gruppenbild Absolventen 2011">
					</a>
					
					
					<br>
					
					<a href="../_zips/absolventenfeier2011.zip">ZIP-Archiv</a>
					<br>
					<a href="https://tp14.smugmug.com/Events/Absolventenfeier-2011/n-vq3sk/">Online-Galerie</a>
					
				</article>
				
				
				
				<article class="bildergalerie">
					<h3>Absolventenfeier 2010</h3>
					
					<!-- thumbnail image wrapped in a link -->
					<a href="#img6">
						<img class="absolventenbild" src="../_images_content/absolventenfeier10absolventen.jpg" alt="Gruppenbild Absolventen 2010">
					</a>
					<!-- lightbox container hidden with CSS -->
					<a href="#_" class="lightbox" id="img6">
						<img src="../_images_content/absolventenfeier10absolventen.jpg" alt="Gruppenbild Absolventen 2010">
					</a>
				

					<br>
					
					<a href="../_zips/absolventenfeier2010.zip">ZIP-Archiv</a>
					<br>
					<a href="https://tp14.smugmug.com/Events/Absolventenfeier-2010/n-krHWt/">Online-Galerie</a>
					
				</article>
				
				

		
				
			</section>
			
			
			
			
			
			
        </section>
		