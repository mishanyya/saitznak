
<link rel="stylesheet" type="text/css" href="style.css"/>

<?php
session_start();
unset($_SESSION['login']);//обнулить сессии

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
   
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$login=substr($login,0,30);   //обработка при вводе не больше 30 символов
$login=base64_encode($login);//шифрование

$query="select loginp from $userstable where loginp='$login'";//запрос на выбор всех записей из таблицы $usertable1
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса 


//проверяет подтвержден email или нет, если "1" то  проверен
$query="SELECT proveren FROM $userstable where loginp='$login' AND proveren='1'";//запрос на выбор всех записей из таблицы $usertable1
$result=mysql_query($query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows_proveren = mysql_num_rows($result);//возвращает лоличество рядов результата запроса 

//if($num_rows_proveren!='1'){echo"email не подтвержден<br/>";}//если не проверен то выход




                                        //модуль вставки данных в таблицу клиента
if(!empty($login)&($text1=="два")&($text2=="2")&($num_rows=='1')&($num_rows_proveren=='0'))//поменять 0 на 1 после проверки
{

$vremen=rand(); //временный пароль для замены пароля 

$address =base64_decode($login); //адрес кому отправляется письмо 

$sub = "Это сообщение с моего сайта вспомнить пароль";

$mes = "Пройдите пожалуйста по ссылке для ввода нового пароля http://vmesteprosto.info/modvhodreg/redaktpar.php?a=$login&b=$vremen \n";
  
 
  

$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
$headers .= "From: <admin@vmesteprosto.info>\r\n"; 


$send = mail ($address, $sub, $mes,$headers);  
 


$result = mysql_query("UPDATE $userstable SET vrepar='$vremen' WHERE loginp='$login'");
//Если запрос пройдет успешно то в переменную result вернется true


if (/*($send == 'true')&*/($result == 'true'))
{
session_start();
$_SESSION['login']=$login;



//отправка сообщения администратору о запросе пароля
$ads ='admin@vmesteprosto.info'; //адрес кому отправляется письмо 

$sub = "Это запрос пользователя вспомнить пароль";

$mes = " $login   base64_decode($login) запросил временный пароль \n";
  
 
  


$hea  = "Content-type: text/html; charset=utf-8 \r\n"; 
$hea .= "From: <admin@vmesteprosto.info>\r\n"; 


$send1 = mail ($ads, $sub, $mes,$hea);  








//Header("Location: redaktpar.php");
//echo "для $address <br/>  Сообщение  отправлено!<br/> Пройдите по <a href='redaktpar.php?ar=$login&br=$vremen'>ссылке</a> для ввода нового пароля, если сообщение не пришло ";
echo "для $address <br/>  Сообщение  отправлено!<br/>Сообщение для смены пароля придет в течение некоторого времени, в зависимости от загрузки сети.<br/><a href='/index.php'>на страницу ввода</a>";




}
else 
{
echo "для $address   Сообщение не отправлено! ";

}      


}//окончание цикла


?>

