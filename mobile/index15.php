

<?php

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем                        
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";
                                            //модуль с полями для ввода пароля и логина


$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _



$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _
 
 

provlogparip($login,$ip,$pdo);//проверка при входе


//удалить переписку
if($_GET['del'])
{
$del=$_GET['del'];
$del=htmlspecialchars($del);
$del=mysql_real_escape_string($del);//экранирует символы кроме % и _
$login_q=iznomera($del,$pdo);

$query=$pdo->exec("DELETE FROM soobsheniya WHERE otkogo='$login_q' AND  komu='$login'");

$query=$pdo->exec("DELETE FROM soobsheniya WHERE komu='$login_q' AND otkogo='$login'"); 

$query=$pdo->exec("DELETE FROM adresatsms WHERE otkogo='$login_q' AND  komu='$login'"); 

$query=$pdo->exec("DELETE FROM adresatsms WHERE komu='$login_q' AND  otkogo='$login'");

Header("location:index7.php");

}

//удалить сообщение
else if($_GET['np']){
$np=$_GET['np'];
$np=htmlspecialchars($np);
$np=mysql_real_escape_string($np);//экранирует символы кроме % и _

$query=$pdo->exec("DELETE FROM soobsheniya WHERE nomer='$np'");


Header("location:index7.php");

}

else if($_GET['del']==''){

$query=$pdo->exec("DELETE FROM soobsheniya WHERE otkogo='' AND  komu='$login'");


$query=$pdo->exec("DELETE FROM soobsheniya WHERE komu='' AND otkogo='$login'");


$query=$pdo->exec("DELETE FROM adresatsms WHERE otkogo='' AND  komu='$login'");


$query=$pdo->exec("DELETE FROM adresatsms WHERE komu='' AND otkogo='$login'");


Header("location:index7.php");
}


?>
