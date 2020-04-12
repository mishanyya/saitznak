	
<?php
//ошибки показывать

ini_set("display_errors",1);
error_reporting(E_ALL);
 
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 



$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

//Функция при открытии проверяет наличие логина и совпадение парол и логина

provlogparip($login,$ip,$pdo);



$imya=$_GET['imya']; 
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);
$imya=mysql_real_escape_string($imya);//экранирует символы кроме % и _


if($imya!=''){

$imya="%$imya%";//сначала подготовить строку для поиска



$query=$pdo->prepare("SELECT imya FROM lichnoe WHERE imya LIKE ? limit 5");

$query->execute(array($imya));

while($line=$query->fetch(PDO::FETCH_LAZY)){
echo "<li><a href='' onClick='izlivinput(this); return false;'>$line[0]</a></li>";
}}



?>


