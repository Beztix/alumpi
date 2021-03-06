<!DOCTYPE html>
<html>

<?php
// Konstante, die in inkludierten PHP-Dateien abgefragt wird, um direkten Zugriff auf die inkludierten Datein zu verhindern
define('AccessConstant', TRUE);

session_start();
require '../_includes_functionality/global_constants.php';


$thisPage = 'absolventenfeier_anmeldung_gast';
$title = 'AluMPI | Anmeldung als Gast zur Absolventenfeier';
$keywords = 'Absolventenfeier, Anmeldung, Abschluss, Party, Urkunde, Buffet, Teilnahme, Gast, Fakultätsangehöriger';
$description = 'Anmeldung zur Absolventenfeier der Fakultät I der Uni Bayreuth als Gast';
?>

<?php require '../_includes_layout/htmlheader.php'; echo "\n"; ?>



<body>
    
	
<?php require '../_includes_layout/header.php'; echo "\n"; ?>


	<section id="main">
		
		
<?php require'../_includes_layout/navigation.php'; echo "\n"; ?>
<?php include 'content.php'; echo "\n"; ?>


	</section>

		
<?php require '../_includes_layout/footer.php'; echo "\n"; ?>


   
</body>
</html>