<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>


</head>


	<body>




<?php

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем                        

$userstable="lichnoe";
$userstable1="soobsheniya";


mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки


                                             //модуль с полями для ввода пароля и логина


$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);//проверка при входе
    
if($_GET['pn'])  //если выбран адресат по ссылке
{
$l=$_GET['pn'];
$login_q=iznomera($l,$pdo);                                

$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
$_SESSION['login_q']=$login_q;

echo"< $login_q >";
}
else //если не выбирался адресат по ссылке
{$login_q=$_SESSION['login_q'];} 
$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

/*
$metka=metkidlyadruzey($login,$login_q,$pdo);//если закрыт профиль

if($metka=='4'){
header("location:index7.php");//переход на страницу с сообщениями

}
*/

$soobsh=$_POST['soobsh'];
$soobsh=trim($soobsh);//убирает пробелы из начала и конца поля
$soobsh=htmlspecialchars($soobsh);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$soobsh=mysql_real_escape_string($soobsh);//экранирует символы кроме % и _




if(!empty($login)&(!empty($soobsh))&(!empty($login_q)))
{


$result=$pdo->exec("INSERT INTO soobsheniya (nomer,otkogo,komu,soobshenie,data,otmetka) VALUES (NULL,'$login', '$login_q', '$soobsh','$today','0')");
}
	
header("location:index7.php");
?>




</body>


</html>