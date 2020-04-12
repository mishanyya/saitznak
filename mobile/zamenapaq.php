<link rel="stylesheet" type="text/css" href="style.css"/>
<?php

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

 
                                                //модуль с полями для ввода пароля и логина
?>

<?php


$login=$_POST['logi'];
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начала и конца поля
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text1=substr($text1,0,30);   //обработка при вводе не больше 30 символов

$text2 = $_POST['text2'];//передает значение из поля в переменную
$text2=trim($text2);//убирает пробелы из начала и конца поля
$text2=htmlspecialchars($text2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text2=substr($text2,0,30);   //обработка при вводе не больше 30 символов
   
$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol=substr($parol,0,30);   //обработка при вводе не больше 30 символов
$parol=sha1($parol);// зашифровка  пароля

$parol1 = $_POST['parol1'];//передает значение из поля в переменную
$parol1=trim($parol1);//убирает пробелы из начала и конца поля
$parol1=htmlspecialchars($parol1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol1=substr($parol1,0,30);   //обработка при вводе не больше 30 символов
$parol1=sha1($parol1);// зашифровка  пароля



                                        //модуль вставки данных в таблицу клиента
if(!empty($login)&($parol1==$parol)&($text1=="два")&($text2=="2"))
{

$query="UPDATE $userstable SET parp='$parol1' WHERE loginp='$login'";//запрос на выбор всех записей из таблицы 

$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 

if ($result=='true') {

session_start();
$_SESSION['login']=$login;


$ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$query5="UPDATE $userstable1 SET ipp='$ip' WHERE loginp='$login'";//запрос на внесение ip пользователя
$result5 = mysql_query($query5) or die("Query5 не получилось");

$_SESSION['ip']=$ip;//создается сессия IP

echo"Пароль изменен<a href='/modredpol/index.php'>Дальше</a>";


}
}
else{exit();}     


?>
</form>

