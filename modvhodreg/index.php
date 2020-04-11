<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel='stylesheet' type='text/css' href='/style.css'/>
<?php

         


                                                                     //модуль ввода введеных логина и пароля в переменные
if(!isset($_POST['parol'])){$parol='неизвестен';}
else{
$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
$parol=sha1($parol);   
}     
if(!isset($_POST['login'])){$login='неизвестен';}
else{                                                                           
$login = $_POST['login'];
$login =strtolower($login);
$login=trim($login);
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование
}
session_start();//инициируем сессию
							//проверяется на блокировку администратором
blocked($login,$pdo);
 							//проверяет логин и пароль
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=?");
$query->execute(array($login));
$loginCount=$query->fetchColumn();
							//если не правильно введен логин
if($loginCount=='0'){
exit("логин не зарегистрирован <a href='registr.php'>зарегистрируйтесь</a><br/>или <a href='/index.php'>повторите вход</a>");
}
							//если логин есть в базе
 else 
 {
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE (loginp=? AND parp=?) LIMIT 1");
$query->execute(array($login,$parol));
$passwordCount=$query->fetchColumn();					
							//если логин и пароль совпали
if($passwordCount=='1'){
							//ip пользователя
$ip = $_SERVER['REMOTE_ADDR'];
							//обновляется ip в БД
$query=$pdo->prepare("UPDATE lichnoe SET ipp=? WHERE loginp=?");
$query->execute(array($ip,$login));
							//создается сессия IP
$_SESSION['ip']=$ip;
							//создается сессия логина
$_SESSION['login']=$login;
						//переход на страницу пользователя
header("location:/modredpol/index.php");
}
							//если пароль не совпал
else{
threetimes($login,$parol,$pdo);
echo("пароль введен неверно <a href='/index.php'>попробуйте еще раз </a>или нажмите <a href='parolvsp.php'>вспомнить пароль</a>");
}
}       
?>