<html>	
<head>
<title>	Знакомства</title>
<script src="poiskimya.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="opisanie.js" type="text/javascript"></script>
<script src="myslipolzovatelya.js" type="text/javascript"></script>
<script src="neproch_soobsh.js" type="text/javascript"></script>

<script src="izlivinput.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>



<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php
session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем         

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл сообщений
$userstable5 = "forgostey";//табл гостей
$userstable6 = "statusp";//табл с мыслями
$userstable7 = "polzovateli";//табл 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

online($login,$pdo);//внесение в онлайн

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 


provlogparip($login,$ip,$pdo);//проверка при входе

//проверяется на блокировку администратором
blocked($login,$pdo);

unset($_SESSION['login_q']); 

$folder1 = '/fotosait/';//папка для выгрузки файлов

$login=$_SESSION['login'];   //номер пользователя входит в переменную     //модуль с полями для ввода пароля и логина

$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 


$query=$pdo->query("SELECT metkap FROM lichnoe WHERE loginp='$login'");

while($num_rows=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
$metkap=$num_rows->metkap;  //метка пользователя входит в переменную 
}

$_SESSION['metkap']=$metkap; 



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
$pol=$line->pol;
}

echo"имя<i>$imya</i>  <br>";//имя
echo"Регион<i>$region</i>  <br>";//Регион 
echo"Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"имя<i>$vozrast</i>  <br>";//имя
echo"метка группы<i>$metka</i>  <br>";//метка группы 
echo"ип<i>$ipp</i>  <br>";//ип 
echo"<i>$limitfoto</i>  <br>";//фото 
echo"о себе<i>$osebe</i>  <br>";//о себе 
echo"пол<i>$pol</i>  <br>";//пол



if($pol=='Ж'){echo"<i>Уважаемая $imya</i>  <br>";}//Пол
else{echo"<i>Уважаемый $imya</i>  <br>";}


?>

Сайт создан командой энтузиастов за свой счет, но на техническую поддержку сайта и его развитие необходимы финансовые средства.
Будем Вам благодарны за любую финансовую поддержку содержания и развития данного ресурса.
<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="hidden" name="ik_co_id" value="559d716b3b1eaf99038b456b" />
	<input type="hidden" name="ik_pm_no" value="ID_4233" />
	<i>Сумма которую Вы сможете внести (в российских рублях)</i><input type="text" name="ik_am"/>
	<input type="hidden" name="ik_cur" value="RUB" />
	<input type="hidden" name="ik_desc" value="Event Description" />
        <input type="submit" value="Внести">
</form>


<a href='index2.php'>На мою страницу</a>
</body>


</html>