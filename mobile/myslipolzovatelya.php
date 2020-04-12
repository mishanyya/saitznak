
<?php

session_start();//инициируем сессию   


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
$userstable6 = "zalobyna";//табл для жалоб
$userstable7 = "statusp";//табл мыслей 
  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _


$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _


$strochekparolya=forenter($login,$ip);//для входа

if($strochekparolya!=1){exit();}





$text=$_POST['text'];
$text=htmlspecialchars($text);
$text=mysql_real_escape_string($text);//экранирует символы кроме % и _

$query="INSERT INTO $userstable7 (nomp,login,texts,data)VALUES(NULL,'$login','$text',NOW()) ";

$result = mysql_query($query) or die("Query не получилось");

header("location:index.php");

?>


