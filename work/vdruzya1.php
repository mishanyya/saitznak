<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>﻿
<?php





session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();


$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
							//принять в друзья 
if(isset($_GET['vdrugi'])) 
{ 
$moy_q=$_GET['vdrugi'];
$moy_q=iznomera($moy_q,$pdo);
$moy_q=htmlspecialchars($moy_q);
$query=$pdo->prepare("UPDATE druzyainet SET da='1',net='1' WHERE moy=? AND drug=?");
$query->execute(array($moy_q,$login));
header("location:index.php");
}

							//отклонить запрос в друзья
else if($_GET['nevdrugi']) 
{ 
$moy_q=$_GET['nevdrugi'];
$moy_q=iznomera($moy_q,$pdo);
$moy_q=htmlspecialchars($moy_q);
$query=$pdo->prepare("DELETE FROM druzyainet  WHERE moy=? AND drug=? AND da='0' AND net='0'");
 $query->execute(array($moy_q,$login));
header("location:index.php");
}
?>