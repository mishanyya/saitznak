﻿<?php
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";//табл 
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
                                                //модуль с полями для ввода пароля и логина
?>
<?php
//email-пользователя
                                             //модуль ввода данных в переменные 

$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начала и конца поля
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text1=substr($text1,0,30);   //обработка при вводе не больше 30 символов

$text2 = $_POST['text2'];//передает значение из поля в переменную
$text2=trim($text2);//убирает пробелы из начала и конца поля
$text2=htmlspecialchars($text2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text2=substr($text2,0,30);   //обработка при вводе не больше 30 символов
   
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=substr($login,0,30);   //обработка при вводе не больше 30 символов
$login=base64_encode($login);//шифрование

$query="select loginp from $userstable where loginp='$login'";//запрос на выбор всех записей из таблицы $usertable1
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 

                                        //модуль вставки данных в таблицу клиента
if(!empty($login)&($text1=="два")&($text2=="2")&($num_rows==0))
{
$vremen=rand(); //временный пароль дл замены пароля потом число можно вставить и заменять, а пока так

$address =base64_decode($login); //адрес кому отправляется письмо 

$sub = "Это сообщение с моего сайта Зарегистрироваться";

$mes = "Ваш временный пароль http://volgaplastic.16mb.com/modvhodreg/redaktpar1.php?a=$login&b=$vremen \nРегистрация </a>\n";



$send = mail ($address, $sub, $mes,"From:admin@volgaplastic.16mb.com"); 


$result = mysql_query("INSERT INTO $userstable (nomp,loginp,parp,vrepar) VALUES (NULL, '$login','не задано', '$vremen')");

$result2 = mysql_query("INSERT INTO $userstable1 (loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto) VALUES ('$login', '','','',NOW(),'','0','','10')");

//Если запрос пройдет успешно то в переменную result вернется true
if($result == 'true') 
{echo "Ваш логин  введен ";}
else{echo "Ваш логин не введен";}

 if (($send == 'true')&($result == 'true'))
{
Header("Location: redaktpar1.php");
}
  
else{echo "Сообщение не  отправлено!";}

}//окончание цикла

else{Header("Location: registr.php");exit();}

          


?>
</form>

