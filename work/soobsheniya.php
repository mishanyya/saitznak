<!DOCTYPE html>
<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>	
<head>
<title>	Знакомства</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="ajax.js"></script>
<script src="poiskimya.js" type="text/javascript"></script>

<script src="opisanie.js"></script>
<script src="ajax_soobsh.js"></script>
<script src="dogruzka.js"></script>
<script src="sendmessage.js"></script>
<script src="deletemessage.js"></script>
<script src="deletemessages.js"></script>
<script src="adresatupdate.js"></script>

<script src='fotointextarea.js'></script>


<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>
<div class="column1">

<span class='imyasayta'><?php echo IMYASAYTA; ?></span>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblema'/></a>
<?php
       
echo"<div class='block1'>";
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();					
							//логин и ип выводим из сессии
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//получаем мою метку
$metkap=$_SESSION['metkap'];

							//вывод главного фото и имени
$glavfoto=$_SESSION['glavfoto'];
$glavfoto=htmlspecialchars($glavfoto);							
$imya=$_SESSION['imya'];
$imya=htmlspecialchars($imya);
echo"<img src='$glavfoto' class='glavfoto'/>";

										

							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);		

							//проверка на блокировку
blocked($login,$pdo);					

							//внесение в онлайн
online($login,$pdo);

							//получение адресата login_q

							//если получено id - передается с soobsheniya.php когда есть непрочитанные сообщения 
if(isset($_GET['id']))
{
$id=$_GET['id'];
$id=htmlspecialchars($id); 
$login_q=iznomera($id,$pdo);
$_SESSION['login_q']=$login_q;
}						
							//если получен adresat??????????????????????
else if(isset($_POST['adresat']))
{
unset($_SESSION['login_q']); 
$login_q=$_POST['adresat'];
$login_q=htmlspecialchars($login_q);
$_SESSION['login_q']=$login_q;

}
								//если существует  login_q ???????????????????????????????????????
else  if(isset($_SESSION['login_q']))
{
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);

}	

	
echo"</div>";

echo"<div class='block1'>";

							//начало блока если есть адресат login_q
if(isset($login_q)){
							//отметка непрочитанных сообщений как прочитанных
$query=$pdo->prepare("UPDATE soobsheniya SET otmetka='1' WHERE  otkogo=? AND komu=?  AND otmetka!='1'");
$query->execute(array($login_q,$login));


//выводим мои данные 
$lich=dataFromLogin($login,$pdo);
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

$glavfoto_q=glavfoto($login_q,$pdo);
							//помещаем его фото в сессию
$_SESSION['glavfoto_q']=$glavfoto_q;



if($imya!='')
{
$isonline=isonline($login_q,$pdo);
//переход на страницу адресата
echo"<b>Ваш собеседник :</b><br/><a href='stdruga.php'><img src='$glavfoto_q' class='imgmoi'><p>$imya_q</p></a> $isonline<br/>";
}

}							//конец блока если есть адресат login_q
							//если не существует login_q
else 
{
echo "<i>не выбран собеседник</i>";
}

echo"</div>";//END block1

echo"<div class='block2'>";

							//вывод всех адресатов
$query=$pdo->prepare("SELECT komu FROM adresatsms WHERE otkogo=? UNION SELECT otkogo FROM adresatsms WHERE komu=?");
$query->execute(array($login,$login));


while($line=$query->fetch(PDO::FETCH_LAZY))
{
if($line[0]!=''){
							//адрес главной фотографии
$fotoadres=glavfoto($line[0],$pdo);
$l=izloginanomer($line[0],$pdo);
echo"<a href='soobsheniya1.php?pn=$l'><img src='$fotoadres' class='imgmoi'/>"; 


$lich=dataFromLogin($line[0],$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_qq=$line->imya;
}
echo"$imya_qq";
$isonline=isonline($line[0],$pdo);
echo"$isonline";
echo"</a>";
//
$login_a=iznomera($l,$pdo);
//

echo"<p><a href='' src='$l' onclick='deletemessages(this);return false;' class='lichnoe'>Удалить переписку</a></p>"; 
}
}							


echo"<a href='index.php'>На мою страницу</a>";

echo"</div>";//END block2

echo"</div>";//END column1

?>
<div class="column2">


<?php

echo"<div class='block2'>";
//поиск непрочитанных сообщений
$query=$pdo->prepare("SELECT DISTINCT otkogo FROM soobsheniya WHERE komu=? AND otmetka='0'");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//помещение в массив строк из бд
{
$nomer=izloginanomer($line[0],$pdo);//шифруется номер 
$nlog1=iznomera($nomer,$pdo);//расшифровывается номер и выходит логин

$lich=dataFromLogin($nlog1,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_nlog1=$line->imya;
}


echo"<p><a href='soobsheniya.php?id=$nomer'>У Вас  непрочитанное письмо от $imya_nlog1</a></p>";
}
echo"</div>";//END block2
?>



<div id='formessage'>
<?php

							//начало блока если есть адресат login_q
