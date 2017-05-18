<?php 
session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	require ('base.php');
?>
<?php 
								@session_start();
								
								$user = $_SESSION['user'];
								$surname = $_SESSION['surname'];
								require_once "connect.php";
								$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
								if ($polaczenie->connect_errno!=0)
								{
									echo "Error: ".$polaczenie->connect_errno;
								}
								else
								{
									$polaczenie->query("SET CHARSET utf8");
									$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
									$sql = $polaczenie->query("SELECT * FROM post WHERE user='$user' AND surname='$surname' ORDER BY id DESC");
									
									echo '<div class="col-lg-12"><h2>Kliknij na post, który chcesz edytować!</h2></div>';
									while($row=mysqli_fetch_row($sql))
									{
										$row[3] = html_entity_decode($row[3], ENT_QUOTES, "UTF-8");
										$row[4] = html_entity_decode($row[4], ENT_QUOTES, "UTF-8");
										echo '<div class="col-lg-4">
												<div class="article"><a href="edit.php?page=news&id='.$row[0].'"><h3 id="title">'.$row[3].'</h3></a>
												<img src="uploads/'.$row[7].'"></img>
												<p>' .substr ($row[4], 0, 250).'...</p>
												<h4>Autor: '.$row[1].' '.$row[2].'<br>Data: '.$row[5].'</h4></div></div>';			
									}			
								}
									?>
<?php 
	require ('base1.php');
?>