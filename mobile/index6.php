<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

</head>


	<body>

<?php
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      


mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 


$login=$_SESSION['login'];
 $login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 


//Функция при открытии проверяет наличие логина и совпадение парол и логина

provlogparip($login,$ip,$pdo);

isonline($login_q,$pdo);//если он-лайн то показывает

$metkap=$_SESSION['metkap'];   //номер пользователя входит в переменную 


if($_GET["radiodrugb"]) 
{ 
$n=$_GET["radiodrugb"]; 

$login_q=iznomera($n,$pdo);
$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$_SESSION['login_q']=$login_q;

}
else if(isset($_SESSION['login_q'])){
$login_q=$_SESSION['login_q'];
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _ 


}
else{
header("location:index.php");
}


$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login_q));
while($line_q=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_q=$line_q->imya;
}

echo"imya_q $imya_q  <br/>";


//удаление из списков заблокированных пользователей
$query="DELETE FROM druzyainet WHERE (moy='$login'AND drug='$login_q' AND da='0' AND net='1') OR (moy='$login_q' AND drug='$login' AND da='0' AND net='1')";
$pdo->exec($query);

echo"<a href='index2.php'>Удален из черного списка-> на мою страницу</a>";


?>



</body>


</html>