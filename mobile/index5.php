<html>	
<head>
<title>	Знакомства</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
	
</head>
	<body>


<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>

<?php
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 


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

online($login,$pdo);//внесение в онлайн

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);// проверка для входа


$metkap=$_SESSION['metkap'];   //метка пользователя входит в переменную 
if(isset($_GET["ipd"])) //поиск пользователя и сюда переход по ссылке
{ 
$ipd=$_GET["ipd"];
$login_q=iznomera($ipd,$pdo);

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
$login_q=iznomera($n,$pdo);

$_SESSION['login_q']=$login_q; 
}
else{
header("location:index.php");
}

$metka=metkidlyadruzey($login,$login_q,$pdo);

//echo"- $metka -";

$n=izloginanomer($login_q,$pdo);//номер из логина

if($metka=='his_blocked'){


echo"<a href='index16_vdruzya.php?vdruzya=$n'>Пригласить в друзья</a>";



echo"<a href='index2.php' class='naglavnuyu'>На мою страницу</a>";

exit("Он заблокировался от всех и его нет в ваших друзьях");
}

else if($metka=='blocked_frend'){

$nom=izloginanomer($login_q,$pdo);

echo"<a href='index6.php?radiodrugb=$nom'>Разблокировать</a>";

echo"<a href='index2.php' class='naglavnuyu'>На мою страницу</a>";

exit("Для общения разблокируйте его и пригласите в друзья");
}
else if($metka=='zapret_dlya_gruppy'){
echo"<a href='index16_vdruzya.php?vdruzya=$n'>Пригласить в друзья</a>";
echo"<a href='index2.php' class='naglavnuyu'>На мою страницу</a>";

exit("Для общения добавьте его в друзья");
}




$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login_q));
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

$isonline=isonline($login_q,$pdo);//если он-лайн то показывает

echo"имя<i>$imya</i> $isonline <br/>";//имя
echo"Регион<i>$region</i>  <br>";//Регион 
echo"Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"имя<i>$vozrast</i>  <br>";//имя
echo"метка группы<i>$metka</i>  <br>";//метка группы 
echo"ип<i>$ipp</i>  <br>";//ип 
echo"фото<i>$limitfoto</i>  <br>";//фото 
echo"о себе<i>$osebe</i>  <br>";//о себе 
//
if(($metka==$metkap)&&($metkap!='0')){echo"Из Вашей группы";}
else if(($metka!=$metkap)&&($metkap!='0')){echo"Не из вашей группы";}

$query=$pdo->query("SELECT foto FROM fototabl WHERE loginp='$login_q'AND metka='glav'");//выбор главного фото по логину и метке фото 


while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
$foto=$folder1.$line->foto;
}

$foto=glavfoto($login_q,$pdo);//показыывает главное фото друга
echo $foto[0];

?>

<br/>

<a href='index7.php'>Отправить сообщение</a>
</form>
<form action="index16_vdruzya.php" method="POST" name="forma">

<?php
echo"<a href='index16_vdruzya.php?vdruzya=$n'>Пригласить в друзья</a>";
?>

<br/>

<?php
echo"<a href='index16_vdruzya.php?izdruzey=$n'>Удалить из друзей</a>";
?>
<br/>

<?php
echo"<a href='index16_vdruzya.php?blacklist=$n'>Временно прекратить общение</a>";
?>
<br/>


<?php
echo"<a href='index17_zaloba.php'>Для жалоб</a>";
?>




</form>
<a href='index2.php' class='naglavnuyu'>На мою страницу</a>






<div class="forfoto">

<?php

$query=$pdo->query("SELECT COUNT(foto) FROM fototabl WHERE loginp='$login_q'");//выбор и вывод  всех фото по логину



$kolvo=$query->fetchColumn();
if($kolvo>0){echo"Посмотрите:<br/>";}

$query_1=$pdo->query("SELECT foto FROM fototabl WHERE loginp='$login_q'");//выбор и вывод  всех фото по логину


while($line=$query_1->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
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







&nbsp;<a href='/index.php'>Выход</a><br/>
&nbsp;<b class='s'><script src="time.js"></script></b><br/>
<a href="pay.php" class='pay'>Помочь в содержании и развитии сайта</a><br/>
<?php /*анкетка друга*/ if(isset($osebe)){echo "&nbsp;$osebe <br/>";} 

$vgosti=vgosti($login,$login_q,$pdo);//помещает меня в список его гостей


?>




</body>


</html>