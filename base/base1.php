</div>
<div class="col-sm-6 col-lg-4 most-article">
<div class="row">
<div class="col-lg-12">
<h2>Najważniejsze wpisy</h2>
</div>
<?php
require_once "../connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if ($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno;
}
else
{
$polaczenie->query("SET CHARSET utf8");
$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
$sql = $polaczenie->query("SELECT * FROM post WHERE wazne=1 ORDER BY id DESC LIMIT 5");

while($row=mysqli_fetch_row($sql))
{
	echo '<div class="col-lg-12">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<a href="../news.php?page=news&id='.$row[0].'">
							<h3>'.$row[3].'</h3>
							<div class="col-lg-12"><img src="../uploads/'.$row[7].'"></img></div>
						</a>
						<div class="col-lg-12"><h4>Autor: <span>'.$row[1]." ".$row[2].'</span><br>Data: <span>'.$row[5].'</span></h4></div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<p>' .substr ($row[4], 0, 250).'...
							<a href="../news.php?id='.$row[0].'"> Czytaj więcej</a>
						</p>
					</div>
				</div>';}}?>
</div>
</div>
</div>
</div>
</section>
</main>
<footer>
<div class="container-fluid">
<div class="row">
<div class="col-lg-8 col-sm-8" >
<?php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
echo"Witaj <span>".$_SESSION['user'].'!</span> [ <a href="../php/logout.php">Wyloguj się!</a> ]';
echo '<br /><a href="../dodaj_post.php">Dodaj nowy post</a>';
echo '<br /><a href="../my_post.php">Zobacz swoje posty</a>';
}else
{
echo '<a href="../logowanie.php">Logowanie</a>';
}?>
</div>
<div class="col-lg-4 col-sm-4" >
<div class="information">
	<p>
	Hufiec ZHP Orneta
	<br>11-100 Lidzbark Warmiński
	<br>ul. Kardynała Stefana Wyszyńskiego 20
	<br>orneta@zhp.pl
	<br>Bank BGŻ 36 2030 0045 1110 0000 0219 4470
</p>
</div>
</div>
</div>
</div>
</footer>
</body>
</html>
