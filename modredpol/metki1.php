<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>	
	
<?php


session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();



  
$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

							//если открыт
if(isset($_POST['metki'])){
$query=$pdo->prepare("INSERT INTO metki (loginp) VALUES (?)");
$query->execute(array($login));
}
							//если заблокирован
if(isset($_POST['metkinet'])){
$query=$pdo->prepare("DELETE FROM metki WHERE loginp=? LIMIT 1");
$query->execute(array($login));
}

header("location:index.php");
?>


