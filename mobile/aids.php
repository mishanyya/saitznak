<html>
	
<head>
 <meta name="Keywords" content="ВИЧ знакомства "/>
 <meta name="Description" content="Сайт знакомств для ВИЧ-положительных"/>
<title>	Знакомства ВИЧ | ВИЧ знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<h1 align="center">"Вместе просто"-сайт знакомств и общения для всех</h1>
<h1>Мы рады приветствовать Вас в Группе для ВИЧ-положительных людей сайта знакомств "Вместе просто"</h1>
<h2>При регистрации в группе для знакомств людей с ВИЧ вы сможете найти и общаться с другими ВИЧ положительными людьми,
при этом на самом сайте о ВИЧ нет ни слова, только вы сможете видеть людей из группы с ВИЧ и Вас увидят люди из Вашей группы</h2>
<h3>На сайте существуют и не ВИЧ-инфицированные люди, даже если они увидят Вас и будут с Вами общаться-им о подобных группах неизвестно,
для них Вы будете как все</h3>
<h4>Перед регистрацией уведомляем:</h4>
<ul>
<li>Соблюдайте правила общения</li>
<li>Помните , что вся информация, которую Вы разместите может быть использована посторонними лицами, поэтому размещайте информацию осознанно</li>
 <li>Администрация сайта за размещенную пользователями информацию, а также возможные последствия размещения пользователями информации ответственности не несет</li>
<li>В случае согласия с вышенаписанным предлагаем Вам зарегистрироваться</li>
</ul>

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
<form action="/modvhodreg/aids1.php" method="POST" >

<p>Введите email для регистрации:</p>
<input type="text" required name=login maxlength=30 size=30><br/>

<p>Введите  число "2" буквами</p><input type="text" required name=text1 maxlength=10 size=10 autocomplete="off">
<p>Введите  число "2" цифрами</p><input type="text" required name=text2 maxlength=10 size=10 autocomplete="off">
<br/>
<div><input type="submit"   value="Ввод"></div>
<p><a href='/index.php'>Страница входа и регистрации для всех остальных</a></p>
</form>
 </div>                                                    

</body>
</html>