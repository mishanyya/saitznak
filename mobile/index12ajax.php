<?php

//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";
                                           //модуль с полями для ввода пароля и логина
 

if(isset($_SESSION['login_q']))
{
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
}

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

//Функция при открытии проверяет наличие логина и совпадение парол и логина

provlogparip($login,$ip,$pdo);

$query=$pdo->prepare("SELECT COUNT(otkogo) FROM soobsheniya WHERE komu=? AND otmetka='0'");//выбор непрочитанных сообщений
$query->execute(array($login));
$line=$query->fetchColumn();
if($line>0){echo"<a href='index7.php'>У вас имеются непрочитанные сообщения</a> ";}
else{echo"У Вас нет непрочитанных сообщений";}
?>
