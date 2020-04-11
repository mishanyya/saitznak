<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>

</head>
	<body>

<?php
session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем      
$userstable = "druzyainet";//табл со списком друзей
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);//проверка при входе

    //модуль с полями для редактирования


?>
<form  action="stdruga.php"  method="post">
<?php

//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}

echo"<i>мое имя &nbsp;$imya </i><br/>";
if(isset($_POST["check"]))  //если метка группы отправлена
{ 
$check=$_POST["check"]; 
//$check=mysql_real_escape_string($check);//экранирует символы кроме % и _ 
$metkap=$check[0];
$metkap=htmlspecialchars($metkap);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$esliestmetka='estmetka';

echo"<b>&nbsp;Из Вашей группы!!!</b>";
}

echo"<br/><b>Результат поиска:</b><br/>";
$imya=$_POST['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$imya=mysql_real_escape_string($imya);//экранирует символы кроме % и _ 

$pol=$_POST['pol'];
$pol=htmlspecialchars($pol);

 $region=$_POST['region']; 
$region=htmlspecialchars($region);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$region=mysql_real_escape_string($region);//экранирует символы кроме % и _ 


$vozrast1=$_POST['vozrast1'];
$vozrast1=trim($vozrast1);//убирает пробелы из начала и конца поля
$vozrast1=htmlspecialchars($vozrast1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$vozrast1=mysql_real_escape_string($vozrast1);//экранирует символы кроме % и _ 

$vozrast2=$_POST['vozrast2'];
$vozrast2=trim($vozrast2);//убирает пробелы из начала и конца поля
$vozrast2=htmlspecialchars($vozrast2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$vozrast2=mysql_real_escape_string($vozrast2);//экранирует символы кроме % и _ 

if($vozrast1>$vozrast2)//если возраст не так введут
{
$men=$vozrast2;
$vozrast2=$vozrast1;
$vozrast1=$men;
unset($men);
}

//***********************************


echo"ищем по metkap= $metkap ,esliestmetka= $esliestmetka ,imya= $imya ,pol= $pol ,region= $region ,vozrast1= $vozrast1 ,vozrast2= $vozrast2 !<br/>";

//отсюда поиск

if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если имя и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND metkap='$metkap'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если пол и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND pol='$pol' AND metkap='$metkap'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если пол и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если регион и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND region='$region' AND metkap='$metkap'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если регион и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если только метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkap'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если только метка";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если имя и метка и пол и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkap' AND imya LIKE '%$imya%' AND pol='$pol' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если имя и метка и пол
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkap' AND imya LIKE '%$imya%' AND pol='$pol' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка и пол";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если метка и пол и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkap' AND pol='$pol' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если имя и метка и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkap' AND imya LIKE '%$imya%' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка и регион";
}

else if(($imya!='')&&($esliestmetka!='estmetka')&&($pol=='')&&($region==''))     //если имя без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя без метки";
}

else if(($imya!='')&&($esliestmetka!='estmetka')&&($pol!='')&&($region!=''))     //если имя и пол и регион без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND pol='$pol' AND region='$region' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и пол и регион без метки";
}

else if(($imya!='')&&($esliestmetka!='estmetka')&&($pol!='')&&($region==''))     //если имя и пол без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND pol='$pol' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и пол без метки";
}

else if(($imya!='')&&($esliestmetka!='estmetka')&&($pol=='')&&($region!=''))     //если имя и регион без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND region='$region' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и регион без метки";
}

else if(($imya=='')&&($esliestmetka!='estmetka')&&($pol=='')&&($region==''))     //если без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если без метки";
}

else if(($imya=='')&&($esliestmetka!='estmetka')&&($pol!='')&&($region!=''))     //если пол и регион без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND pol='$pol' AND region='$region' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если пол и регион без метки";
}

else if(($imya=='')&&($esliestmetka!='estmetka')&&($pol!='')&&($region==''))     //если пол без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND pol='$pol' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если пол без метки";
}

else if(($imya=='')&&($esliestmetka!='estmetka')&&($pol=='')&&($region!=''))     //если регион без метки
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND region='$region' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если регион без метки";
}

else{$query="SELECT * FROM $userstable1 WHERE  0";//на всякий случай
//echo"Условия поиска не выбраны";
}



$result=$pdo->query($query);

while($line=$result->fetch(PDO::FETCH_LAZY))
{
echo"$line[0] &nbsp;";

$lich->execute(array($line[0]));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}

$id=izloginanomer($line[0],$pdo);

$isonline=isonline($line[0],$pdo);//если он-лайн то показывает

echo"<a href='index5.php?id=$id'>На страницу друга <b> $imya </b>  </a> $isonline <br/>";


}
 
 //до сюда






?>

</form>
<a href='index11.php'>Новый поиск</a><br/>
<a href='index2.php'>На мою страницу</a>
</body>
</html>