	
<?php
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 

session_start(); 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

 $strochekparolya=forenter($login,$ip);



$imya=$_GET['imya']; 
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);
$imya=mysql_real_escape_string($imya);//экранирует символы кроме % и _


if($imya!=''){
$query="SELECT imya FROM $userstable1 WHERE imya LIKE '$imya%' limit 5";
$result = mysql_query($query) or die("Query не получилось");

while($line=mysql_fetch_row($result)){
echo "<li><a href='' onClick='izlivinput(this); return false;'>$line[0]</a></li>";
}}



?>


