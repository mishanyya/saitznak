<html>	
<head>
<title>	Знакомства</title>
</head>
	<body>
<script src="poiskimya.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="opisanie.js" type="text/javascript"></script>
<script src="myslipolzovatelya.js" type="text/javascript"></script>
<script src="neproch_soobsh.js" type="text/javascript"></script>

<script src="izlivinput.js" type="text/javascript"></script>
<?php
//ошибки показывать

ini_set("display_errors",1);
error_reporting(E_ALL);
 
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      

//в PDO названия таблиц надо вставлять без кавычек

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл сообщений
$userstable5 = "forgostey";//табл гостей
$userstable6 = "statusp";//табл с мыслями
$userstable7 = "polzovateli";//табл 

//внесение данных из сессии


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

echo"* login $login *";
online($login,$pdo);//внесение в онлайн
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

echo"+ ip $ip +";

//смотрит закрыта ли страница пользователем или нет

$block=$pdo->query("SELECT COUNT(loginp) FROM metki WHERE loginp='$login'");
$block_num=$block->fetchColumn();
if($block_num>'0'){echo "Ваша страница закрыта для всех,кроме друзей<br/>";}
if($block_num=='0'){echo "Ваша страница открыта<br/>";}

//Функция при открытии проверяет наличие логина и совпадение парол и логина

provlogparip($login,$ip,$pdo);


//обнуляется сессия логина к кому заходили

unset($_SESSION['login_q']); 

//получаем метку группы

$metkap=$pdo->query("SELECT metkap FROM lichnoe WHERE loginp='$login'");
while($line=$metkap->fetch(PDO::FETCH_LAZY))
{
$metka=$line->metkap;
}
echo",metka $metka ,";
$_SESSION['metkap']=$metka; 

//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}

echo"имя<i>$imya</i>  <br>";//имя
echo"Регион<i>$region</i>  <br>";//Регион 
echo"Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"имя<i>$vozrast</i>  <br>";//имя
echo"метка группы<i>$metka</i>  <br>";//метка группы 
echo"ип<i>$ipp</i>  <br>";//ип 
echo"фото<i>$limitfoto</i>  <br>";//фото 
echo"о себе<i>$osebe</i>  <br>";//о себе 

if($metka!='0'){echo"<i>У Вас есть возможность общаться с Вашей группой</i> <br>";}

//показывает главное фото

$foto=glavfoto($login,$pdo);
echo $foto[0];

?>
<div>
<div id="neproch_soobsh"></div>
<?php

//если меня пригласили в друзья  

$vdruz=$pdo->query("SELECT COUNT(moy) FROM druzyainet WHERE drug='$login' AND net='0' AND da='0' ");


$vdruz_num=$vdruz->fetchColumn();//количество приглашений в друзья

echo"у меня  $vdruz_num приглашений в друзья";

$error_array = $pdo->errorInfo();

//надо>0
if($vdruz_num>0){
echo"Вас приглашает в друзья:<br/>";
$druz=$pdo->query("SELECT moy FROM druzyainet WHERE drug='$login' AND net='0' AND da='0' ");
while($line=$druz->fetch(PDO::FETCH_LAZY))
{

$lich->execute(array($line->moy));//для каждого значения из предыдущего запроса
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$login_q=$line->loginp;
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}
echo"login_q<i>$login_q</i>  <br>";//логин
echo"имя<i>$imya</i>  <br>";//имя
echo"Регион<i>$region</i>  <br>";//Регион 
echo"Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"Возраст<i>$vozrast</i>  <br>";//имя
echo"метка группы<i>$metka</i>  <br>";//метка группы 
echo"ип<i>$ipp</i>  <br>";//ип 
echo"фото<i>$limitfoto</i>  <br>";//фото 
echo"о себе<i>$osebe</i>  <br>";//о себе 


//Функция поиска по логину номера из табл регистр с дополнит шифрованием
$l=izloginanomer($login_q,$pdo);//номер пользователя отправившего мне приглашение
echo "***$l***";

echo"<a href='index3.php?vdrugi=$l'>Дружить</a>               <a href='index3.php?nevdrugi=$l'>Отказ</a>";
}
}

?>
</div>


&nbsp;<a href='index.php'>Выход</a><br/>
&nbsp;<b class='s'><script src="time.js"></script></b><br/>

<a href="index7.php">Сообщения</a><br/>
<a href="index11.php">Поиск</a><br/>
<a href="index10.php">Друзья,гости,с кем расторгнуто общение</a><br/>




<script>onLoad=neproch_soobsh();</script>
<script>setInterval('neproch_soobsh()',5000);</script>


</body>


</html>