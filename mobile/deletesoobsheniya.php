

<?php

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";
                                            //модуль с полями для ввода пароля и логина

session_start();//инициируем сессию
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _



$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _
 
 
$strochekparolya=forenter($login,$ip);//для входа

if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}



if($_GET['del'])
{
$del=$_GET['del'];
$del=htmlspecialchars($del);
$del=mysql_real_escape_string($del);//экранирует символы кроме % и _
$login_q=iznomera($del);

 $query="DELETE FROM $userstable1 WHERE otkogo='$login_q' AND  komu='$login'";
$result = mysql_query($query) or die("Удаление1 не получилось");

 $query="DELETE FROM $userstable1 WHERE komu='$login_q' AND otkogo='$login' ";
$result = mysql_query($query) or die("Удаление2 не получилось");

 $query="DELETE FROM $userstable2 WHERE otkogo='$login_q' AND  komu='$login'";
$result = mysql_query($query) or die("Удаление3 не получилось");

 $query="DELETE FROM $userstable2 WHERE komu='$login_q' AND  otkogo='$login'";
$result = mysql_query($query) or die("Удаление4 не получилось");
Header("location:soobsheniya.php");

}

else if($_GET['np']){
$np=$_GET['np'];
$np=htmlspecialchars($np);
$np=mysql_real_escape_string($np);//экранирует символы кроме % и _


$query="DELETE FROM $userstable1 WHERE nomer='$np'";
$result = mysql_query($query) or die("Удаление9 не получилось");
Header("location:soobsheniya.php");

}

else if($_GET['del']==''){
 $query="DELETE FROM $userstable1 WHERE otkogo='' AND  komu='$login'";
$result = mysql_query($query) or die("Удаление5 не получилось");
$query="DELETE FROM $userstable1 WHERE komu='' AND otkogo='$login'";
$result = mysql_query($query) or die("Удаление6 не получилось");
$query="DELETE FROM $userstable2 WHERE otkogo='' AND  komu='$login'";
$result = mysql_query($query) or die("Удаление7 не получилось");
$query="DELETE FROM $userstable2 WHERE komu='' AND otkogo='$login'";
$result = mysql_query($query) or die("Удаление8 не получилось");
Header("location:soobsheniya.php");
}


?>
