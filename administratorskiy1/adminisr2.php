<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

﻿<link rel="stylesheet" type="text/css" href="/style.css"/>


<?php
$parol = $_POST['parol']; 
$parol=trim($parol); 
$parol=htmlspecialchars($parol); 

                                                                                               
$login = $_POST['login']; 
$login=trim($login); 
$login=htmlspecialchars($login);

$loginl="bWlzaGFueXlh";
$parolp="f46c3b24cda23dba2b6dd52691dfacdb40db3894";

if(($login==$loginl) & ($parol==$parolp)){
echo"нормальное выполнение программы<br/>";
}
else{

header("location:index.php");

}
$toadmin = $_POST['login_polzovatelya'];
$toadmin=trim($toadmin);
$login_polzovatelya=htmlspecialchars($toadmin);

$log=base64_decode($login_polzovatelya);//шифрование
echo"Логин выбранного пользователя $log * $login_polzovatelya<br/>";


$query=$pdo->prepare("DELETE FROM zalobyna WHERE login_q=?");
$query->execute(array($login_polzovatelya));

$query=$pdo->prepare("INSERT INTO adminblockedlog (login) VALUES (?)");
$query->execute(array($login_polzovatelya));

echo"Логин заблокирован";

echo "<a href='adminisr.php'>Продолжить</a>";

?>

