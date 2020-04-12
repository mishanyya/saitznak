<html>	
<head>
<title>Сайт знакомств</title>
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
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
$userstable6 = "zalobyna";//табл для жалоб
$userstable7 = "statusp";//табл мыслей 
  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

$array=imyaizlogina($login);


echo"Ваше имя $array[0]  <br>";


$array=imyaizlogina($login_q);
echo"Имя к кому зашли $array[0] <br>";

$online=online($login);//вывести в online
if($online=='1'){
 echo"online"; } 

if(isset($_POST['vdruzya'])){

$vdruzya=$_POST['vdruzya'];
$vdruzya=htmlspecialchars($vdruzya);
$vdruzya=mysql_real_escape_string($vdruzya);//экранирует символы кроме % и _

$query="SELECT * FROM $userstable3 WHERE (moy='$login' AND drug='$login_q' AND da='1')OR(moy='$login_q' AND drug='$login' AND da='1') ";

$result = mysql_query($query) or die("Query не получилось");

$line=mysql_num_rows($result);//выводит строки пока они не кончатся в бд

if($line=='0'){

$query="SELECT * FROM $userstable3 WHERE (moy='$login' AND drug='$login_q' AND da='0' AND net='0')OR(moy='$login_q' AND drug='$login' AND da='0' AND net='0') ";

$result = mysql_query($query) or die("Query не получилось");

$line=mysql_num_rows($result);//выводит строки пока они не кончатся в бд
if($line=='1'){echo"Запрос на дружбу уже существует<a href='index.php'>На главную страницу</a>";}

else {

$query="SELECT * FROM $userstable3 WHERE (moy='$login' AND drug='$login_q' AND da='0' AND net='1')OR(moy='$login_q' AND drug='$login' AND da='0' AND net='1') ";

$result = mysql_query($query) or die("Query не получилось");

$line=mysql_num_rows($result);//выводит строки пока они не кончатся в бд
if($line=='1'){echo"$login_q находится в черном списке<a href='index.php'>На главную страницу</a>";}

else{
$query="INSERT INTO $userstable3 (nom,moy,drug,net,da) VALUES (NULL,'$login','$login_q','0','0')";
$result = mysql_query($query) or die("Query1 не получилось");
echo"Запрос другу отправлен<a href='index.php'>На главную страницу</a>";
}
}

}

else{echo"есть такой друг<br/><a href='index.php'>На главную страницу</a>";}

}

if(isset($_POST['izdruzey'])){

$izdruzey=$_POST['izdruzey'];
$izdruzey=htmlspecialchars($izdruzey);

$izdruzey=mysql_real_escape_string($izdruzey);//экранирует символы кроме % и _


$query="DELETE FROM $userstable3 WHERE (moy='$login' AND drug='$login_q' AND da='1')OR(moy='$login_q' AND drug='$login' AND da='1') ";

$result = mysql_query($query) or die("Query не получилось");

echo"Друг удален<br/><a href='index.php'>На главную страницу</a>";

}


if(isset($_POST['blacklist'])){


$blacklist=$_POST['blacklist'];
$blacklist=htmlspecialchars($blacklist);
$blacklist=mysql_real_escape_string($blacklist);//экранирует символы кроме % и _

$query="SELECT * FROM $userstable3 WHERE (moy='$login' AND drug='$login_q')OR(moy='$login_q' AND drug='$login') ";

$result = mysql_query($query) or die("Query не получилось");

$line=mysql_num_rows($result);//выводит строки пока они не кончатся в бд

if($line!='0'){
$query="UPDATE $userstable3 SET net='1',da='0' WHERE (moy='$login' AND drug='$login_q' AND da='1')OR(moy='$login_q' AND drug='$login' AND da='1') ";
$result = mysql_query($query) or die("Query не получилось");
echo"Отношения разорваны<br/><a href='index.php'>На главную страницу</a>";
}
else{
$query="INSERT INTO $userstable3 (nom,moy,drug,net,da) VALUES (NULL,'$login','$login_q','1','0')";
$result = mysql_query($query) or die("Query1 не получилось");
}
}

if(isset($_POST['zgaloba'])){


$zgaloba=$_POST['zgaloba'];
$zgaloba=htmlspecialchars($zgaloba);
$zgaloba=mysql_real_escape_string($zgaloba);//экранирует символы кроме % и _

$prichina=$_POST['prichina'];
$prichina=htmlspecialchars($prichina);
$prichina=mysql_real_escape_string($prichina);//экранирует символы кроме % и _

$query="INSERT INTO $userstable6 (nom,login_q,login,vremya,prichina) VALUES (NULL,'$login_q','$login','$today','$prichina')";

$result = mysql_query($query) or die("Query3 не получилось");

echo"Жалоба отправлена<br/><a href='index.php'>На главную страницу</a>";

}





?>

<a href='stdruga.php'>Назад На страницу</a>


</body>


</html>