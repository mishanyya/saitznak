<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
<?php

session_start();//инициируем сессию   

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "lichnoe";//табл с личными данными
$userstable2 = "goroda";//табл с  данными
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _



$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _


$strochekparolya=forenter($login,$ip);



if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}


$array=imyaizlogina($login);


echo"&nbsp;<i>$array[0]</i>  <br/>";
       

    //модуль с полями для редактирования

?>


<?php

$query="SELECT * FROM $userstable WHERE loginp='$login'";
$result = mysql_query($query) or die("Query не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
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
&nbsp;Как к Вам обращаться&nbsp;<input type="text" required value="<?php echo $_imya; ?>" name="imya">
<br/>
&nbsp;Регион
<select name="region" >
<?php


$query="SELECT region FROM $userstable2";

$result = mysql_query($query) or die("Query не получилось");

echo"<option>$_region</option>";

while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
 echo"<option>$line[0]</option>";
}

?>

</select>
<br/>
&nbsp;Пол
<select name="pol">
<?php
echo"<option>$_pol</option>";
?>
<option></option>
<option>М</option>
<option>Ж</option>

</select>
<br/>

&nbsp;Ваш город&nbsp;<input type="text"  value="<?php echo $_gorod; ?>" name="gorod">

<br/>
&nbsp;Год:<select name="god">

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

&nbsp;Месяц:<select name="mesyatc">

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






&nbsp;Число:<select name="chislo">
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
&nbsp;О себе&nbsp;<textarea name="osebe" cols="25" rows="10"><?php echo $_osebe ; ?></textarea>
<br/>
&nbsp;
<input  type="submit"  value="Изменить" name="lich" ><br/>

 </form>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>


</html>