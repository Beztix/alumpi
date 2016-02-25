<!DOCTYPE html>
<html>

<?php
// Konstante, die in inkludierten PHP-Dateien abgefragt wird, um direkten Zugriff auf die inkludierten Datein zu verhindern
define('AccessConstant', TRUE);

session_start();
require '../_includes_functionality/global_constants.php';


$thisPage = 'startseite';
$title = 'AluMPI | Startseite';
$keywords = 'Startseite, Start, Willkommen, Begrüßung';
$description = 'Startseite mit allgemeinen Informationen zu AluMPI, dem Absolventen- und Förderverein MPI Uni Bayreuth e.V.';
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