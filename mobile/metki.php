<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php

session_start();//инициируем сессию   


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
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
$userstable6 = "zalobyna";//табл для жалоб
$userstable7 = "metki";//табл если есть отметка только для друзей
  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _


$strochekparolya=forenter($login,$ip);



if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}
$array=imyaizlogina($login);


echo"&nbsp;<i>$array[0]</i>  <br>";


$query="SELECT loginp FROM $userstable7 WHERE loginp='$login' ";

$result = mysql_query($query) or die("Query не получилось");

$line=mysql_num_rows($result);//выводит строки пока они не кончатся в бд


if($line=='1'){
echo"&nbsp;Вы заблокированы от всех кроме друзей";
echo"<form method='post' action='metki1.php'>";
echo"&nbsp;<input type='submit' name='metkinet' value='Открыть свою страницу'>";
echo"</form>";

}
else{
echo"<form method='post' action='metki1.php'>";
echo"&nbsp;<input type='submit' name='metki' value='Закрыть досмотр моей страницы для всех кроме друзей - главное фото будет доступно всем'>";
echo"</form>";
}



?>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>


</body>


</html>