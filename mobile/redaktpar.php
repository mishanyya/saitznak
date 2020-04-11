
<link rel="stylesheet" type="text/css" href="style.css"/>
<?php


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки


if(isset($_GET['a'])&&(isset($_GET['b'])))//если по почте пришло
{
$login=$_GET['a']; 
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$vremparol=$_GET['b']; 
$vremparol=trim($vremparol);//убирает пробелы из начала и конца поля
$vremparol=htmlspecialchars($vremparol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$vremparol=mysql_real_escape_string($vremparol);//экранирует символы кроме % и _



$query="SELECT loginp FROM $userstable where loginp='$login' AND vrepar='$vremparol'";//запрос на выбор всех записей из таблицы $usertable
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 

if($num_rows=='1')
{
Header("Location: zamenapa.php?a=$login");
}     
else
{
echo"такого логина с временным паролем не найдено<br/>";
}

}



/*
else if(isset($_GET['ar'])&&(isset($_GET['br'])))//если не по почте
{
$login=$_GET['ar']; 
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$vremparol=$_GET['br']; 
$vremparol=trim($vremparol);//убирает пробелы из начала и конца поля
$vremparol=htmlspecialchars($vremparol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$vremparol=mysql_real_escape_string($vremparol);//экранирует символы кроме % и _

$query="UPDATE $userstable SET proveren='0',timeregistr=NOW()  WHERE loginp='$login' AND vrepar='$vremparol'";//обновить на непроверенный email
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 

//echo"login пользователя $login <br/> Ваш email не подтвержден. отправьте пожалуйста сообщение'zab' на admin@vmesteprosto.info";



$query="SELECT loginp FROM $userstable where loginp='$login' AND vrepar='$vremparol'";//запрос на выбор всех записей из таблицы $usertable
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 
if($num_rows=='1'){
Header("Location: zamenapa.php?ab=$login");
}

else{echo"такого логина с временным паролем не найдено<br/>";}

}*/
?>
<a href='/index.php'>На страницу входа</a>


