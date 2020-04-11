


<?php

session_start();//инициируем сессию   



include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "lichnoe";//табл с личными данными
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit();}  
       //модуль с полями для ввода пароля и логина


    //модуль с полями для редактирования




$imya=$_POST['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода 

$imya=mysql_real_escape_string($imya);//экранирует символы кроме % и _


 $region=$_POST['region']; 
$region=htmlspecialchars($region);
$region=mysql_real_escape_string($region);//экранирует символы кроме % и _

$gorod=$_POST['gorod'];
$gorod=trim($gorod);//убирает пробелы из начала и конца поля
$gorod=htmlspecialchars($gorod);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$gorod=mysql_real_escape_string($gorod);//экранирует символы кроме % и _

$god=$_POST['god'];
$god=trim($god);//убирает пробелы из начала и конца поля
$god=htmlspecialchars($god);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$god=mysql_real_escape_string($god);//экранирует символы кроме % и _
	
$pol=$_POST['pol']; 
$pol=htmlspecialchars($pol);

$mesyatc=$_POST['mesyatc'];
$mesyatc=trim($mesyatc);//убирает пробелы из начала и конца поля
$mesyatc=htmlspecialchars($mesyatc);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$mesyatc=mysql_real_escape_string($mesyatc);//экранирует символы кроме % и _

if($mesyatc<10){$mesyatc="0".$mesyatc;} //если число=1 делаем= 01

$lengthmesyatc=strlen($mesyatc);
if($lengthmesyatc>2){$mesyatc=substr($mesyatc,1,2);} //если число=001 делаем= 01


$chislo=$_POST['chislo'];
$chislo=trim($chislo);//убирает пробелы из начала и конца поля
$chislo=htmlspecialchars($chislo);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$chislo=mysql_real_escape_string($chislo);//экранирует символы кроме % и _

$osebe=$_POST['osebe'];
$osebe=trim($osebe);//убирает пробелы из начала и конца поля
$osebe=htmlspecialchars($osebe);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$osebe=mysql_real_escape_string($osebe);//экранирует символы кроме % и _




$datarozd=$god."-".$mesyatc."-".$chislo;   //дата рождения


$vozrast=raznitcavozrasta($god,$mesyatc,$chislo);



if (isset($_POST['lich']))
{

$lich=$_POST['lich'];
$lich=htmlspecialchars($lich);
$lich=mysql_real_escape_string($lich);//экранирует символы кроме % и _

if($imya==''){exit("<a href='/modredpol/lichnoe.php'>Введите имя</a>");}

                                        //модуль вставки данных в таблицу клиента
$query="UPDATE lichnoe SET imya='$imya',region='$region' ,gorod='$gorod',datarozd='$datarozd',vozrast='$vozrast',osebe='$osebe',pol='$pol' WHERE loginp='$login'";
$result = mysql_query($query) or die("Query1 не получилось");

}


header("location:index.php");
?>

