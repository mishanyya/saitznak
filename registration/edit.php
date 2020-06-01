<!DOCTYPE html>

<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php

?>


﻿<html>
<head>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/poiskimya.js" type="text/javascript"></script>
<script src="js/opisanie.js" type="text/javascript"></script>
<script src="js/myslipolzovatelya.js" type="text/javascript"></script>
<script src="js/neproch_soobsh.js" type="text/javascript"></script>
<script src="js/izlivinput.js" type="text/javascript"></script>
<script src="js/fromblack.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/css/style.css"/>


<meta name="Keywords" content="<?php echo $keywords; /*показать keywords для сайта*/?>"/>
<meta name="Description" content="<?php echo $description; /*показать description для сайта*/?>"/>
<title><?php echo $title; /*показать title*/?></title>

</head>
<body>

<?php





							//логин и ип выводим из сессии
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

forenter();//функция для разрешения входа

							//внесение в онлайн
online($login,$pdo);

 							//проверка на блокировку
blocked($login,$pdo);

//$line=forenter();//функция для разрешения входа
//$lich=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,TIMESTAMPDIFF(YEAR, datarozd, NOW()),semeynpolozh,pol FROM lichnoe WHERE loginp=? LIMIT 1");


//объединенный запрос из двух таблиц, строки объединяются по одинаковым значениям полей loginp, которые есть в каждой из таблиц
$lich=$pdo->prepare("SELECT lichnoe.loginp,lichnoe.imya,lichnoe.region,lichnoe.gorod,lichnoe.datarozd,TIMESTAMPDIFF(YEAR, lichnoe.datarozd, NOW()),lichnoe.semeynpolozh,lichnoe.pol,polzovateli.proveren FROM lichnoe INNER JOIN polzovateli USING(loginp) WHERE loginp=? LIMIT 1");
//echo "login:".$login;

$lich->execute(array($login));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$_imya=$line[1];
$_region=$line[2];
$_gorod=$line[3];
$_datarozd=$line[4];
$_vozrast=$line[5];
$_semeinpolozh=$line[6];
$_pol=$line[7];
$_proveren=$line[8];
}

							//объект с личными данными пользователя
//datafromlogin($login,$pdo);



?>
<form  action="edit1.php"  method="post">
<b>Как к Вам обращаться</b>&nbsp;<input type="text" required value="<?php echo $_imya; ?>" name="imya">
<br/>
<b>Регион</b>
<select name="region" >
<?php
$query=$pdo->query("SELECT region FROM goroda LIMIT 90");

echo"<option>$_region</option>";
while($line=$query->fetch(PDO::FETCH_LAZY))
{
 echo"<option>$line[0]</option>";
}
?>
</select>

<br/>
<b>Пол</b>
<select name="pol">
<?php
echo"<option>$_pol</option>";
?>
<option>М</option>
<option>Ж</option>

</select>
<br/>

<b>Ваш город</b>&nbsp;<input type="text"  value="<?php echo $_gorod; ?>" name="gorod">

<br/>
<b>Год рождения:</b>
<select name="god">

<?php
$god;
$go=substr($_datarozd,0,4);
$mesya=substr($_datarozd,5,2);
$chisl=substr($_datarozd,8,2);

?>

<option><?php echo "$go"; ?></option>
<?php
for($god=$god_70;$god<=$god_18;$god++)
{
?>
<option><?php echo"$god"; ?></option>
<?php
}
?>
</select>

<?php

$f = fopen("month.txt", "r");
$mesy = explode(",",fgets($f));

fclose($f);


?>

<b>Месяц:</b><select name="mesyatc">

<?php

$f = fopen("month.txt", "r");
$mesyatc = explode(",",fgets($f));

fclose($f);
$mesya1=$mesya;
$mesya=$mesya-1;
?>
<option value="<?php echo "$mesya1"; ?>"><?php  echo "$mesyatc[$mesya]"; ?></option>






<?php
$i=0;
$f = fopen("month.txt", "r");
$mesyatc = explode(",",fgets($f));
do {
$im=$i+1;
if($im<10){$im="0".$im;}
?>


<option value="<?php echo "$im"; ?>"><?php echo"$mesyatc[$i]"; ?></option>

<?php
$i++;
}while($i<12);

fclose($f);
?>
</select>






<b>Число:</b><select name="chislo">
<option><?php echo "$chisl"; ?></option>
<?php
$chislo=1;
do {

if($chislo<10){$chislo="0".$chislo;}
?>

<option><?php echo"$chislo"; ?></option>

<?php
$chislo++;
}while($chislo<=31);

?>
</select>
<br/>

<b>Возраст:<?php echo $_vozrast; ?></b><br/>

<b>О себе</b>
<select name="osebe">
<?php
echo"<option>$_osebe</option>";
?>
<option>в активном поиске</option>
<option>в официальном браке</option>
<option>в гражданском браке</option>

</select>
<br/>


<input  type="submit"  value="Изменить" name="lich" ><br/>

 </form>


</body>


</html>
