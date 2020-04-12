<html>	
<head>
<title>	Знакомства</title>
<script src="poiskimya.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="opisanie.js" type="text/javascript"></script>
<script src="myslipolzovatelya.js" type="text/javascript"></script>
<script src="neproch_soobsh.js" type="text/javascript"></script>

<script src="izlivinput.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>




<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php
//инициируем сессию  
session_start(); 


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу


$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл сообщений
$userstable5 = "forgostey";//табл гостей
$userstable6 = "statusp";//табл с мыслями
$userstable7 = "polzovateli";//табл 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 


$array=imyaizlogina($login);





echo"Удаление профиля&nbsp;<b>$array[0]</b>&nbsp;состоялось!  <br><a href='/index.php'>На главную страницу</a>";
?>




</body>


</html>