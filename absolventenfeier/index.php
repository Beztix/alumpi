<!DOCTYPE html>
<html>

<?php
session_start();
require '../_includes_functionality/global_constants.php';


$thisPage = 'absolventenfeier';
$title = 'AluMPI | Absolventenfeier';
$keywords = 'x y z';
$description = 'page description';
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