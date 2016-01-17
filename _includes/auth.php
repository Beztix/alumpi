<?php
	//Session ID erneuern um Angriff über Session Fixation zu verhindern
	session_regenerate_id();
 
	echo "this is auth.php <br>";
	print_r($_SESSION);
 
	if (empty($_SESSION['login'])) {
		header('Location: ../mitgliederbereich/index.php');
		exit;
	} else {
		$login_status = '
			<div style="border: 1px solid black">
				Sie sind als <strong>' . htmlspecialchars($_SESSION['user']['username']) . '</strong> angemeldet.<br />
				<a href="./logout.php">Sitzung beenden</a>
			</div>
		';
	}
?>