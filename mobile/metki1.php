
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
$userstable7 = "metki";//табл если есть отметка только для друзей
  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _


$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit();}
$array=imyaizlogina($login);




$online=online($login);//вывести в online
if($online=='1'){
 echo"online"; } 

if(isset($_POST['metki'])){





$query="INSERT INTO $userstable7 (loginp) VALUES ('$login')";

$result = mysql_query($query) or die("Query не получилось");
}

if(isset($_POST['metkinet'])){

$query="DELETE FROM $userstable7 WHERE loginp='$login'";

$result = mysql_query($query) or die("Query не получилось");
}

header("location:index.php");
?>


