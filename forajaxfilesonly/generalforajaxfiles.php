<?php
//код, необходимый для файлов, работающих с ajax
include "../functions.php";//подключить файл с функциями и постоянными переменными
include "../config.php";//присоединить файл для подключения к серверу
include "../pdo.php";//подключить файл с созданием и подключением pdo объекта
include "../work/general.php";//присоединить файл с общими функциями страниц пользователя сайта
//запуск сессии, должен быть на всех php файлах, работающих с ajax
session_start();
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
?>
