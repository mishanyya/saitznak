<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

﻿<html>	
<head>
<title>Сайт знакомств</title>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>
<?php
						  
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$metkap=$_SESSION['metkap'];//моя группа



							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

$anketa=$pdo->prepare("SELECT obrazovanie,zanyatiya,prozhivanie,deti,uvlechenie,privichki,dopolnitelno FROM anketa WHERE loginp=? LIMIT 1");
$anketa->execute(array($login));

while($line=$anketa->fetch(PDO::FETCH_LAZY)) {
$obrazovanie=$line->obrazovanie;
$zanyatiya=$line->zanyatiya;
$prozhivanie=$line->prozhivanie;
$deti=$line->deti;
$uvlechenie=$line->uvlechenie;
$privichki=$line->privichki;
$dopolnitelno=$line->dopolnitelno;

}
?>


<form action="anketa1.php"  method="POST"/>
<p>Образование<textarea name="obrazovanie" class="anketatextarea"><?php if(isset($obrazovanie))echo $obrazovanie;?></textarea></p> 
<p>Занятие<textarea name="zanyatiya" class="anketatextarea"><?php if(isset($zanyatiya))echo $zanyatiya;?></textarea></p> 
<p>Проживание<textarea name="prozhivanie" class="anketatextarea"><?php if(isset($prozhivanie))echo $prozhivanie;?></textarea></p>   
<p>Дети<textarea name="deti" class="anketatextarea"><?php if(isset($deti))echo $deti;?></textarea></p>   
<p>Увлечение<textarea name="uvlechenie" class="anketatextarea"><?php if(isset($uvlechenie))echo $uvlechenie;?></textarea></p> 
<p>Привычки<textarea name="privichki" class="anketatextarea"><?php if(isset($privichki))echo $privichki;?></textarea></p>   
<p>Дополнительно<textarea name="dopolnitelno" class="anketatextarea"><?php if(isset($dopolnitelno))echo $dopolnitelno;?></textarea></p>   
<input type="submit" value="Внести данные в анкету"/>
</form>




<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>
</html>