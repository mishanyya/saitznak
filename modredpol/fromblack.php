<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>
	
<head>

<title>	Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>

<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>


	<body>

<?php



session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
 $login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

$metkap=$_SESSION['metkap'];   //номер пользователя входит в переменную 

							//если по ссылке восстановить общение
if($_POST["radiodrugb"]) 
{ 
$n=$_POST["radiodrugb"]; 
$login_q=iznomera($n,$pdo);
$login_q=trim($login_q);
$login_q=htmlspecialchars($login_q);
$_SESSION['login_q']=$login_q;

}
else if(isset($_SESSION['login_q']))
{
$login_q=$_SESSION['login_q'];
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
}
else{
header("location:index.php");
}


$query=$pdo->prepare("DELETE FROM druzyainet WHERE moy=? AND drug=? AND da='0' AND net='1'");
$query->execute(array($login,$login_q));

echo"<a href='index.php'>Удален из черного списка-> на главную</a>";
?>
</body>
</html>