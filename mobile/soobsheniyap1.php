



<?php

session_start();//инициируем сессию   


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
                                             //модуль с полями для ввода пароля и логина


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit();}
                                          //модуль с полями для ввода пароля и логина

if(!empty($_POST['adresat'])){

$login_q=$_POST['adresat'];

$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

$_SESSION['login_q']=$login_q;}
else
{$login_q=$_SESSION['login_q'];} 
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

$metka=metkidlyadruzey($login,$login_q);
if($metka=='2'){
header("location:soobsheniya.php");
exit();
}


$soobsh=$_POST['soobsh'];
$soobsh=trim($soobsh);//убирает пробелы из начала и конца поля
$soobsh=htmlspecialchars($soobsh);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$soobsh=mysql_real_escape_string($soobsh);//экранирует символы кроме % и _

if(!empty($login)&(!empty($soobsh))&(!empty($login_q)))
{
$result = mysql_query("INSERT INTO $userstable1 (nomer,otkogo,komu,soobshenie,data,otmetka) VALUES (NULL,'$login', '$login_q', '$soobsh','$today','0')");
}
				

header("location:soobsheniyap.php");
?>




