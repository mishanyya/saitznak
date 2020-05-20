<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         

						  
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$metkap=$_SESSION['metkap'];//моя группа



							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

if(isset($_POST['obrazovanie'])){$obrazovanie=$_POST['obrazovanie'];}
if(isset($_POST['zanyatiya'])){$zanyatiya=$_POST['zanyatiya'];}
if(isset($_POST['prozhivanie'])){$prozhivanie=$_POST['prozhivanie'];}
if(isset($_POST['deti'])){$deti=$_POST['deti'];}
if(isset($_POST['uvlechenie'])){$uvlechenie=$_POST['uvlechenie'];}
if(isset($_POST['privichki'])){$privichki=$_POST['privichki'];}
if(isset($_POST['dopolnitelno'])){$dopolnitelno=$_POST['dopolnitelno'];}

							//проверка наличия анкеты
$anketa=$pdo->prepare("SELECT COUNT(loginp) FROM anketa WHERE loginp=?");
$anketa->execute(array($login));
$anketa_count=$anketa->fetchColumn();

if($anketa_count>0){
$anketa=$pdo->prepare("UPDATE anketa SET obrazovanie=?,zanyatiya=?,prozhivanie=?,deti=?,uvlechenie=?,privichki=?,dopolnitelno=? WHERE loginp=? LIMIT 1");
$anketa->execute(array($obrazovanie,$zanyatiya,$prozhivanie,$deti,$uvlechenie,$privichki,$dopolnitelno,$login));
}
else if($anketa_count==0){
$anketa=$pdo->prepare("INSERT INTO anketa(loginp,obrazovanie,zanyatiya,prozhivanie,deti,uvlechenie,privichki,dopolnitelno) VALUES(?,?,?,?,?,?,?,?)");
$anketa->execute(array($login,$obrazovanie,$zanyatiya,$prozhivanie,$deti,$uvlechenie,$privichki,$dopolnitelno));
}

header("location:index.php");
?>