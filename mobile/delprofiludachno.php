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

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

$block=blocked ($login);
if($block==1){echo "<b class='s'>Страница закрыта для всех,кроме друзей</b><br/>";}

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}

unset($_SESSION['login_q']); 

//$folder1 = '/fotosait/';//папка для выгрузки файлов

/*$login=$_SESSION['login'];   //номер пользователя входит в переменную     //модуль с полями для ввода пароля и логина

$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 
*/
$array=imyaizlogina($login);

//удаление профиля из системы в polzovateli и lichnoe переименование , в других таблицах удаление строк

$logindel=$login.'удалено';

$query="UPDATE $userstable1,$userstable7 SET $userstable1.loginp='$logindel',$userstable7.loginp='$logindel' WHERE $userstable7.loginp='$login' AND $userstable1.loginp='$login'";
$result = mysql_query($query) or die("Query1 не получилось");

$query="DELETE FROM adresatsms  WHERE otkogo='$login'";
$result = mysql_query($query) or die("Query1 не получилось");

$query="DELETE FROM adresatsms WHERE komu='$login'";
$result = mysql_query($query) or die("Query2 не получилось");

$query="DELETE FROM $userstable3 WHERE moy='$login'";
$result = mysql_query($query) or die("Query3 не получилось");

$query="DELETE FROM $userstable3 WHERE drug='$login'";
$result = mysql_query($query) or die("Query4 не получилось");

$query="DELETE FROM $userstable5 WHERE login='$login'";
$result = mysql_query($query) or die("Query5 не получилось");

$query="DELETE FROM $userstable5 WHERE login_q='$login'";
$result = mysql_query($query) or die("Query6 не получилось");

$query="DELETE FROM $userstable WHERE loginp='$login'";
$result = mysql_query($query) or die("Query7 не получилось");

$query="DELETE FROM metki WHERE loginp='$login'";
$result = mysql_query($query) or die("Query7 не получилось");

$query="DELETE FROM $userstable4 WHERE otkogo='$login'";
$result = mysql_query($query) or die("Query8 не получилось");

$query="DELETE FROM $userstable4 WHERE komu='$login'";
$result = mysql_query($query) or die("Query9 не получилось");

$query="DELETE FROM $userstable6 WHERE login='$login'";
$result = mysql_query($query) or die("Query10 не получилось");

Header("location:udaleno.php");
?>