if(isset($login_q)){

						//выбор всех сообщений с login_q здесь заранее для кнопки "еще"
$query=$pdo->prepare("SELECT COUNT(nomer) FROM soobsheniya WHERE  (otkogo=? AND komu=?) OR (otkogo=? AND komu=?)");
$query->execute(array($login,$login_q,$login_q,$login));
$kolvo=$query->fetchColumn();

//if($kolvo>15){
echo"<input type='button' value='Еще' id='ischo' onclick='vozvrat()' class='small'>";
//}

echo"<div id='echo'></div>";
echo"<div id='ajax_soobsh'>";							
							//если есть сообщения
if($kolvo>=0){
$s=$kolvo-15;//с какой строки выходит
if($s<0){
$s=0;
}
							//выбор сообщений от меня к нему и от него мне
$query=$pdo->prepare("SELECT nomer,otkogo,komu,soobshenie,data,otmetka FROM soobsheniya WHERE  otkogo=? AND komu=?  UNION SELECT nomer,otkogo,komu,soobshenie,data,otmetka FROM soobsheniya WHERE otkogo=? AND komu=? ORDER BY nomer ASC LIMIT $s,15");
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
}



}							//конец блока если есть адресат login_q


echo"</div>";//END ajax_soobsh
echo"</div>";//END formessage


?>
<input type='hidden' id='skakogo' value='<?php echo $s-15 ?>'>
<input type='hidden' id='kolvo' value='<?php echo $kolvo ?>'>
<input type='hidden' id='dostroki' value='<?php echo $s ?>'>
<input type='hidden' id='skolko' value='15'>
<input type='hidden' id='chislo' value='15'>
<div id='smilebox'>
<a href='#' onclick='vstavit(this);return false;' title='01.png'><img src='fotosmile/smile01.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='02.png'><img src='fotosmile/smile02.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='03.png'><img src='fotosmile/smile03.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='04.png'><img src='fotosmile/smile04.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='05.png'><img src='fotosmile/smile05.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='06.png'><img src='fotosmile/smile06.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='07.png'><img src='fotosmile/smile07.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='08.png'><img src='fotosmile/smile08.png' title='образец рисунка' width='18'></a>
<a href='#' onclick='vstavit(this);return false;' title='09.png'><img src='fotosmile/smile09.png' title='образец рисунка' width='18'></a>

</div>
<form  class="formadown" >

 <div class='textarea' id="soobsh" contenteditable="true"></div> 
<input type="button" id="soob" value="Отправить сообщение" onclick='sendmessage()'/>

</form>
<?php

if(isset($login_q)){echo"<script>document.querySelector('#formessage').style.display='block';document.querySelector('.formadown').style.display='block';
document.querySelector('#smilebox').style.display='block';

</script>";}



echo"</div>";//END column2
?>


<div class="column3">
<div class='block3'>
<a href='exit.php'>Выход</a>
<p><script src="/time.js"></script></p>
<?php


echo"</div>";//END block3

echo"<form  action='drug.php'  method='GET'>";
echo"<p>Поиск</p>";

if($metkap!=0){
echo"<p>Искать в Вашей группе <input type='checkbox' checked name='check[]' value='$metkap'></p>";
}

echo"<p>Имя <input type='text' autocomplete='off'   name='imya' onkeyup='poiskimya()'></p>";
echo"<ul name='imya1'></ul>";

echo"<p>Пол ";
echo"<select name='pol'  class='small'>";
echo"<option></option>";
echo"<option>М</option>";
echo"<option>Ж</option>";
echo"</select></p>";

echo"<p>Регион ";
echo"<select name='region' >";

							//выбор региона для поиска
$query=$pdo->query("SELECT region FROM goroda LIMIT 90");
echo"<option></option>";
while($line=$query->fetch(PDO::FETCH_LAZY))
{
 echo"<option>$line[0]</option>";
}

echo"</select></p>";


							//указание возраста для поиска
$vozrast=date("Y");
$vozrast_70=$vozrast-$god_70;
$vozrast_18=$vozrast-$god_18;
$vozrast_t;
echo"<p>Возраст от <select name='vozrast1'  class='small'>";
for($vozrast_t=$vozrast_18;$vozrast_t<=$vozrast_70;$vozrast_t++)
{
echo"<option value='$vozrast_t'>$vozrast_t</option>";
}
echo"</select>";
echo" до <select name='vozrast2'  class='small'>";

for($vozrast_t=$vozrast_70;$vozrast_t>=$vozrast_18;$vozrast_t--)
{
echo"<option value='$vozrast_t'> $vozrast_t</option>";
}
echo"</select></p>";
echo"<input  type='submit'  value='Найти' name='lich'>";
//echo"<input  type='reset'  value='Очистить поля'>";


echo"</form>";

//<a href="pay.php" class='pay'>Помочь в содержании и развитии сайта</a><br/>
?>

<script>setInterval('ajax_soobsh()',10000);</script>

<?php




?>
</div>

<script>foundimg();</script>

<script src="scrolltop.js"></script>
<script>scrolling();</script>


</body>

</html>
