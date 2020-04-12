<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>

	<body>

<?php

session_start();//инициируем сессию   

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";
  $folder1 = '/fotosait/';//папка для выгрузки файлов  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 
$ip=$_SESSION['ip'];

$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit();}
                                         //модуль с полями для ввода пароля и логина



if (isset($_POST['udal']))
{

if($_POST["dfile"]) 
{ 
$mass=$_POST["dfile"];
$qq=$mass[0];
$qq=htmlspecialchars($qq);
$fotodlyaudal=$folder1.$qq;
unlink($fotodlyaudal);
echo $fotodlyaudal;
$s1="DELETE FROM $userstable WHERE loginp='$login' AND foto='$qq'";
$result1 = mysql_query($s1) or die("удаление не получилось");
Header("Location: izobrudal.php");
}
}

else if (isset($_POST['glav'])) 
{
if($_POST["dfile"]) 
{
$mass=$_POST["dfile"]; 
$qq=$mass[0];
$qq=htmlspecialchars($qq); 
$result=mysql_query("SELECT * FROM $userstable WHERE loginp='$login' AND metka='glav'");
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 
if($num_rows==0){
$query2="UPDATE $userstable SET metka='glav' WHERE loginp='$login' AND foto='$qq'";//запрос на выбор всех записей из таблицы $usertable1
$result2=mysql_query($query2)or die("запрос не удался11");//занесение в переменную результата запроса 
Header("Location: index.php");
}
else {
$query2="UPDATE $userstable SET metka='' WHERE loginp='$login' ";//запрос на выбор всех записей из таблицы $usertable
$result2=mysql_query($query2)or die("запрос не удался2");//занесение в переменную результата запроса 
$query3="UPDATE $userstable SET metka='glav' WHERE loginp='$login' AND foto='$qq'";//запрос на выбор всех записей из таблицы $usertable1
$result3=mysql_query($query3)or die("запрос не удался3");//занесение в переменную результата запроса 
Header("Location: izobrudal.php");
}
}
}

else if (isset($_POST['pokaz'])) 
{
if($_POST["dfile"]) 
{
$mass=$_POST["dfile"]; 
$qq=$mass[0];
$qq=htmlspecialchars($qq); 
$result=mysql_query("SELECT * FROM $userstable WHERE loginp='$login' AND metka='glav'");
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 
if($num_rows>0){
$query2="UPDATE $userstable SET metka='' WHERE loginp='$login' ";//запрос на выбор всех записей из таблицы $usertable1
$result2=mysql_query($query2)or die("запрос не удался11");//занесение в переменную результата запроса 
Header("Location: index.php");
}
else {
/* $query2="UPDATE $userstable SET metka='' WHERE loginp='$login' ";//запрос на выбор всех записей из таблицы $usertable
$result2=mysql_query($query2)or die("запрос не удался2");//занесение в переменную результата запроса 
$query3="UPDATE $userstable SET metka='glav' WHERE loginp='$login' AND foto='$qq'";//запрос на выбор всех записей из таблицы $usertable1
$result3=mysql_query($query3)or die("запрос не удался3");//занесение в переменную результата запроса 
*/
Header("Location: izobrudal.php");
}
}
}
//


else if (isset($_POST['opis'])) 
{
if($_POST["dfile"]) 
{ 
$mass=$_POST["dfile"]; 
$mass=htmlspecialchars($mass);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$mass=mysql_real_escape_string($mass);//экранирует символы кроме % и _
  
$qq=$mass[0];

$qq=htmlspecialchars($qq);

$textopis=$_POST["textopis"];
$textopis=trim($textopis);//убирает пробелы из начала и конца поля
$textopis=htmlspecialchars($textopis);



$query="UPDATE $userstable SET opisanie='$textopis' WHERE loginp='$login' AND foto='$qq'";
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
Header("Location: izobrudal.php");

}
}



?>
<a href='/modredpol/index.php'>На мою страницу</a>

</body>
</html>