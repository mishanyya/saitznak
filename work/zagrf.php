<?php
include "functions.php";//подключить файл с функциями и постоянными переменными
include "general.php";//присоединить файл с общими функциями мтраниц пользователя сайта
?>


﻿<html>
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>
</head>
	<body>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>
<?php

session_start();//инициируем сессию
							//для входа если есть логин и пароль
 forenter();

 $userstable="fototabl";
$userstable1="lichnoe";

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//функция при открытии проверяет наличие логина и совпадение парол и логина
//($login,$ip,$pdo);
							//возвращает объект с личными данными
$lich=dataFromLogin($login,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY)){
$limitfoto=$line->limitfoto;
}

							//считаем количество имеющихся фотографий и сравниваем их с лимитом
$query=$pdo->prepare("SELECT COUNT(foto) FROM fototabl WHERE loginp=?");
$query->execute(array($login));
$fotoCount=$query->fetchColumn();

echo"<i>У вас $fotoCount фото </i><br/>";
if($fotoCount>=$limitfoto){
exit("<i>Количество загруженных Вами файлов составляет $fotoCount фото. К сожалению, сейчас у нас нет возможности размещать более $limitfoto файлов.</i><br/><a href='index.php' class='naglavnuyu'>На мою страницу</a> ");
}



?>
<b>Размер файла должен быть до 3 Мб </b><br/>
  <form  enctype="multipart/form-data" action="zagrf1.php"  method="post">
  <input  type="hidden" name="MAX_FILE_SIZE" value="3145728"  />
  <input  type="file" name="uploadFile" accept="image/jpeg,image/png,image/gif"/>
  <input  type="submit" name="upload" value="Загрузить" class='small'/>
  </form>

<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>



</html>
