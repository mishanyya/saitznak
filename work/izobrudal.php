<?php
include "functions.php";//подключить файл с функциями и постоянными переменными
include "general.php";//присоединить файл с общими функциями мтраниц пользователя сайта
?>


﻿<html>
<head>
<title>Загрузка фото</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>
</head>
	<body>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>

<form action="izobrudal1.php" method="POST" class='mesimg'>

<?php




session_start();//инициируем сессию
							//для входа если есть логин и пароль
 forenter();

$userstable="fototabl";



$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение




$ip=$_SESSION['ip'];

$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение


//функция при открытии проверяет наличие логина и совпадение парол и логина
//($login,$ip,$pdo);




//выбор из БД всех фотографий пользователя
$query=$pdo->prepare("SELECT loginp,foto,metka,opisanie,ponravilos,nom,data FROM fototabl WHERE loginp=?");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
//echo "<br/>";
$v=$line[1];
?>
&nbsp;<input type="radio" name=dfile[]  <?php if($line[2]=='glav'){echo "checked";}?> value="<?php echo $v ?>" />

<?php
$opisanie=$line[3];

//echo "Описание фото: $opisanie<br/>";
//echo "ponravilos: $line[4]<br/>";
$fotki=$folder1.$line[1];
?>

<a href='#'><img src="<?php echo $fotki; ?>"/ ></a>
<?php

}

?>




<div id="opisan"></div>

<input type="button"  value="Добавить описание к фото" onclick="opisanie()"/>
<br/>
<input type="submit"  value="Удалить" name="udal"/>
<br/>
<input type="submit"  value="Отключить показ главной фотографии"  name="pokaz"/>
<br/>
<input type="submit"  value="Сделать главной"  name="glav" >

<br/>
<a href="zagrf.php">Загрузить фото</a>
<br/>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</form>







</body>


</html>
