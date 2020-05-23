<!DOCTYPE html>
<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>	
<head>
<title>	Знакомства</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<script src="zaloba.js"></script>
<script src="vdruzya.js"></script>
<script src="izdruzey.js"></script>
<script src="blacklist.js"></script>
<script src="zgaloba.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>

<div class="column1">
<span class='imyasayta'><?php echo IMYASAYTA;?></span>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblema'/></a>
<?php

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода 

							//проверка на блокировку
blocked($login,$pdo);

							//внесение в онлайн
online($login,$pdo);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
			
							//Функция при открытии проверяет наличие логина и совпадение парол и логина
($login,$ip,$pdo);

$metkap=$_SESSION['metkap'];   //метка пользователя входит в переменную 

							//если поиск пользователя и сюда переход по ссылке со стр drug.php
if(isset($_GET["ipd"])) 
{ 
$ipd=$_GET["ipd"];
$login_q= iznomera($ipd,$pdo);
$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$_SESSION['login_q']=$login_q; 
}
							//если существует сессия login_q
else if(isset($_SESSION['login_q'])){
$login_q=$_SESSION['login_q'];
$login_q=htmlspecialchars($login_q);
}
							//если существует id????????????
else if(isset($_GET['id']))
{
$n=$_GET['id'];
$n=trim($n);//убирает пробелы из начала и конца поля
$n=htmlspecialchars($n);
$login_q= iznomera($n,$pdo);
$_SESSION['login_q']=$login_q; 
}
							//если не поступил логин друга
else
{
header("location:index.php");
}

//  если есть в таблице значит закрыт профиль от всех кроме друзей
metkidlyadruzey($login,$login_q,$pdo);


							//помещает меня в список его гостей							
vgosti($login,$login_q,$pdo);

							//показывает онлайн
 $isonline=isonline($login_q,$pdo);

	//получаем личные данные по логину
$lich1=dataFromLogin($login_q,$pdo);
while($line=$lich1->fetch(PDO::FETCH_LAZY))
{
$imya_q=$line->imya;
$region_q=$line->region;
$gorod_q=$line->gorod;
$datarozd_q=$line->datarozd;
$vozrast_q=$line->vozrast;
$metka_q=$line->metkap;
$ipp_q=$line->ipp;
$limitfoto_q=$line->limitfoto;
$osebe_q=$line->osebe;
}

echo"<div class='block1'>";

	//показывает главное фото
$glavfoto=glavfoto($login_q,$pdo);
  echo"<img  class='glavfoto' src='$glavfoto' />";
echo"<p>Имя <span class='svoidannie'>$imya_q</span></p>";
if(($metka_q==$metkap)&&($metkap!='0')){echo"<p><span class='svoidannie'>Из Вашей группы</span></p>";}
else if(($metka_q!=$metkap)&&($metkap!='0')){echo"<p><span class='svoidannie'>Не из вашей группы</span></p>";}

echo"<p>О себе <span class='svoidannie'>$osebe_q</span></p>";

echo"</div>";//END block1
?>

<div class='block1'>
<p><a href='soobsheniya.php' class='lichnoe'>Отправить сообщение</a></p>

<p><a href='#' onclick='vdruzya();return false;' class='lichnoe'>Добавить в друзья</a></p>

<p><a href='#' onclick='izdruzey();return false;' class='lichnoe'>Удалить из друзей</a></p>

<p><a href='#' onclick='blacklist();return false;' class='lichnoe'>Заблокировать</a></p>

<p><a href='#' onclick='zaloba();return false();' class='lichnoe'>Пожаловаться</a></p>

<p><a href='index.php' class='naglavnuyu'>На мою страницу</a></p>
</div>
</div>
<div class="column2">

<?php
echo"<div class='block2'>";

							//выбор и вывод  всех фото по логину
$query=$pdo->prepare("SELECT foto FROM fototabl WHERE loginp=?");
$query->execute(array($login_q)); 
while($line=$query->fetch(PDO::FETCH_LAZY))
{
$fotka=$folder1.$line[0];

if(isset($fotka))
{
echo"<img  src='$fotka'>";
}
}
echo"</div>";//END block2

echo"<div class='block2'>";

require "strdrugaanketa.php";

echo"</div>";
?>
</div>

<div class="column3">
<div class='block3'>
<a href='exit.php'>Выход</a><br/>
<p><script src="/time.js"></script></p>
<?php
//<a href="pay.php" class='pay'>Помочь в содержании и развитии сайта</a><br/>

echo"</div>";//END block3

?>
</div>
</body>
</html>