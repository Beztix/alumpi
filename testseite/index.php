<!DOCTYPE html>
<html>

<?php
$title = 'AluMPI | Testseite';
$keywords = 'x y z';
$description = 'page description';
?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/theme/htmlheader.php'; echo "\n"; ?>



<body>
    <div id="rahmen">
	
<?php require $_SERVER['DOCUMENT_ROOT'] . '/theme/header.php'; echo "\n"; ?>


		<div id="main">
		
		
<?php require $_SERVER['DOCUMENT_ROOT'] . '/theme/navigation.php'; echo "\n"; ?>
<?php include 'content.php'; echo "\n"; ?>


		</div>

		
<?php require $_SERVER['DOCUMENT_ROOT'] . '/theme/footer.php'; echo "\n"; ?>


    </div>
</body>
</html>