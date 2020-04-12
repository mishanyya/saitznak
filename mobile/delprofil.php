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




<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php
//инициируем сессию  
session_start(); 


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу


$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
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

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

$block=blocked ($login);
if($block==1){echo "<b class='s'>Страница закрыта для всех,кроме друзей</b><br/>";}

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}

unset($_SESSION['login_q']); 

//$folder1 = '/fotosait/';//папка для выгрузки файлов

/*$login=$_SESSION['login'];   //номер пользователя входит в переменную     //модуль с полями для ввода пароля и логина

$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 
*/
$array=imyaizlogina($login);
echo"<i>$array[0]</i>  ";
?>





Вы точно хотите удалить свой аккаунт,может останетесь?Если Вы точно решили удалиться , то ставим Вас в известность, что услуга платная и ее стоимость составляет 50 российских рублей без учета 
комиссий платежной системы и ее партнеров.

<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="hidden" name="ik_co_id" value="559d716b3b1eaf99038b456b" />
	<input type="hidden" name="ik_pm_no" value="ID_4233" />
	<input type="hidden" name="ik_am" value="50.00" />
	<input type="hidden" name="ik_cur" value="RUB" />
	<input type="hidden" name="ik_desc" value="Event Description" />
	<input type="hidden" name="ik_suc_u" value="http://vmesteprosto.info/modredpol/delprofiludachno.php" />
	<input type="hidden" name="ik_suc_m" value="post" />
	<input type="hidden" name="ik_fal_u" value="http://vmesteprosto.info/modredpol/delprofilneudachno.php" />
	<input type="hidden" name="ik_fal_m" value="post" />
	<input type="hidden" name="ik_pnd_u" value="http://vmesteprosto.info/modredpol/delprofilozhidanie.php" />
	<input type="hidden" name="ik_pnd_m" value="post" />
	<input type="hidden" name="ik_exp" value="2015-07-10" />
	<input type="hidden" name="ik_ltm" value="604800" />
	<input type="hidden" name="ik_loc" value="ru" />
	<input type="hidden" name="ik_enc" value="utf-8" />
	<input type="hidden" name="ik_int" value="web" />
	<input type="hidden" name="ik_am_t" value="payway" />
        <input type="submit" value="Удалить свой аккаунт">
</form>

<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>


</html>