для жалоб

<html>	
<head>
<title>	Знакомства</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<script src="zaloba.js"></script>	
</head>
	<body>


<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>

<?php
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 


$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
  $folder1 = '/fotosait/';//папка для выгрузки файлов  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);// проверка для входа

 if(isset($_SESSION['login_q'])){
$login_q=$_SESSION['login_q'];

//$login_q=iznomera($ipd,$pdo);

$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

}



$metka=metkidlyadruzey($login,$login_q,$pdo);

echo"* $login *+ $login_q +- $metka -<br/>";

echo"Вы хотите сообщить о:<br/>";

echo"<form action='index16_vdruzya.php' method='POST'>";

echo"<input type='radio' name='zaloba' value='zaloba_1'/>Размещение фотографий эротического или порнографического содержания<br/>";

echo"<input type='radio' name='zaloba' value='zaloba_2'/>Распространение спама или рекламы<br/>";

echo"<input type='radio' name='zaloba' value='zaloba_3'/>Оскорбление пользователей<br/>";

echo"<input type='radio' name='zaloba' value='zaloba_4'/>Регистрация с чужими данными<br/>";

echo"<input type='radio' name='zaloba' value='zaloba_5'/>Распространение информации,по Вашему мнению, с экстремистким , противозаконным или иным содержанием, которая ,по Вашему мнению, не имеет права на существование<br/>";

echo"<input type='submit' name='zgaloba' value='Сообщить'>";

echo"</form>";






?>

<a href='index2.php'>На мою страницу</a>
</body>
</html>	
