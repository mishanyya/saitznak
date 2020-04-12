<?php
session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем  
$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";
                                           //модуль с полями для ввода пароля и логина
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _
provlogparip($login,$ip,$pdo);//проверка при входе

//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 






$soobsh=$pdo->query("SELECT COUNT(*) FROM soobsheniya WHERE (otkogo='$login' AND komu='$login_q') OR (otkogo='$login_q' AND komu='$login')");
$kolvo=$soobsh->fetchColumn();//количество строк в результате запроса




if(!empty($login_q)&($kolvo>0)){
$s=$kolvo-15;//с какой строки выходит
if($s<0){$s=0;}//для нормального вида ajax сообщений

$query=$pdo->query("SELECT * FROM soobsheniya WHERE  otkogo='$login' AND komu='$login_q'  UNION SELECT * FROM soobsheniya WHERE otkogo='$login_q' AND komu='$login' ORDER BY nomer ASC limit $s,15");
 
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
if($line[1]==$login){
echo"<b class='textno'>$line[0]</b>";
 



$lich->execute(array($line[1]));
while($lines=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$lines->imya;

}

echo"имя<i>$imya</i>  <br/>";//имя
echo"<b class='textsoobout'>$imya</b>";
echo"<b class='textsoobin'></b>";
echo"<b class='textsoob' style='color:red;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='index15.php?np=$line[0]'>Удалить сообщение</a></span></b>";
echo"<b class='textno'>$line[5]</b>";
echo"<br/>";
}
else if($line[1]==$login_q){
echo"<b class='textno'>$line[0]</b>";
$lich->execute(array($line[1]));
while($lines=$lich->fetch(PDO::FETCH_LAZY))
{
$imya1=$lines->imya;
}

echo"имя<i>$imya1</i>  <br>";//имя
echo"<b class='textsoobin'>$imya1</b>";
echo"<b class='textsoob' style='color:blue;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='index15.php?np=$line[0]'>Удалить сообщение</a></span></b>";
echo"<b class='textno'>$line[5]</b>";
echo"<b class='textsoobout'></b>";
echo"<br/>";
}
}
}
else
{
echo"Сообщений еще нет";
}
?>
