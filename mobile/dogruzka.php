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


$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit();}


$skolko=$_GET['skolko'];
$skolko=htmlspecialchars($skolko);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$skolko=mysql_real_escape_string($skolko);//экранирует символы кроме % и_

$skakogo=$_GET['skakogo'];
$skakogo=htmlspecialchars($skakogo);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$skakogo=mysql_real_escape_string($skakogo);//экранирует символы кроме % и_

$dostroki=$_GET['dostroki'];
$dostroki=htmlspecialchars($dostroki);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$dostroki=mysql_real_escape_string($dostroki);//экранирует символы кроме % и _



$query="SELECT * FROM $userstable1 WHERE  otkogo='$login' AND komu='$login_q'  UNION SELECT * FROM $userstable1 WHERE otkogo='$login_q' AND komu='$login' ORDER BY nomer ASC limit $skakogo,$skolko";

$result = mysql_query($query) or die("");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
if($line[1]==$login){
echo"<b class='textno'>$line[0]</b>";

$array=imyaizlogina($line[1]);
$imya=$array[0];
echo"<b class='textsoobout'>$imya</b>";

echo"<b class='textsoobin'></b>";
echo"<b class='textsoob' style='color:red;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='deletesoobsheniya.php?np=$line[0]'>Удалить сообщение</a></span></b>";

echo"<b class='textno'>$line[5]</b>";

echo"<br/>";
}

else if($line[1]==$login_q){
echo"<b class='textno'>$line[0]</b>";

$array=imyaizlogina($line[1]);
$imya1=$array[0];
echo"<b class='textsoobin'>$imya1</b>";
echo"<b class='textsoob' style='color:blue;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='deletesoobsheniya.php?np=$line[0]'>Удалить сообщение</a></span></b>";

echo"<b class='textno'>$line[5]</b>";



echo"<b class='textsoobout'></b>";

echo"<br/>";
}
}

?>

