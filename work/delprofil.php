<?php
include ("../time.php");//подключить файл с функциями и постоянными переменными
?>


﻿<html>
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
<a href='index.php'><img src='/modredpol/fotosait/VP.png' class='emblema'/></a>
<?php
session_start();//инициируем сессию
							//для входа если есть логин и пароль
 forenter();



$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение


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
