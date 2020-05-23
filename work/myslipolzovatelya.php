<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         



session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
							//функция при открытии проверяет наличие логина и совпадение парол и логина
($login,$ip,$pdo);

$text=$_POST['text'];
$text=htmlspecialchars($text);
							//вставляет лозунг пользователя
$query=$pdo->prepare("INSERT INTO statusp (nomp,login,texts,data)VALUES(NULL,?,?,NOW())");
$query->execute(array($login,$text));
echo"ваша мысль ' $text ' опубликована";

?>


