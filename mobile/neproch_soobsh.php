<?php

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";
                                           //модуль с полями для ввода пароля и логина
session_start();//инициируем сессию   

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

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}

$query="SELECT otkogo FROM $userstable1 WHERE komu='$login'AND otmetka='0'";//выбор непрочитанных сообщений
$result = mysql_query($query) or die("Query не получилось");
$line=mysql_num_rows($result);//помещение в массив количество строк из бд
if($line>0){echo"<a  class='vidknopok' href='soobsheniya.php'>У вас имеются непрочитанные сообщения</a> ";}
else{echo"У Вас нет непрочитанных сообщений";}



?>
