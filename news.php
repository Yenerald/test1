<?php
	if (!isset($_GET['id']))
	{
		header('Location: index.php');
		exit();
	}
	require ('base.php')
?>
<?php
								@session_start();
								require_once "connect.php";
								$id_news = $_GET['id'];
								$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
								if ($polaczenie->connect_errno!=0)
								{
									echo "Error: ".$polaczenie->connect_errno;
								}
								else
								{



									$polaczenie->query("SET CHARSET utf8");
									$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
									$sql1 = $polaczenie->query("SELECT * FROM post WHERE id = '$id_news'");

									while($row = mysqli_fetch_row($sql1))
									{
									$row[3] = html_entity_decode($row[3], ENT_QUOTES, "UTF-8");
									$row[4] = html_entity_decode($row[4], ENT_QUOTES, "UTF-8");
									 echo '<div class="col-lg-12 post-article">
										<h3>'.$row[3].'</h3>
										<img src="uploads/'.$row[7].'"></img>
										<p>'.$row[4].'</p>
										<h4>Autor: '.$row[1].' '.$row[2].'
										<br>Data: '.$row[5].' </h4></div>';
									}
								}
?>
<?php
	require ('base1.php')
?>
