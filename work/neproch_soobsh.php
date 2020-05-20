<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<?php
 
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter(); 

if(isset($_SESSION['login_q']))
{
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
}

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//вывод непрочитанных сообщений
$query=$pdo->prepare("SELECT DISTINCT otkogo FROM soobsheniya WHERE komu=? AND otmetka='0'");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//помещение в массив строк из бд
{
$nomer=izloginanomer($line[0],$pdo);//шифруется номер 
$nlog1=iznomera($nomer,$pdo);//расшифровывается номер и выходит логин
$lich=dataFromLogin($nlog1,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_nlog1=$line->imya;
}
echo"<p><a href='soobsheniya.php?id=$nomer'>У Вас непрочитанное письмо от $imya_nlog1</a></p>";
}
?>
