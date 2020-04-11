


<?php

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 


//внесение данных из сессии

//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?");

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

echo"<a href='index2.php'>на мою страницу</a>";

echo"мой login $login";

$lich->execute(array($login));//для каждого значения из предыдущего запроса
while($line_lich=$lich->fetch(PDO::FETCH_LAZY))
{
$moe_imya=$line_lich->imya;
}
echo"имя $moe_imya";


online($login,$pdo);//внесение в онлайн
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 

echo"мой ip $ip <br/>";


//Функция при открытии проверяет наличие логина и совпадение парол и логина

provlogparip($login,$ip,$pdo);

 


echo"&nbsp;<b class='s'>Друзья</b><br/>";

//запрос со списком друзей существует и находится выше
  $druzya=$pdo->query("SELECT drug FROM druzyainet WHERE moy='$login' AND da='1' UNION SELECT moy FROM druzyainet WHERE drug='$login' AND da='1'");
              
while($linedrug=$druzya->fetch(PDO::FETCH_LAZY))
{
$lich->execute(array($linedrug[0]));//для каждого значения из предыдущего запроса
while($line_lich=$lich->fetch(PDO::FETCH_LAZY))
{
$login_q=$line_lich->loginp;
$imya=$line_lich->imya;
$region=$line_lich->region;
$gorod=$line_lich->gorod;
$datarozd=$line_lich->datarozd;
$vozrast=$line_lich->vozrast;
$metka=$line_lich->metkap;
$ipp=$line_lich->ipp;
$limitfoto=$line_lich->limitfoto;
$osebe=$line_lich->osebe;
}

//Функция поиска по логину номера из табл регистр с дополнит шифрованием
$n=izloginanomer($login_q,$pdo);
echo "номер $n логин $login_q imya $imya";
$fotki=glavfoto($login_q,$pdo);
echo $fotki[0];//показывает фото


$isonline=isonline($login_q,$pdo);//если он-лайн то показывает

 echo"<a class='ssylkafriend' href='index5.php?id=$n'>$imya </a>$isonline<br/>"; //показывает ссылку
}
?>
<br/>
&nbsp;<b class='s'>Общение прервано с</b><br/>
<?php
$prerv=$pdo->query("SELECT drug FROM druzyainet WHERE (moy='$login' AND net='1') UNION SELECT moy FROM druzyainet WHERE (drug='$login' AND net='1')");


while($line=$prerv->fetch(PDO::FETCH_LAZY))//выводит строки 
{
$lich->execute(array($line[0]));//для каждого значения из предыдущего запроса
while($line_lich=$lich->fetch(PDO::FETCH_LAZY))
{
$login_q=$line_lich->loginp;
$imya=$line_lich->imya;
$region=$line_lich->region;
$gorod=$line_lich->gorod;
$datarozd=$line_lich->datarozd;
$vozrast=$line_lich->vozrast;
$metka=$line_lich->metkap;
$ipp=$line_lich->ipp;
$limitfoto=$line_lich->limitfoto;
$osebe=$line_lich->osebe;
}
//Функция поиска по логину номера из табл регистр с дополнит шифрованием

$n=izloginanomer($login_q,$pdo);

echo "номер $n логин $login_q ";
$fotki=glavfoto($login_q,$pdo);
echo $fotki[0];//показывает фото

$isonline=isonline($login_q,$pdo);//если он-лайн то показывает

 echo"&nbsp;$imya<a class='black' href='index6.php?radiodrugb=$n'>Возобновить общение</a>$isonline<br/>";

}
?>
&nbsp;<b class='s'>Мои гости</b><br/>
<?php




$gosti=$pdo->query("SELECT  login,data FROM forgostey WHERE login_q='$login' ORDER BY data DESC limit 10");
while($line=$gosti->fetch(PDO::FETCH_LAZY))//выводит строки 
{
$lich->execute(array($line[0]));//для каждого значения из предыдущего запроса
while($line_lich=$lich->fetch(PDO::FETCH_LAZY))
{
$login_1=$line_lich->loginp;
$imya=$line_lich->imya;
$region=$line_lich->region;
$gorod=$line_lich->gorod;
$datarozd=$line_lich->datarozd;
$vozrast=$line_lich->vozrast;
$metka=$line_lich->metkap;
$ipp=$line_lich->ipp;
$limitfoto=$line_lich->limitfoto;
$osebe=$line_lich->osebe;
}

//Функция поиска по логину номера из табл регистр с дополнит шифрованием
$n=izloginanomer($login_1,$pdo);
echo "номер $n логин $login_1 ";
echo "data $line[1] ";
$fotki=glavfoto($login_1,$pdo);
echo $fotki[0];//показывает фото

$isonline=isonline($login_1,$pdo);//если он-лайн то показывает

echo"&nbsp;<a href='index5.php?id=$n'>$imya&nbsp;</a>$isonline<br/>";//ссылка имя и время
}
?>
