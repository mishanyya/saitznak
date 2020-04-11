<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
Подсистема защиты от несанкционированного доступа к данным <br>
<script src="time.js"></script>
<form >
<?php 



include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки


                                                                     //модуль ввода введеных логина и пароля в переменные
$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol=substr($parol,0,30);   //обработка при вводе не больше 30 символов

$parol=sha1($parol);// зашифровка пароля
                                                                                               
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);
$login=substr($login,0,30);//обработка при вводе не больше 30 символов


 //модуль внесения логина и пароля из переменной в сессию
session_start();//инициируем сессию   
$_SESSION['login']=$login;//создается сессия логина
$_SESSION['parol']=$parol;//создается сессия пароля





if(empty($login)) 
 {Header("Location: index.php");
 } //чтобы не отправить пустое поле
                                                                       
                                                                      //модуль поиска логина и пароля в базе данных
$result=mysql_query("SELECT loginp FROM $userstable WHERE loginp='$login'");//выбор поля loginp из табл. polzovateli где значение поля loginp= введеному в поле login для входа
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0        		

if($num_rows==0){Header("Location: registr.php");}//переход на страницу пользователя для рег

 else if($num_rows>0)
 {
$query="SELECT parp FROM $userstable WHERE loginp='$login'AND parp='$parol'";
$result1 = mysql_query($query) or die("Query1 не получилось");
 $num_rows1 = mysql_num_rows($result1);
//выбор поля parol из табл. admin где значение поля parol= введеному в поле parol для входа
  if($num_rows1>0){

$query2="SELECT nomp FROM $userstable WHERE loginp='$login'AND parp='$parol'";
$result2 = mysql_query($query2) or die("Query2 не получилось");
while($line2=mysql_fetch_row($result2))//выводит строки пока они не кончатся в бд
{
echo"$line2[0]";
$nomp=$line2[0];  //номер пользователя входит в переменную 
}

$_SESSION['nomp']=$nomp;   //номер пользователя входит  в сессию

 $ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$query5="UPDATE $userstable SET ipp='$ip' WHERE loginp='$login'AND parp='$parol'";//запрос на внесение ip пользователя
$result5 = mysql_query($query5) or die("Query5 не получилось");


Header("Location:/modredpol/stranica.php");}//переход на страницу пользователя
else{/*Header("Location: index.php");*/
echo"Вспомнить пароль";

$query3="SELECT nomp FROM $userstable WHERE loginp='$login'";
$result3 = mysql_query($query3) or die("Query3 не получилось");
while($line3=mysql_fetch_row($result3))//выводит строки пока они не кончатся в бд
{
echo"$line3[0]";
$nomp=$line3[0];  //номер пользователя входит в переменную 
}

$_SESSION['nomp']=$nomp;   //номер пользователя входит  в сессию

                  }
 }
 else
 {
echo"Вспомнить пароль";
$query4="SELECT nomp FROM $userstable WHERE loginp='$login'";
$result4 = mysql_query($query4) or die("Query4 не получилось");
while($line4=mysql_fetch_row($result4))//выводит строки пока они не кончатся в бд
{
echo"$line4[0]";
$nomp=$line4[0];  //номер пользователя входит в переменную 
}

$_SESSION['nomp']=$nomp;   //номер пользователя входит  в сессию
}    
  


              
?>
<a href="parolvsp.php">Вспомнить пароль</a>
</form> 
    
