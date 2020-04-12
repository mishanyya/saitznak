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
$userstable1 = "lichnoe";//табл с личными данными
$userstable2 = "goroda";//табл с городами
$link = mysqli_connect($sdb_name,$user_name,$user_password,$db_name) or die("Could not connect");//соединение с сервером

mysqli_query($link,"SET CHARACTER SET 'utf8';"); //для кодировки
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
                                                //модуль с полями для ввода пароля и логина
?>
<div class="forma" align="center">
<form action="parolvsp1.php" method="POST" >
<p>Введите email:</p>
<input type="text" required name='login' maxlength='30' size='30'><br/>

<p>Введите  число "2" буквами</p><input type="text" required name=text1 maxlength=10 size=10 autocomplete='off'>
<p>Введите  число "2" цифрами</p><input type="text" required name=text2 maxlength=10 size=10 autocomplete='off'>

<br/><input type="submit"   value="Ввод">
</form>
     </div>                                                




</body>
</html>
