<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>
<?php
                      

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();


$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение




$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначениеgoroda

	//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);


?>


<?php
							//объект с личными данными пользователя
$lich=dataFromLogin($login,$pdo);


while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$_imya=$line[1];                        
$_region=$line[2];
$_gorod=$line[3];
$_datarozd=$line[4];
$_vozrast=$line[5];
$_osebe=$line[9];
$_pol=$line[10];
} 
?>
<form  action="lichnoe1.php"  method="post">
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
<option></option>
<option>М</option>
<option>Ж</option>

</select>
<br/>

<b>Ваш город</b>&nbsp;<input type="text"  value="<?php echo $_gorod; ?>" name="gorod">

<br/>
<b>Год рождения:</b><select name="god">

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

<b>О себе</b>
<select name="osebe">
<?php
echo"<option>$_osebe</option>";
?>
<option></option>
<option>в активном поиске</option>
<option>в официальном браке</option>
<option>в гражданском браке</option>

</select>
<br/>




<input  type="submit"  value="Изменить" name="lich" ><br/>

 </form>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>


</html>