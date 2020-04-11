<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>


	<body>
<div id="top"><h1 align="center">Сайт Знакомств</h1></div>



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
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit();}
    
if($_GET['pn'])  
{
$l=$_GET['pn'];
$login_q=iznomera($l);                                

$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
$_SESSION['login_q']=$login_q;


}
else
{$login_q=$_SESSION['login_q'];} 
$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _


$metka=metkidlyadruzey($login,$login_q);//если закрыт профиль
if($metka!='vhod'){
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
				

header("location:soobsheniya.php");
?>




</body>


</html>