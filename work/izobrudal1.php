<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>

	<body>

<?php

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();
   




$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
 
							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);
							//если для удаления фото
if (isset($_POST['udal']))
{
if(isset($_POST['dfile'])) //имя файла
{ 
$mass=$_POST["dfile"];
$qq=$mass[0];
$qq=htmlspecialchars($qq);
$fotodlyaudal=$folder.$qq;
unlink($fotodlyaudal);
echo $fotodlyaudal;
$query=$pdo->prepare("DELETE FROM fototabl WHERE loginp=? AND foto=? LIMIT 1");
$query->execute(array($login,$qq));
header("Location: izobrudal.php");
}
							//если не указано фото
else{
exit("фото не выбрано <a href='izobrudal.php'>повторить</a>");
}
}

							//сделать главной фотографией
else if (isset($_POST['glav'])) 
{
if(isset($_POST['dfile'])) 
{
$mass=$_POST["dfile"]; 
$qq=$mass[0];
$qq=htmlspecialchars($qq); 
$query=$pdo->prepare("UPDATE fototabl SET metka='' WHERE loginp=? AND metka='glav' LIMIT 1");
$query->execute(array($login)); 
$query=$pdo->prepare("UPDATE fototabl SET metka='glav' WHERE loginp=? AND foto=? LIMIT 1");
$query->execute(array($login,$qq)); 
header("Location: izobrudal.php");
}
							//если не указано фото
else
{
exit("фото не выбрано <a href='izobrudal.php'>повторить</a>");
}
}

						//отключить показ главной фотографии
else if (isset($_POST['pokaz'])) 
{
$query=$pdo->prepare("UPDATE fototabl SET metka='' WHERE loginp=? AND metka='glav' LIMIT 1");
$query->execute(array($login)); 
header("Location: index.php");
}


							//если для добавления описания к фото
else if (isset($_POST['opis'])) 
{
if(isset($_POST["dfile"]))
{ 
$mass=$_POST["dfile"];  
$qq=$mass[0];
$qq=htmlspecialchars($qq);
$textopis=$_POST["textopis"];
$textopis=trim($textopis);//убирает пробелы из начала и конца поля
$textopis=htmlspecialchars($textopis);
$query=$pdo->prepare("UPDATE fototabl SET opisanie=? WHERE loginp=? AND foto=? LIMIT 1");
$query->execute(array($textopis,$login,$qq));
header("Location: izobrudal.php");
}
							//если не указано фото
else
{
exit("фото не выбрано <a href='izobrudal.php'>повторить</a>");
}
}
				
?>
<a href='/modredpol/index.php'>На мою страницу</a>

</body>
</html>