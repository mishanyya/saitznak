<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
							//удалить переписку
if(isset($_GET['del']))
{
$del=$_GET['del'];
$del=htmlspecialchars($del);
 
$login_q=iznomera($del,$pdo);

$query=$pdo->prepare("DELETE FROM soobsheniya WHERE (otkogo=? AND  komu=?) OR (komu=? AND otkogo=?) ");
$query->execute(array($login_q,$login,$login_q,$login));

$query=$pdo->prepare("DELETE FROM adresatsms WHERE (otkogo=? AND  komu=?) OR (komu=? AND otkogo=?) ");
$query->execute(array($login_q,$login,$login_q,$login));
}
							//удалить одно сообщение
else if(isset($_GET['ns'])){
$ns=$_GET['ns'];
$ns=htmlspecialchars($ns);

$query=$pdo->prepare("DELETE FROM soobsheniya WHERE nomer=?");
$query->execute(array($ns));
}
							//удалить переписку с пустым пользователем?????
else if($_GET['del']==''){
 $query=$pdo->prepare("DELETE FROM soobsheniya WHERE (otkogo='' AND  komu=?) OR (komu='' AND otkogo=?)");
 $query->execute(array($login,$login));
$query=$pdo->prepare("DELETE FROM adresatsms WHERE (otkogo='' AND  komu=?) OR (komu='' AND otkogo=?)");
  $query->execute(array($login,$login));
}
header("location:soobsheniya.php");
?>