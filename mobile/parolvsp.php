<html>
	
<head>

<title>Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>


<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<h1 align="center">"Вместе Просто"-сайт знакомств и общения</h1>
<?php
session_start();
unset($_SESSION['login']);//обнулить сессии

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

                                                //модуль с полями для ввода пароля и логина
?>
<p>вспомнить пароль</p>
<div class="forma" align="center">
<form action="parolvspq.php" method="POST" >
<p>Введите email:</p>
<input type="text" required name="login" maxlength=30 size=30><br/>

<p>Введите  число "2" буквами</p><input type="text"  required name="text1" maxlength=10 size=10 autocomplete='off'><br>
<p>Введите  число "2" цифрами</p><input type="text"  required name="text2" maxlength=10 size=10 autocomplete='off'><br>

<input type="submit"   value="Вспомнить пароль">
<br/>
<p><a href='/index.php'>Ввести логин и пароль</a></p>
</form>

</div> 

</body>
</html>