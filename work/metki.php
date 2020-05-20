<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
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
	

  
$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);


							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

							//поиск в БД - есть ли мой логин
$query=$pdo->prepare("SELECT COUNT(loginp) FROM metki WHERE loginp=?");
$query->execute(array($login));
$loginCount=$query->fetchColumn();
//если нет,значит я открыт для всех
if($loginCount>0){
echo"&nbsp;Вы заблокированы от всех кроме друзей";
echo"<form method='post' action='metki1.php'>";
echo"&nbsp;<input type='submit' name='metkinet' value='Открыть свою страницу'>";
echo"</form>";

}
else{
echo"<form method='post' action='metki1.php'>";
echo"&nbsp;<input type='submit' name='metki' value='Закрыть досмотр моей страницы для всех кроме друзей - главное фото будет доступно всем'>";
echo"</form>";
}



?>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>


</body>


</html>