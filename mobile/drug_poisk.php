<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="drug.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "druzyainet";//табл со списком друзей
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$link = mysql_connect($sdb_name,$user_name,$user_password) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
session_start();//инициируем сессию   

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$moyametka=$_SESSION['metkap'];//моя группа


$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}

    //модуль с полями для редактирования


?>

<?php

$array=imyaizlogina($login);
$moeimya=$array[0];

echo"<i>&nbsp;$moeimya </i><br/>";
if(isset($_POST["check"])) 
{ 
$check=$_POST["check"];  
//$check=mysql_real_escape_string($check);//экранирует символы кроме % и _ 
$metkap=$check[0];

$esliestmetka='estmetka';//если есть метка

$metkapol=htmlspecialchars($metkap);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
echo"<b>&nbsp;Из Вашей группы!!!</b>";
}
else {
$esliestmetka='netmetki';}//если нет метки

//echo"<br/>моя группа $moyametka";
//echo "<br/>ищем в группе $metkapol";

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

//echo"<br/>esliestmetka $esliestmetka";

//echo"<br/>imyaphp $imya";

//echo"<br/>pol $pol";

//echo"<br/>region $region";


//echo"<br/>vozrast1 $vozrast1";



//echo"<br/>vozrast2 $vozrast2";



//////////////*************************

//отсюда поиск

if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если имя и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND imya LIKE '%$imya%' AND metkap='$metkapol'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если пол и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND pol='$pol' AND metkap='$metkapol'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если пол и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если регион и метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND region='$region' AND metkap='$metkapol'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если регион и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если только метка
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkapol'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если только метка";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если имя и метка и пол и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkapol' AND imya LIKE '%$imya%' AND pol='$pol' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region==''))     //если имя и метка и пол
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkapol' AND imya LIKE '%$imya%' AND pol='$pol' AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если имя и метка и пол";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol!='')&&($region!=''))     //если метка и пол и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkapol' AND pol='$pol' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
//echo"если метка и пол и регион";
}

else if(($imya!='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region!=''))     //если имя и метка и регион
{
 $query="SELECT * FROM $userstable1 WHERE  loginp!='$login' AND metkap='$metkapol' AND imya LIKE '%$imya%' AND region='$region'  AND vozrast BETWEEN '$vozrast1' AND '$vozrast2'";
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


$result = mysql_query($query) or die("Запрос не получился");          //результат запроса

$vsego=mysql_num_rows($result);//количество строк в результате запроса

if(empty($skolka)){$skolka=10;}//если при выгрузке данных $skolka - пустое значение
if($skolka>$vsego){$skolka=$vsego;}// если $skolka>$vsego

//echo"<br/>skolka $skolka";

//echo"<br/>vsego $vsego<br/>";

//echo"imyaphppp1p $imya<br/>";

$query=$query."limit 0,$skolka";

$result = mysql_query($query) or die("Запрос1 не получился");          //результат запроса с лимитом





?>
<div id="drug_ajax">

<?php
while($line=mysql_fetch_row($result))
{
$r=izloginanomer($line[0]);//$r - номер пользователя 
$imya_polzovatelya=imyaizlogina($line[0]);//имя из логина
$imya_polzovatelya=$imya_polzovatelya[0];
//$n=izloginanomer($line[0]);
$isonline=isonline($line[0]);

$adres_foto=glavfoto($line[0]);
echo"<img src='$adres_foto' class='imgmoi'/>";

echo"<a href='stdruga.php?ipd=$r'>$line[1]&nbsp;$isonline</a><br/>";


}
?>

</div>



<form>

<input hidden id="metkapol" value="<?php echo $metkapol;?>">

<input hidden id="esliestmetka" value="<?php echo $esliestmetka;?>">

<input hidden id="imya" value="<?php echo $imya;?>">

<input hidden id="pol" value="<?php echo $pol;?>">

<input hidden id="region" value="<?php echo $region;?>">

<input hidden id="vozrast1" value="<?php echo $vozrast1;?>">

<input hidden id="vozrast2" value="<?php echo $vozrast2;?>">

<input hidden id="skolka" value="<?php echo $skolka;?>">

<input hidden id="vsego" value="<?php echo $vsego;?>">

<input type="button" id="button_poisk" value="Еще" onclick=drug()>
</form>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>
</html>