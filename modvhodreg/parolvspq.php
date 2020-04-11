<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

<link rel="stylesheet" type="text/css" href="/style.css"/>

<?php
session_start();
unset($_SESSION['login']);//обнулить сессии

                
							//модуль ввода данных в переменные 
if(!isset($_POST['text1'])){
							//если не поставили галочку
exit("не поставили галочку <a href='parolvsp.php'>вернуться</a>");
}
else{
$text1 = $_POST['text1'];
$text1=strtolower($text1);//переводит в нижний регистр
$text1=trim($text1);
$text1=htmlspecialchars($text1);
}

$login = $_POST['login'];
$login =strtolower($login);//переводит в нижний регистр
$login=trim($login);
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование

							//запрос на существование такого логина в БД

$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=?");
$query->execute(array($login));
$loginCount=$query->fetchColumn();

							//если такого логина нет
if($loginCount=='0'){
exit("Такой логин не зарегистрирован <a href='registr.php'>зарегистрируйтесь</a>");
}
							//если такой логин есть
else{							//временный пароль для замены пароля 
$vremen=rand(); 
							//адрес кому отправляется письмо 
$address =base64_decode($login); 
$sub = "vmesteprosto.info Вспомнить пароль";
$mes = "Пройдите пожалуйста по ссылке для ввода нового пароля http://vmesteprosto.info/modvhodreg/redaktpar.php?a=$login&b=$vremen  \r\n";
//$from - смотреть в config.php
							//отправка сообщения
$sendmail=mail($address,$sub,$mes,$from);

							//обновление временного пароля у логина
$query=$pdo->prepare("UPDATE polzovateli SET vrepar=? WHERE loginp=?");
$query->execute(array($vremen,$login));
$_SESSION['login']=$login;
if($sendmail==1)echo "для $address <br/>  Сообщение  отправлено!<br/>Сообщение для смены пароля придет в течение некоторого времени, в зависимости от загрузки сети,также оно может находиться в папке 'Спам'<br/>Если не пришло отправьте его <a href='parolvsp.php'>еще раз</a>";
  
 }//окончание цикла
?>

