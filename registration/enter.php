<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php

?>


﻿<link rel='stylesheet' type='text/css' href='/css/style.css'/>
<?php



                                      //модуль ввода введеных логина и пароля в переменные
if(!($_POST['parol'])){
  $parol='неизвестен';
}
else{
$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
//шифровать пароль для сравнения с БД не надо!!!
}

if(!($_POST['login'])){
  $login='неизвестен';
}
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
//echo 'login:'.$login.'<br/>';
//echo 'parol:'.$parol.'<br/>';

 							//проверяет логин
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=?");
$query->execute(array($login));
$loginCount=$query->fetchColumn();
							//если нет такого логина
if($loginCount=='0'){
exit("Логин не зарегистрирован! <a href='/registr.php'>Зарегистрируйтесь</a><br/>или <a href='/index.php'>Повторите вход</a>");
}
 else
 {//вносим логин,пароль в таблицу threetimesblock и увеличиваем попытку на 1, и переходим на стр. пользователя
threetimesenter($login,$parol,$pdo);//ф-ция обработки ввода логина и пароля
}

?>
