<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: dodaj_post.php');
		exit();
	}

?>
<?php require('base.php'); ?>
		
	<form action="php/zaloguj.php" method="post" style="margin-left: 20px;">
	
		E-mail: <br /> <input type="text" name="email" autofocus /> <br />
		Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
		<input type="submit" value="Zaloguj się" />
	
	</form>

<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

<?php require('base1.php'); ?>