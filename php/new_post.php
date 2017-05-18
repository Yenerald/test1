<?php
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: ../index.php');
		exit();
	}
	
	require_once "../connect.php";
	
	
		$wszystko_OK=true;
		$user = $_SESSION['user'];
		$surname = $_SESSION['surname'];
		$temat = $_POST['temat'];
		$npost = $_POST['nowy_post'];
		$folder_upload="../uploads";
		$plik_nazwa= $_FILES['plik']['name'];
		$plik_lokalizacja=$_FILES['plik']['tmp_name']; //tymczasowa lokalizacja pliku
		$plik_mime=$_FILES['plik']['type']; //typ MIME pliku wysłany przez przeglądarkę
		$plik_rozmiar=$_FILES['plik']['size'];
		$plik_blad=$_FILES['plik']['error']; //kod błędu
		$temat = htmlentities($temat, ENT_QUOTES, "UTF-8");
		
		
		if (!isset($_POST['wazne']))
		{
			$wazne = 0;
		}
		else{
			$wazne = 1;
		}
		
		if (!$plik_lokalizacja) 
		{
			$wszystko_OK=false;
			$_SESSION['e_plik']= "Nie wysłano żadnego pliku" ;
		}
 
/* sprawdzenie błędów */
switch ($plik_blad) {
    case UPLOAD_ERR_OK:
        break;
    case UPLOAD_ERR_NO_FILE:
		$wszystko_OK=false;
        $_SESSION['e_plik'] ="Brak pliku.";
        break;
    case UPLOAD_ERR_INI_SIZE:
		$wszystko_OK=false;
    case UPLOAD_ERR_FORM_SIZE:
		$wszystko_OK=false;
        $_SESSION['e_plik'] ="Przekroczony maksymalny rozmiar pliku.";
        break;
    default:
		$wszystko_OK=false;
        $_SESSION['e_plik'] ="Nieznany błąd.";
        break;
}
 
/* sprawdzenie rozszerzenia pliku - dzięki temu mamy pewność, że ktoś nie zapisze na serwerze pliku .php */
$dozwolone_rozszerzenia=array("jpeg", "jpg", "tiff", "tif", "png", "gif");
$plik_rozszerzenie=pathinfo(strtolower($plik_nazwa), PATHINFO_EXTENSION);
if (!in_array($plik_rozszerzenie, $dozwolone_rozszerzenia, true)) {
   $wszystko_OK=false;
   $_SESSION['e_plik'] ="Niedozwolone rozszerzenie pliku.";
}
 
/* przeniesienie pliku z folderu tymczasowego do właściwej lokalizacji */
if (!move_uploaded_file($plik_lokalizacja, $folder_upload."/".$plik_nazwa)) {
    $wszystko_OK=false;
	$_SESSION['e_plik'] ="Nie udało się przenieść pliku.";
}
 
/* nie było błędów */
$_SESSION['n_plik'] ="Plik został zapisany.";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
			$polaczenie->query("SET CHARSET utf8");
            $polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			
			//Sprawdzanie długości tematu
			if ((strlen($temat)<3) || (strlen($temat)>50))
			{
				$wszystko_OK=false;
				$_SESSION['e_temat']='<p style="color:red;">Temat musi posiadać od 3 do 50 znaków!</p>';
			}
			
			//Sprawdzanie długości postu
			if ((strlen($npost)<50) || (strlen($npost)>11050))
			{
				$wszystko_OK=false;
				$_SESSION['e_npost']='<p style="color:red;">Post musi posiadać od 50 do 11050 znaków!</p>';
			}
			
			

			$rezultat = $polaczenie->query("SELECT id FROM post WHERE temat='$temat'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_postow = $rezultat->num_rows;
				if($ile_takich_postow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_npost']='<p style="color:red;">Istnieje już taki post!</p>';
				}		
			
		
			if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO post VALUES (NULL, '$user', '$surname', '$temat', '$npost', now(), '$wazne', '$plik_nazwa')"))
					{
						header('Location: ../index.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				else{
					header('Location: ../dodaj_post.php');
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o dodawanie postu w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
?>