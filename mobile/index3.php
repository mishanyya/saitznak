
<?php



ini_set("display_errors",1);
error_reporting(E_ALL);
//инициируем сессию  
session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      

//в PDO названия таблиц надо вставлять без кавычек
$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл сообщений
$userstable5 = "forgostey";//табл гостей
$userstable6 = "statusp";//табл с мыслями
$userstable7 = "polzovateli";//табл 

//
$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

echo"* login $login *";

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

echo"+ ip $ip +";

//Функция смотрит заблокирован логин или нет

$block=$pdo->query("SELECT COUNT(loginp) FROM metki WHERE loginp='$login'");
$block_num=$block->fetchColumn();
$error_array = $pdo->errorInfo();

echo"/block_num $block_num /<br/>";
if($block_num>'0'){echo "<b class='s'>Ваша страница закрыта для всех,кроме друзей</b><br/>";}
if($block_num=='0'){echo "<b class='s'>Ваша страница открыта</b><br/>";}

//Функция при открытии проверяет наличие логина и совпадение парол и логина

$kolv=$pdo->query("SELECT COUNT(loginp) FROM lichnoe WHERE loginp='$login' AND ipp='$ip'");
$kolv_num=$kolv->fetchColumn();
$error_array = $pdo->errorInfo();

echo"#kolv_num $kolv_num #";//
if($kolv_num=='0'){exit("Попробуйте&nbsp;<a href='/mobile/index.php'>войти снова</a>");}

unset($_SESSION['login_q']); 

$metkap=$pdo->query("SELECT metkap FROM lichnoe WHERE loginp='$login'");//получаем метку группы

$error_array = $pdo->errorInfo();

while($line=$metkap->fetch(PDO::FETCH_LAZY))
{
$metka=$line->metkap;
}
echo",metka $metka ,";






if($_GET['vdrugi']) //принять в друзья
{ 
$moy_q=$_GET['vdrugi'];

$moy_q=iznomera($moy_q,$pdo);




$updrug=$pdo->exec("UPDATE druzyainet SET da='1',net='0' WHERE moy='$moy_q' AND drug='$login'");

header("location:index2.php");
}


else if($_GET['nevdrugi']) //отклонить запрос в друзья
{ 
$moy_q=$_GET['nevdrugi'];


//$moy_q=iznomera($moy_q);
//Функция где номер дешифровывается
     
$nomer=base64_decode($moy_q);
$nomer=substr($nomer,0,-1);             //убрать лишний символ

echo"$nomer nomer";

$nomer=$pdo->query("SELECT loginp FROM polzovateli WHERE nomp='$nomer' LIMIT 1");

while($line=$nomer->fetch(PDO::FETCH_LAZY))
{
$moy_q=$line->loginp;
}
echo"$moy_q moy_q";



$moy_q=htmlspecialchars($moy_q);
$moy_q=mysql_real_escape_string($moy_q);//экранирует символы кроме % и _


$query="DELETE FROM $userstable3  WHERE moy='$moy_q' AND drug='$login' AND da='0' AND net='0'";
$updrug=$pdo->exec("DELETE FROM $userstable3  WHERE moy='$moy_q' AND drug='$login' AND da='0' AND net='0'");


header("location:index2.php");
}











?>

