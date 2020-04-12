<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

﻿<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="drug.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>

<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>


<?php
							
							//с какой записи начинается выборка
if(!isset($start_limit)){$start_limit=0;}
echo"<input type='hidden' id='start_limit' value='$start_limit'>";

//limit - сколько записей выходит -в данном случае 15
if(!isset($limit)){$limit=15;}
echo"<input type='hidden' id='limit' value='$limit'>";


  
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$metkap=$_SESSION['metkap'];//моя группа



							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

if(!isset($metkapol)){$metkapol='';}

if(isset($_GET["check"])) 
{ 
							//моя группа
$metkapol=$metkap;

$esliestmetka='estmetka';//если есть метка

$metkapol=htmlspecialchars($metkapol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
echo"<b>&nbsp;Из Вашей группы!!!</b>";
}
else {
$esliestmetka='netmetki';
}//если нет метки


echo"<br/><b>Результат поиска:</b><br/>";

$imya=$_GET['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

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

echo"<div id='drug_ajax'>";
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
{
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND region=? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$region,$metkapol,$vozrast1,$vozrast2));
//echo"если регион и метка";
}

else if(($imya=='')&&($esliestmetka=='estmetka')&&($pol=='')&&($region==''))     //если только метка
{
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE  loginp!=? AND metkap=?  AND vozrast BETWEEN ? AND ? LIMIT $start_limit,$limit");
$query->execute(array($login,$metkapol,$vozrast1,$vozrast2));echo"<div id='drug_ajax'>";
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
{echo"<div id='drug_ajax'>";
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
echo"</div>";
							//подсчет строк чтобы скрыть кнопку "еще"
$schet=0;

echo"<div class='drug_ajax_in'>";
while($line=$query->fetch(PDO::FETCH_LAZY))
{
$r=izloginanomer($line[0],$pdo);//$r - номер пользователя 
$glavfoto=glavfoto($line[0],$pdo);
echo"<img src='$glavfoto'>";
 $isonline=isonline($line[0],$pdo);//показывает онлайн ли пользователь
echo"<a href='stdruga.php?ipd=$r'>$line[1]&nbsp;$isonline</a> <a href='soobsheniya.php?id=$r'>Отправить сообщение</a> <br/>";
				//подсчет строк
$schet++;
}
echo"</div>";
?>



<input type='hidden' id="metkapol" value="<?php echo $metkapol;?>">
<input type='hidden' id="esliestmetka" value="<?php echo $esliestmetka;?>">
<input type='hidden'  id="imya" value="<?php echo $imya;?>">
<input type='hidden'  id="pol" value="<?php echo $pol;?>">
<input type='hidden' id="region" value="<?php echo $region;?>">
<input  type='hidden'  id="vozrast1" value="<?php echo $vozrast1;?>">
<input  type='hidden'  id="vozrast2" value="<?php echo $vozrast2;?>">
<input type="button" id="button_poisk" value="Еще" onclick='drug()'>

<?php
if($schet<=15){echo"<script>document.getElementById('button_poisk').style.visibility='hidden'</script>";};
?>


<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>
</html>