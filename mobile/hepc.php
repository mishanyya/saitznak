<html>
	
<head>

<title>	Знакомства Гепатит C | Гепатит С знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<h1 align="center">"VSE VMESTE"-сайт знакомств и общения для всех, в том числе и ВИЧ-инфицированных</h1>




<?php
session_start();
unset($_SESSION['login']);//обнулить сессии

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";//табл с личными данными
$userstable2 = "goroda";//табл с городами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
                                                //модуль с полями для ввода пароля и логина
?>
<div class="forma" align="center">
<form action="/modvhodreg/hepc1.php" method="POST" >
<p>Введите email:</p>
<input type="text" required name=login maxlength=30 size=30><br/>

<p>Введите  число "2" буквами</p><input type="text" required name=text1 maxlength=10 size=10>
<p>Введите  число "2" цифрами</p><input type="text" required name=text2 maxlength=10 size=10>

<div><input type="submit"   value="Ввод"></div>
</form>
     </div>                                                
</body>
</html>
