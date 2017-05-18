<?php
	session_start();
	
	if ((!isset($_GET['id'])) || (!isset($_SESSION['zalogowany'])))
	{
		header('Location: ../my_post.php');
		exit();
	}
	$id_delete= $_GET['id'];
	
	require_once "../connect.php";
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)
		{
			echo "Error: ".$polaczenie->connect_errno;
		}
		else
		{
			if ($polaczenie->query("DELETE FROM post WHERE id='$id_delete'"))
					{
						header('Location: ../my_post.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
		}

?>