<link rel="stylesheet" type="text/css" href="stylesheet.css"/>

<script src="time.js"></script>
<?php

session_destroy();//уничтожить сессию

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "goroda";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки



 
                                                //модуль с полями для ввода пароля и логина
?>
<form action="goroda.php" method="POST" >
<p>Введите регион:</p>
<input type="text" name=login maxlength=100 size=100>



<div><input type="submit"   value="Ввод"></div>

                                                     
<?php

$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=substr($login,0,100);   //обработка при вводе не больше 30 символов


   
   


$result1 = mysql_query("INSERT INTO $userstable (region,gorod) VALUES ('$login', '')");

if ($result1=='true') echo"+";
else echo "-";

?>
</form>