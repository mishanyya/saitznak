<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>



﻿<?php
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);




//удаление профиля из системы ==в polzovateli и lichnoe переименование , в других таблицах удаление строкdruzyainet

$logindel=$login.'удалено';

$query="UPDATE lichnoe,polzovateli SET lichnoe.loginp='$logindel',polzovateli.loginp='$logindel' WHERE polzovateli.loginp='$login' AND lichnoe.loginp='$login'";
$result = mysql_query($query) or die("Query1 не получилось");

$query="DELETE FROM adresatsms  WHERE otkogo='$login'";
$result = mysql_query($query) or die("Query1 не получилось");

$query="DELETE FROM adresatsms WHERE komu='$login'";
$result = mysql_query($query) or die("Query2 не получилось");

$query="DELETE FROM druzyainet WHERE moy='$login'";
$result = mysql_query($query) or die("Query3 не получилось");

$query="DELETE FROM druzyainet WHERE drug='$login'";
$result = mysql_query($query) or die("Query4 не получилось");

$query="DELETE FROM forgostey WHERE login='$login'";
$result = mysql_query($query) or die("Query5 не получилось");

$query="DELETE FROM forgostey WHERE login_q='$login'";
$result = mysql_query($query) or die("Query6 не получилось");

$query="DELETE FROM fototabl WHERE loginp='$login'";
$result = mysql_query($query) or die("Query7 не получилось");

$query="DELETE FROM metki WHERE loginp='$login'";
$result = mysql_query($query) or die("Query7 не получилось");

$query="DELETE FROM soobsheniya WHERE otkogo='$login'";
$result = mysql_query($query) or die("Query8 не получилось");

$query="DELETE FROM soobsheniya WHERE komu='$login'";
$result = mysql_query($query) or die("Query9 не получилось");

$query="DELETE FROM soobsheniya WHERE login='$login'";
$result = mysql_query($query) or die("Query10 не получилось");

Header("location:udaleno.php");
?>
