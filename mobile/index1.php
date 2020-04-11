<?php

//показывать ошибки

ini_set("display_errors",1);
error_reporting(E_ALL);

//общие данные подключения

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      

//в PDO названия таблиц надо вставлять без кавычек

/*$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";//табл с личными данными
$userstable2 = "adminblockedlog";//таблица блокировки администратором
*/

//модуль внесения логина и пароля из переменной в сессию

$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование
 
 //модуль ввода введеных логина и пароля в переменные

$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$parol=substr($parol,0,30);   //обработка при вводе не больше 30 символов
$parol=sha1($parol);// зашифровка пароля                                                                                   

//проверяет логин пользователя на блокировку администратором при входе

blocked($login,$pdo);

//количество попыток входа

$num = $pdo->query("SELECT COUNT(loginp) FROM polzovateli WHERE loginp='$login'");//выполнение запроса вывод количества строк pdo
$num_rows=$num->fetchColumn();
 $error_array = $pdo->errorInfo();
//выбор поля loginp из табл. polzovateli где значение поля loginp= введеному в поле login для входа
//echo"количество строк с таким логином num_rows $num_rows .";     		
if($num_rows==0)
{//если нет логина в базе данных
echo"<a href='/mobile/.php'> Зарегистрируйтесь</a><br/>";
}//переход на страницу пользователя для рег
else if($num_rows>0)  //если логин есть в базе
 {
$num_rows1 = $pdo->query("SELECT parp,nomp FROM polzovateli WHERE loginp='$login'");
while ($row = $num_rows1->fetch(PDO::FETCH_LAZY))
{
$parp=$row->parp;  //пароль пользователя входит в переменную 
$np=$row->nomp;  //номер пользователя входит в переменную 
$_SESSION['np']=$np;//создается сессия номера пользователя
}
  if($parp==$parol)//выбор поля parol из табл. admin где значение поля parol= введеному в поле parol для входа
{//если введеный и из базы пароли совпадают 
 $ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$query = $pdo->query("UPDATE lichnoe SET ipp='$ip' WHERE loginp='$login'");//запрос на внесение ip пользователя
$_SESSION['login']=$login;//создается сессия логина
$_SESSION['ip']=$ip;//создается сессия IP
header("location:index2.php");
}
else {//если не совпали пароли
// попытка_ввести_пароль_3_раза
$query=$pdo->query("SELECT COUNT(times) FROM threetimesblock WHERE loginr='$login'");
$kol=$query->fetchColumn();//сколько строк в таблице с таким логином из одного поля
//echo"/количество полей с логином $kol /";
if($kol=='0')//если в таблице нет такого логина
{
$ip=$_SERVER['REMOTE_ADDR'];//получение ip
$query=$pdo->query("INSERT INTO threetimesblock (nomer,loginr,ip,timer,parol,times)VALUES(NULL,'$login','$ip',NOW(),'$parol','0')");
echo"<a href='/mobile/index.php'>Попробуйте снова</a>";
}
else //если есть такой логин
{
$time = $pdo->query("SELECT times FROM threetimesblock WHERE loginr='$login'");
while ($line = $time->fetch(PDO::FETCH_LAZY))
{
$times=$line->times;  //количество произведенных попыток 
}
//echo"* сколько попыток было  $times *";
if($times>2)//если было больше двух попыток
{
$query=$pdo->query("SELECT COUNT(times) FROM threetimesblock WHERE loginr='$login' AND (timer BETWEEN (NOW()-INTERVAL '5' MINUTE) AND NOW())");
//выбрать количество строк  с данным логином и временем не больше 5 минут после попытки
$kolss=$query->fetchColumn();//сколько строк в таблице с таким логином из одного поля
echo"- $kolss -";
if($kolss>0){exit("Ваши попытки для входа прошли , подождите пожалуйста 5 минут и <a href='/mobile/index.php'>Попробуйте снова</a>");}
else if($kolss=='0'){//3 попытки и 5 минут прошли обнуляем количество попыток
$query=$pdo->query("UPDATE threetimesblock SET timer=NOW(),times='0' WHERE loginr='$login'");
}
}//если было больше двух попыток
else if($times<3){//если было меньше трех попыток
$times++;
$query=$pdo->query("UPDATE threetimesblock SET timer=NOW(),times='$times' WHERE loginr='$login'");//прибавляем на одну число попыток
echo"<a href='/mobile/index.php'>Попробуйте снова</a>";
}//если было меньше трех попыток
}//если есть такой логин
}//если не совпали пароли
}                                  
                       
?> 

