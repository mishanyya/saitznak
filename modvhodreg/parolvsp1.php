<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>

<?php
                

                                             //модуль ввода данных в переменные 
if(!isset($_POST['text1'])){
exit("вы не подтвердили вход <a href='registr.php'>вернуться</a>");
}
else{
$text1 = $_POST['text1'];
$text1 =strtolower($text1);//переводит в нижний регистр
$text1=trim($text1);
$text1=htmlspecialchars($text1);
}
   
$login = $_POST['login'];
$login =strtolower($login);//переводит в нижний регистр
$login=trim($login);
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование логина 
							//поиск такого логина в БД
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=?");
$query->execute(array($login));
$loginCount=$query->fetchColumn();

							//если такой  логин уже есть 
if($loginCount>0){
exit("такой логин уже есть <a href='/index.php'>войдите</a>");
}
							//если такого логина еще нет
else{
							//вырабатывается временный пароль для установки пароля 
$vremen=rand();
							//вставка логина в БД
$query=$pdo->prepare("INSERT  INTO polzovateli (nomp,loginp,parp,vrepar,timeregistr,proveren,dengymone) VALUES (NULL,?,'не задано',?,NOW(),'0','0')");
$query->execute(array($login,$vremen));
$query=$pdo->prepare("INSERT INTO lichnoe (loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol) VALUES (?,'','','',CURDATE(),'0','22220','','5','','')");
$query->execute(array($login));


							//адрес кому отправляется письмо 
$address=base64_decode($login);
$sub="vmesteprosto.info Регистрация";

$mes="Пройдите пожалуйста по ссылке для регистрации http://vmesteprosto.info/modvhodreg/redaktpar1.php?a=$login&b=$vremen  \r\n";
//$from - смотреть в config.php
							//отправка сообщения
							
mail($address,$sub,$mes,$from);

													//обновление временного пароля у логина

$_SESSION['login']=$login;
echo "Сообщение  отправлено!<br/>Сообщение  придет в течение некоторого времени, в зависимости от загрузки сети,также оно может находиться в папке 'Спам'<br/>Если не пришло отправьте его <a href='registr.php'>еще раз</a> или  <a href='mailto:admin@vmesteprosto.info'>нажмите на ссылку для отправки нам сообщения и Вас зарегистрируют в ближайщее время</a>";
}//окончание цикла
?>