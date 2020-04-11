<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>﻿

<?php

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();    



$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
  

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
 
$metkap=$_SESSION['metkap'];//моя группа

//с какой записи начинается выборка
if(!isset($_GET['start_limit'])){$start_limit=0;}
else{$start_limit=$_GET['start_limit'];}


//limit - сколько записей выходит
if(!isset($_GET['limit'])){$limit=2;}
else{$limit=$_GET['limit'];}




$imya=$_GET['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$esliestmetka=$_GET['esliestmetka'];
$esliestmetka=trim($esliestmetka);//убирает пробелы из начала и конца поля
$esliestmetka=htmlspecialchars($esliestmetka);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



$pol=$_GET['pol'];
$pol=htmlspecialchars($pol);

 $region=$_GET['region']; 
$region=htmlspecialchars($region);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение


$vozrast1=$_GET['vozrast1'];
$vozrast1=trim($vozrast1);//убирает пробелы из начала и конца поля
$vozrast1=htmlspecialchars($vozrast1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$vozrast2=$_GET['vozrast2'];
$vozrast2=trim($vozrast2);//убирает пробелы из начала и конца поля
$vozrast2=htmlspecialchars($vozrast2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

if($vozrast1>$vozrast2)//если возраст не так введут
{
$men=$vozrast2;
$vozrast2=$vozrast1;
$vozrast1=$men;
unset($men);
}

							//моя метка для поиска
$metkapol=$metkap;

//отсюда поиск

if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если имя и метка
{
$imya="%$imya%";
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND imya LIKE ? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$imya,$metkapol,$vozrast1,$vozrast2));
//echo"если имя и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если пол и метка
{
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND pol=? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$pol,$metkapol,$vozrast1,$vozrast2));
//echo"если пол и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если регион и метка
{$imya=$_GET['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND region=? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$region,$metkapol,$vozrast1,$vozrast2));
//echo"если регион и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если только метка
{
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$vozrast1,$vozrast2));
//echo"если только метка";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если имя и метка и пол и регион
{
$imya="%$imya%"; 
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=? AND imya LIKE ? AND pol=? AND region=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$imya,$pol,$region,$vozrast1,$vozrast2));
//echo"если имя и метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если имя и метка и пол
{
$imya="%$imya%"; 
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=? AND imya LIKE ? AND pol=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$imya,$pol,$vozrast1,$vozrast2));
//echo"если имя и метка и пол";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если метка и пол и регион
{
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=? AND pol=? AND region=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$pol,$region,$vozrast1,$vozrast2));
//echo"если метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если имя и метка и регион
{
$imya="%$imya%"; 
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=? AND imya LIKE ? AND region=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$imya,$region,$vozrast1,$vozrast2));
//echo"если имя и метка и регион";
}

else if(($imya!='')&&($esliestmetka=='netmetki')&&($pol=='')&&($region==''))     //если имя без метки
{
$imya="%$imya%";
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND imya LIKE ? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$imya,$vozrast1,$vozrast2));
//echo"если имя без метки";
}

else if(($imya!='')&&($esliestmetka=='netmetki')&&($pol!='')&&($region!=''))     //если имя и пол и регион без метки
{
$imya="%$imya%";
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND imya LIKE ? AND pol=? AND region=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$imya,$pol,$region,$vozrast1,$vozrast2));
//echo"если имя и пол и регион без метки";
}

else if(($imya!='')&&($esliestmetka=='netmetki')&&($pol!='')&&($region==''))     //если имя и пол без метки
{
$imya="%$imya%";
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND imya LIKE ? AND pol=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$imya,$pol,$vozrast1,$vozrast2));
//echo"если имя и пол без метки";
}

else if(($imya!='')&&($esliestmetka=='netmetki')&&($pol=='')&&($region!=''))     //если имя и регион без метки
{
$imya="%$imya%";
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND imya LIKE ? AND region=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$imya,$region,$vozrast1,$vozrast2));
//echo"если имя и регион без метки";
}

else if(($imya=='')&&($esliestmetka=='netmetki')&&($pol=='')&&($region==''))     //если без метки
{
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$vozrast1,$vozrast2));

}

else if(($imya=='')&&($esliestmetka=='netmetki')&&($pol!='')&&($region!=''))     //если пол и регион без метки
{
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND pol=? AND region=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$pol,$region,$vozrast1,$vozrast2));
//echo"если пол и регион без метки";
}

else if(($imya=='')&&($esliestmetka=='netmetki')&&($pol!='')&&($region==''))     //если пол без метки
{
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND pol=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$pol,$vozrast1,$vozrast2));
//echo"если пол без метки";
}

else if(($imya=='')&&($esliestmetka=='netmetki')&&($pol=='')&&($region!=''))     //если регион без метки
{
 $query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND region=? AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$region,$vozrast1,$vozrast2));
//echo"если регион без метки";
}

else{
$query=$pdo->query("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe  LIMIT $start_limit,$limit");//на всякий случай
//echo"Условия поиска не выбраны";
}

while($line=$query->fetch(PDO::FETCH_LAZY))
{
$r=izloginanomer($line[0],$pdo);//$r - номер пользователя 
$glavfoto=glavfoto($line[0],$pdo);
echo"<img src='$glavfoto' class='imgmoi'>";
 $isonline=isonline($line[0],$pdo);//показывает онлайн ли пользователь
echo"<a href='stdruga.php?ipd=$r'>$line[1]&nbsp;$isonline</a><br/>";

}

?>


