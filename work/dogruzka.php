<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>
<script src="deletemessage.js"></script>
﻿<?php
      

                                                //модуль с полями для ввода пароля и логина



session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();						
							//логин и ип выводим из сессии
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);

													
$imya=$_SESSION['imya'];
$imya=htmlspecialchars($imya);

$glavfoto=$_SESSION['glavfoto'];
$glavfoto=htmlspecialchars($glavfoto);
$glavfoto_q=$_SESSION['glavfoto_q'];
$glavfoto_q=htmlspecialchars($glavfoto_q);

							//выводим данные адресата 
$lich=dataFromLogin($login_q,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_q=$line->imya;
$region_q=$line->region;
$gorod_q=$line->gorod;
$datarozd_q=$line->datarozd;
$vozrast_q=$line->vozrast;
$metka_q=$line->metkap;
$ipp_q=$line->ipp;
$limitfoto_q=$line->limitfoto;
$osebe_q=$line->osebe;
}


								

							//Функция при открытии проверяет наличие логина и совпадение парол и логина
($login,$ip,$pdo);					
 
$skolko=$_GET['skolko'];
$skolko=htmlspecialchars($skolko);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение




$skakogo=$_GET['skakogo'];
$skakogo=htmlspecialchars($skakogo);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



if($skakogo<0){$skakogo=0;}

$dostroki=$_GET['dostroki'];
$dostroki=htmlspecialchars($dostroki);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение




if($skolko>$dostroki){$skolko=$dostroki;}

							//выбор сообщений от меня к нему и от него мне
$query=$pdo->prepare("SELECT nomer,otkogo,komu,soobshenie,data,otmetka FROM soobsheniya WHERE  otkogo=? AND komu=?  UNION SELECT nomer,otkogo,komu,soobshenie,data,otmetka FROM soobsheniya WHERE otkogo=? AND komu=? ORDER BY nomer ASC limit $skakogo,$skolko");
$query->execute(array($login,$login_q,$login_q,$login));

while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
					//если от меня
if($line[1]==$login){

echo"<p>";

echo"<p class='mesimg'><img src='$glavfoto'/></p>";

echo"<p class='mesfromme'>$line[3]</p>";

echo"<p class='mesdel'>$line[4] <a href=''  src='$line[0]' onclick='deletemessage(this);return false;'>Удалить</a></p>";

echo"</p>";
}
							//если от него
else if($line[1]==$login_q){

echo"<p>";

echo"<p class='mesimg'><img src='$glavfoto_q'/></p>";

echo"<p class='mesforme'>$line[3]</p>";

echo"<p class='mesdel'>$line[4] <a href=''  src='$line[0]' onclick='deletemessage(this);return false;'>Удалить</a></p>";

echo"</p>";
}
}

?>

