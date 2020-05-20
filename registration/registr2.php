<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php


$ip = $_SERVER['REMOTE_ADDR'];//получение ip пользователя


$login = $_POST['login'];
$login=trim($login);
$login=htmlspecialchars($login);


$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
//$parol=sha1($parol);//зашифровка пароля

$parol1 = $_POST['parol1'];
$parol1=trim($parol1);
$parol1=htmlspecialchars($parol1);
//$parol1=sha1($parol1);//зашифровка пароля

							//сравнение паролей
if($parol!=$parol1){
  exit("Введены разные пароли! <a href='registr1.php'>Повторите ввод</a>");
}
else if($parol==$parol1){//зашифровка пароля
  $hashed_parol = crypt($parol);
  //обновление данных нового пользователя в БД
$query=$pdo->prepare("UPDATE polzovateli SET parp=? WHERE loginp=? LIMIT 1");
$query->execute(array($hashed_parol,$login));
//помещаем логин и ип в сессию
session_start();//инициируем сессию
$_SESSION['login']=$login;
$_SESSION['ip']=$ip;
echo"Вы успешно зарегистрировались! <a href='/mainpage.php'>Пройдите на свою страницу!</a>";
}
else{
exit("Введены разные пароли! <a href='registr1.php'>Повторите ввод</a>");
}
?>
