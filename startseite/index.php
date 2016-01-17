<!DOCTYPE html>
<html>

<?php
session_start();
$thisPage = 'startseite';
$title = 'AluMPI | Startseite';
$keywords = 'x y z';
$description = 'page description';
?>

<?php require '../_includes/htmlheader.php'; echo "\n"; ?>



<body>
    
	
<?php require '../_includes/header.php'; echo "\n"; ?>


	<section id="main">
		
		
<?php require'../_includes/navigation.php'; echo "\n"; ?>
<?php include 'content.php'; echo "\n"; ?>


	</section>

		
<?php require '../_includes/footer.php'; echo "\n"; ?>


   
</body>
</html>