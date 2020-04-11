<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

﻿<link rel="stylesheet" type="text/css" href="/style.css"/>
<?php
           

							//если вход напрямую
if(!isset($_POST['logi'])){
exit("<a href='/index.php'>зайти на сайт</a>");
}
//если прислан логин
{
$login=$_POST['logi'];
$login=trim($login);
$login=htmlspecialchars($login);
   
$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
$parol=sha1($parol);// зашифровка  пароляlichnoe

$parol1 = $_POST['parol1'];
$parol1=trim($parol1);
$parol1=htmlspecialchars($parol1);
$parol1=sha1($parol1);// зашифровка  пароля
}
							//если пароли не совпали
if($parol1!=$parol){
exit("пароли не совпали <a href='zamenapa.php?ab=$login'>повторить</a>");
}
							//обновляем пароли в БД
$query=$pdo->prepare("UPDATE polzovateli SET parp=?,proveren='1' WHERE loginp=?");
$query->execute(array($parol1,$login));
							//вносим логин и ip в сессию и переходим на страницу пользователя
session_start();
$_SESSION['login']=$login;
							//ip пользователя
$ip = $_SERVER['REMOTE_ADDR'];
							//вносим ip в БД
$query=$pdo->prepare("UPDATE lichnoe SET ipp=? WHERE loginp=?");
$query->execute(array($ip,$login));

$_SESSION['ip']=$ip;//создается сессия IP

echo"Пароль изменен <a href='/modredpol/index.php'>дальше</a>";

?>
