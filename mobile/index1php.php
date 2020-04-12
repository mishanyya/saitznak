<?php
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

                                                //модуль с полями для ввода пароля и логина






$skakogo=$_GET['skakogo'];



 $query="SELECT * FROM lichnoe limit $skakogo,5 ";
$result=mysql_query($query);




while($line=mysql_fetch_row($result))
{
echo"$line[0] <+>";
echo"$line[1] <+>";
echo"$line[2] k <+><br/>";
}

?>

