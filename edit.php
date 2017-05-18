<?php
	@session_start();
	if (!isset($_GET['id']))
	{
		header('Location: my_post.php');
		exit();
	}

	require('base.php'); ?>
<?php


	require_once "connect.php";
								$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
								if ($polaczenie->connect_errno!=0)
								{
									echo "Error: ".$polaczenie->connect_errno;
								}
								else
								{

									$id_news = $_GET['id'];
									$polaczenie->query("SET CHARSET utf8");
									$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
									$sql1 = $polaczenie->query("SELECT * FROM post WHERE id = '$id_news'");

									$row = mysqli_fetch_row($sql1);
									$_SESSION['id']=$id_news;
								}
 ?>
							<div class="col-xs-12 form">
								<a href="php/delete.php?&id=<?php echo $id_news ?>" id="delete_post">Usuń post</a>
								<form enctype="multipart/form-data" class="post"  action="php/edit_post.php" method="post" style="margin-left: 20px;">
									<label>Autor:<br />
									<input type="text" name="autor" value="<?php
										echo $_SESSION['user'];
										echo" ".$_SESSION['surname'];
									?>"disabled /></label><br />
									<label>Temat:<br /> <input type="text" name="temat" required/ value="<?php echo $row[3] ?>"></label><br />
									<?php
										if (isset($_SESSION['e_temat']))
										{
											echo '<div class="error">'.$_SESSION['e_temat'].'</div>';
											unset($_SESSION['e_temat']);
										}
									?>

									<label>Ważne? <input type="checkbox" name="wazne" ></label><br />
									<label>Treść postu:<br /><textarea name="nowy_post" rows="15" cols="100" maxlength="150000" required="required" autofocus><?php echo $row[4]  ?></textarea></label></br>
									<?php
										if (isset($_SESSION['e_npost']))
										{
											echo '<div class="error">'.$_SESSION['e_npost'].'</div>';
											unset($_SESSION['e_npost']);
										}
									?>
									<p>
									<span style="color: red;"><b>Ważne komendy:</b></span><br />
									&ltbr&gt - odstęp - &lt/br&gt <br />
									&ltb&gt<b> - pogrubienie - </b>&lt/b&gt <br />
									&lti&gt<i> - pochyła - </i>&lt/i&gt <br />
									&ltu&gt<u> - podkreślony - </u>&lt/u&gt <br />
									</p>
									<label>Data: <p style="border: 1px solid lightblue; padding: 1px; width: 80px;">
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
