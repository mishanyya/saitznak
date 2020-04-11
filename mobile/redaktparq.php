
<?php


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки



                                                //модуль с полями для ввода пароля и логина
?>




<?php
                                             //модуль ввода данных в переменные 


$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начала и конца поля
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text1=substr($text1,0,30);   //обработка при вводе не больше 30 символов

$text2 = $_POST['text2'];//передает значение из поля в переменную
$text2=trim($text2);//убирает пробелы из начала и конца поля
$text2=htmlspecialchars($text2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text2=substr($text2,0,30);   //обработка при вводе не больше 30 символов
   

$vremparol = $_POST['vremparol'];//передает значение из поля в переменную
$vremparol=trim($vremparol);//убирает пробелы из начала и конца поля
$vremparol=htmlspecialchars($vremparol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$vremparol=substr($vremparol,0,30);   //обработка при вводе не больше 30 символов

$login = $_POST['logi'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение




$query="select loginp from $userstable where loginp='$login'";//запрос на выбор всех записей из таблицы $usertable
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 



if($num_rows=='1'){

$query="SELECT vrepar FROM $userstable WHERE loginp='$login'";
$result = mysql_query($query) or die("Query2 не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
$vrepar=$line[0];  //врем пароль пользователя входит в переменную 
}

if(!empty($vrepar)&($text1=="два")&($text2=="2")&($vremparol==$vrepar))
{
Header("Location: zamenapa.php?a=$login");
}
        
}
?>
