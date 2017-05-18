<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
	if (isset($_SESSION['fr_surname'])) unset($_SESSION['fr_surname']);
	if (isset($_SESSION['fr_blad'])) unset($_SESSION['fr_blad']);

	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if (isset($_SESSION['e_surname'])) unset($_SESSION['e_surname']);


?>
<?php require('base.php'); ?>
							<div class="col-xs-12 form">
								<form enctype="multipart/form-data" class="post"  action="php/new_post.php" method="post">
									<label>Autor:<br />
									<input type="text" name="autor" value="<?php
										echo $_SESSION['user'];
										echo" ".$_SESSION['surname'];
									?>"disabled /></label><br />
									<label>Temat:<br /> <input type="text" name="temat" required/></label><br />
									<?php
										if (isset($_SESSION['e_temat']))
										{
											echo '<div class="error">'.$_SESSION['e_temat'].'</div>';
											unset($_SESSION['e_temat']);
										}
									?>
									<label>Ważne? <input type="checkbox" name="wazne" ></label><br />
									<label>Treść postu:<br /><textarea name="nowy_post" maxlength="150000" required="required" autofocus></textarea></label></br>
									<?php
										if (isset($_SESSION['e_npost']))
										{
											echo '<div class="error">'.$_SESSION['e_npost'].'</div>';
											unset($_SESSION['e_npost']);
										}
									?>
									<label>Data: <p>
									<?php
										$dataczas = new DateTime();
										echo $dataczas->format('Y-m-d');
									?>
									</p></label>
									</br>
									<input type="hidden" name="MAX_FILE_SIZE" value="30000002123421" />
									<label><input type="file" name="plik" /></label>
									<?php
										if (isset($_SESSION['e_plik']))
										{
											echo '<div class="error">'.$_SESSION['e_plik'].'</div>';
											unset($_SESSION['e_plik']);
										}


									?>
									<br /><input type="submit" value="Wyślij" />
								</form>

							</div>
<?php require('base1.php'); ?>
