<html>	
<head>
<title>	Знакомства</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<script src="zaloba.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>

<div class="column1">
<?php
session_start();//инициируем сессию   
 
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                
include "config.php";//присоединить файл для подключения к серверу
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
  $folder1 = '/fotosait/';//папка для выгрузки файлов  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit();}

$online=online($login);
if($online=='1'){
 echo"&nbsp;on-line"; } 
$metkap=$_SESSION['metkap'];   //метка пользователя входит в переменную 
if(isset($_GET["ipd"])) //поиск пользователя и сюда переход по ссылке
{ 
$ipd=$_GET["ipd"];
$login_q=iznomera($ipd);

$login_q=trim($login_q);//убирает пробелы из начала и конца поля
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

$_SESSION['login_q']=$login_q; 


}
else if(isset($_SESSION['login_q'])){
$login_q=$_SESSION['login_q'];
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
}
else if(isset($_GET['id'])){
$n=$_GET['id'];
$n=trim($n);//убирает пробелы из начала и конца поля
$n=htmlspecialchars($n);
$n=mysql_real_escape_string($n);//экранирует символы кроме % и _
$login_q=iznomera($n);

$_SESSION['login_q']=$login_q; 
}
else{
header("location:index.php");
}
$metka=metkidlyadruzey($login,$login_q);
if($metka!='vhod'){
echo"&nbsp;Вы не можете просматривать эту страницу";
echo"<form action='vdruzya.php' method='POST'>";
echo"&nbsp;<input type='submit' value='Добавить в друзья' name='vdruzya'>";
echo"</form>";

exit();
}



$array=imyaizlogina($login_q);
 
echo "&nbsp;<i>$array[0]</i><br/>";                        
echo "&nbsp;<i>$array[1]</i><br/> ";
echo "&nbsp;<i>$array[2]</i><br/>";
echo "&nbsp;<i>$array[4]</i><br/>";

$gruppa=$array[5];
if(($gruppa==$metkap)&&($metkap!='0')){echo"Из Вашей группы";}
else if(($gruppa!=$metkap)&&($metkap!='0')){echo"Не из вашей группы";}

if(isset($array[9]))
{
$osebe=$array[9];
}

$query="SELECT foto FROM $userstable WHERE loginp='$login_q'AND metka='glav'";//выбор главного фото по логину и метке фото 
$result = mysql_query($query) or die("Query не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
$foto=$folder1.$line[0];
}

if(($metkap==$metka_q)&&($metkap!='0')){echo"у Вас одна группа!!!";}//metka_q что такое?
if(isset($foto)&&(is_file($foto))){echo"<img  class='glavfoto' src=\"<?php  echo $foto;?> \"   />";}
else              {echo"<img  class='glavfoto' src=\"/fotosait/fotonet.png \"   />";}




?>



<div class="moissilki"><br/>
&nbsp;<a href="index.php">Вернуться на мою страницу</a><br/><br/>
<form action="soobsheniya.php" method="POST">
&nbsp;<input type="submit" value="Отправить сообщение" name="soobshe">
</form>
<form action="vdruzya.php" method="POST" name="forma">
&nbsp;<input type="submit" value="Добавить в друзья" name="vdruzya"><br/><br/>
&nbsp;<input type="submit" value="Удалить из друзей" name="izdruzey"><br/><br/>
&nbsp;<input type="submit" value="Временно прекратить общение" name="blacklist"><br/><br/>
&nbsp;<input type="button" value="Пожаловаться" onclick="zgaloba()">
</form>
</div>
</div>

<div class="column2">



<div class="forfoto">

<?php



$query="SELECT foto FROM $userstable WHERE loginp='$login_q'";//выбор и вывод  всех фото по логину
 
$result = mysql_query($query) or die("Query не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{


$fotka=$folder1.$line[0];

if(isset($fotka)){
echo"&nbsp;<div class='imgmoip'><img  src='$fotka'> <br/>";}

if(isset($line[3])){

echo"&nbsp;$line[3]";}//если существует описание
echo"</div>";


}
?>


</div>

</div>




<div class="column3">
&nbsp;<script src="time.js"></script>
<?php /*анкетка друга*/ if(isset($osebe)){echo "&nbsp;$osebe <br/>";} 

$vgosti=vgosti($login,$login_q);//помещает меня в список его гостей



?>

</div>



</body>


</html>