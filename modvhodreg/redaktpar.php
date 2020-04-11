<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


<link rel="stylesheet" type="text/css" href="/style.css"/>
<?php
               

							//если по почте пришло
if(isset($_GET['a'])&&(isset($_GET['b'])))
{
$login=$_GET['a']; 
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$vremparol=$_GET['b']; 
$vremparol=trim($vremparol);//убирает пробелы из начала и конца поля
$vremparol=htmlspecialchars($vremparol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
}
							//если вход напрямую
else{
exit("<a href='/index.php'>войти на сайт</a>");
}							

							//поиск логин с врем.паролем в таблице
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE (loginp=? AND vrepar=?)");
$query->execute(array($login,$vremparol));
$loginCount=$query->fetchColumn();
							//если нет совпадений логина и временного пароля
if($loginCount<1)
{
exit("логин или временный пароль введены не верно <a href='parolvsp.php'>попробуйте еще раз</a>");
}
							//если есть совпадения
else{
header("location:zamenapa.php?ab=$login");
}
?>



