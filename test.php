<?php require_once ("base.php");
								@session_start();
								require_once "connect.php";
								$limit = 1;
								$limit_per_page= 3;
								
								$actual_page = !empty($_GET["actual_page"]) ? $_GET["actual_page"] : 1;
								if($actual_page > 0)
								{
									$limit = $limit_per_page *($actual_page - 1);
								}
								$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
								if ($polaczenie->connect_errno!=0)
								{
									echo "Error: ".$polaczenie->connect_errno;
								}
								else
								{
									$polaczenie->query("SET CHARSET utf8");
									$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
									
									$sql = $polaczenie->query("SELECT * FROM post ORDER BY id DESC LIMIT 3");
									
									while($row=mysqli_fetch_row($sql))
									{
										$row[3] = html_entity_decode($row[3], ENT_QUOTES, "UTF-8");
										$row[4] = html_entity_decode($row[4], ENT_QUOTES, "UTF-8");
										echo '<div class="col-lg-4" id="art">
												<div class="article"><div class="row>"><div class="col-lg-12"><a href="news.php?&id='.$row[0].' "> <h3 id="title">'.$row[3].'</h3></a></div>
												<div class="col-lg-12"><img src="uploads/'.$row[7].'"></img></div>
												<div class="col-lg-12"><p>' .substr ($row[4], 0, 250).'...<a href="news.php?id='.$row[0].'"> Czytaj więcej</a></p></div>
												<div class="col-lg-12"><h4>Autor: '.$row[1].' '.$row[2].'<br>Data: '.$row[5].'</h4></div></div></div></div>';
									}
									$total_pages = ceil($total_news / $limit_per_page);



if ($actual_page > 1)
{
/* W <a href> generujesz link do strony: ($actual_page - 1) <- poprzednia */
}


if ($actual_page < $total_pages)
{
 /* W <a href> generujesz link do strony: ($actual_page + 1) <- następna */
}
									}
?>