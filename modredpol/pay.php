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

<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>



<a href='index.php'><img src='/modredpol/fotosait/VP.png' class='emblema'/></a>
<?php




session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
$login=htmlspecialchars($login);


$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

$imya=$_SESSION['imya'];
$imya=htmlspecialchars($imya);

							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);


$pol=$_SESSION['pol'];
$pol=htmlspecialchars($pol);


if($pol=='Ж'){echo"<i>Уважаемая $imya</i>  <br>";}
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


<a href='index.php'>На мою страницу</a>
</body>


</html>