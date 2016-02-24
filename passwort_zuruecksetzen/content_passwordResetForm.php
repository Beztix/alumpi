<p>
Sie haben diese Seite über den in der E-Mail-Adresse angegebenen Link erreicht, um Ihr Passwort zurückzusetzen<br>
Geben Sie zum Setzen eines neuen Passworts dieses im untenstehenden Formular ein und klicken Sie auf "Passwort zurücksetzen".<br>
</p>


<?php
//Einbinden der PHP-Datei zur Formularauswertung
include 'process_passwordResetForm.php'; 
?>	

<form action="index.php" method="POST" name="reset_password">

	<table style="width:100%">
		<colgroup>
			<col style="width:30%;">
			<col style="width:70%;">
		</colgroup>
		
		<tr>
			<td>
				Passwort
			</td>
			<td>
				
			</td>
			<td>
				<input type="password" name="passwort" autocomplete="off" placeholder="Neues Passwort" size="25">
			</td>
		</tr>
								
		<tr>
			<td>
			
			</td>
			<td>
				
			</td>
			<td>
				<input type="password" name="passwort2" autocomplete="off" placeholder="Neues Passwort wiederholen" size="25">
			</td>
		</tr>
		
	</table>
	<br>
	<button class="absenden" type="submit">E-Mail Versenden</button>

</form>	
