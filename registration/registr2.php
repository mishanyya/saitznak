<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php


$ip = $_SERVER['REMOTE_ADDR'];//получение ip пользователя


$login = $_POST['login'];
$login=trim($login);
$login=htmlspecialchars($login);


$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);


$parol1 = $_POST['parol1'];
$parol1=trim($parol1);
$parol1=htmlspecialchars($parol1);


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
//session_start();//инициируем сессию
$_SESSION['login']=$login;
$_SESSION['ip']=$ip;
echo"Вы успешно зарегистрировались! <a href='/registration/edit.php'>Пройдите на страницу ввода персональных данных!</a>";
}
else{
exit("Введены разные пароли! <a href='registr1.php'>Повторите ввод</a>");
}
?>
