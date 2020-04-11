<!DOCTYPE html>

<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными     
   
?>


﻿<html>	
<head>
<title>	Знакомства</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script src="poiskimya.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="opisanie.js" type="text/javascript"></script>
<script src="myslipolzovatelya.js" type="text/javascript"></script>
<script src="neproch_soobsh.js" type="text/javascript"></script>
<script src="izlivinput.js" type="text/javascript"></script>
<script src="fromblack.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
<body>


<div class="column1">
<span class='imyasayta'><?php echo IMYASAYTA; ?></span>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblema'/></a>

<?php
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();							
							//удаляем логин других пользователей
unset($_SESSION['login_q']); 

							//логин и ип выводим из сессии
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
				
							//Функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);
							

							//внесение в онлайн
online($login,$pdo);

 							//проверка на блокировку
blocked($login,$pdo);
							//получаем номер пользователя

$query=$pdo->prepare("SELECT nomp FROM polzovateli WHERE loginp=? LIMIT 1");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))
{
$np=$line[0]; 
$_SESSION['np']=$np;
}
							//главное фото
$glavfoto=glavfoto($login,$pdo);
							//внесение главного фото в сессию
$_SESSION['glavfoto']=$glavfoto;
							//получаем личные данные по логину
$lich=dataFromLogin($login,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metkap=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
$pol=$line->pol;
							//получаем мою метку
$_SESSION['metkap']=$metkap;
							//внесение пола в сессию
$_SESSION['pol']=$pol;
							//внесение имени в сессию
$_SESSION['imya']=$imya;
}
							//модуль с главным фото и личными данными
echo"<div class='block1'>";
echo"<img  class='glavfoto' src='$glavfoto' />";
echo"<p>Имя <span class='svoidannie'>$imya</span></p>";//имя
echo"<p>Регион <span class='svoidannie'>$region</span></p>";//Регион 
echo"<p>Населенный пункт <span class='svoidannie'>$gorod</span></p>";//Населенный пункт 
echo"<p>Возраст <span class='svoidannie'>$vozrast</span></p>";//Возраст
echo"<p>О себе <span class='svoidannie'>$osebe</span></p>";//о себе 
echo"</div>";//END модуль с главным фото и личными данными

							//модуль для управления профилем
echo"<div class='block1'>";


echo"<p><a href='soobsheniya.php' class='lichnoe'>Сообщения</a></p>";
echo"<p><a href='anketa.php' class='lichnoe'>Моя анкета</a></p>";
echo"<p><a href='zagrf.php' class='lichnoe'>Загрузить фото</a></p>";
echo"<p><a href='izobrudal.php' class='lichnoe'>Мои фото</a></p>";
echo"<p><a href='lichnoe.php' class='lichnoe'>Личные данные</a></p>";
echo"<p><a href='metki.php' class='lichnoe'>Доступ к странице</a></p>";
echo"<p><a href='#' onclick='myslipolzovatelya() ; return false;' class='lichnoe'>Введите свою мысль</a></p>";
echo"</div>";
 ?>
</div>
<div class="column2">
<?php
							
echo"<div class='neproch_soobsh'></div>";//блок непрочитанных сообщений ajax

							//модуль вывода последних зарегистрировавшихся в этой группе кроме общей группы
echo"<div class='block2'>";
  							//подсчет приславших мне приглашение дружить
$query=$pdo->prepare("SELECT COUNT(drug) FROM druzyainet WHERE drug=? AND net='0' AND da='0'"); 
$query->execute(array($login));
$num_row=$query->fetchColumn();
							//если есть приславшие приглашения- вывод приглашений
if($num_row>0){
echo"<p>Вас приглашает в друзья:</p>";
$query=$pdo->prepare("SELECT moy FROM druzyainet WHERE drug=? AND net='0' AND da='0' LIMIT $num_row"); 
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
$lich->execute(array($line->moy));
while($line1=$lich->fetch(PDO::FETCH_LAZY))
{
echo"<p>Имя $line1->imya</p>";
echo"<p>Регион $line1->region</p>";
echo"<p>Возраст $line1->vozrast</p>";
$l= izloginanomer($line1->loginp,$pdo);
echo"<p><a href='vdruzya1.php?vdrugi=$l'>Дружить</a>&nbsp;<a href='vdruzya1.php?nevdrugi=$l'>Отказ</a></p>";
}
}
}
echo"</div>";
echo"<div class='block2'>";
							//вывод моей фразы
$query=$pdo->prepare("SELECT texts FROM statusp WHERE login=? ORDER BY data DESC LIMIT 1 "); 
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
echo"<p><img  class='imgmoi' src='$glavfoto' />   $line->texts</p>";
}	
echo"</div>";
echo"<div class='block2'>";
							//вывод последних зарегистрировавшихся в этой группе кроме общей группы
if($metkap!='0'){
$query=$pdo->prepare("SELECT loginp,imya,region,gorod,vozrast FROM lichnoe WHERE metkap=? AND loginp!=? ORDER BY nomp DESC LIMIT 5");
$query->execute(array($metkap,$login));
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
$loginp=$line->loginp;
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$vozrast=$line->vozrast;
$n_l= izloginanomer($loginp,$pdo);
$fotoArray=glavfoto($loginp,$pdo);
				
echo"<p><img src='$fotoArray'  class='imgmoi'/>";
echo"<a href='stdruga.php?id=$n_l'>$imya $vozrast $region </a></p>";
}
}
echo"</div>";
							//END модуля последних зарегистрировавшихся в этой группе кроме общей группы
							//запросы считают и помещают всех друзей в объект $queryFriend
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND da='1' AND net='1') OR (drug=? AND da='1' AND net='1')"); 
$query->execute(array($login,$login));
$friendCount=$query->fetchColumn();
							//если существуют друзья
if($friendCount>0){
$queryFriend=$pdo->prepare("SELECT drug FROM druzyainet WHERE moy=? AND da='1' AND net='1' UNION SELECT moy FROM druzyainet WHERE drug=? AND da='1' AND net='1' LIMIT $friendCount"); 
$queryFriend->execute(array($login,$login));
while($line=$queryFriend->fetch(PDO::FETCH_LAZY)){
$friendName=$line[0];
							//внесение друзей в массив
$friendList=explode(",",$friendName);
} 				
							//из двух массивов $friendList делаем один $friendArray
$friendArray=array_merge($friendList,$friendList);
							//вопросительные знаки по количеству элементов массива для запроса
$in_array=str_repeat('?,',count($friendList)-1)."?";
							//вывод фото и лозунгов друзей в таблице
$queryFriend=$pdo->prepare("SELECT foto,data,loginp FROM fototabl  WHERE loginp  IN ($in_array) UNION SELECT texts,data,login FROM statusp WHERE  login IN ($in_array) LIMIT 20"); //limit 20 - просто так
$queryFriend->execute($friendArray);
while($line=$queryFriend->fetch(PDO::FETCH_LAZY))
{
							//вывод фото или лозунга
$aa=$line[0];
$aa=trim($aa);
$nomer=strpos($aa,' ');//если есть пробел между словами то ставится номер
$massiv=array(".gif",".jpg",".png");
$pos = substr($aa,'-4');
$fotka=$folder1.$aa;
							//блок вывода фото или лозунга
echo"<div class='block2'>";
if (in_array($pos,$massiv)&&($nomer==''))
{
echo"<img src='$fotka'/>";
}							//если фото
else
{
echo"<p>$aa</p>";
}
							//вывод имени друга
$lich=dataFromLogin($line[2],$pdo);
while($line1=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line1->imya;
$region=$line1->region;
$gorod=$line1->gorod;
$datarozd=$line1->datarozd;
$vozrast=$line1->vozrast;
$metkap=$line1->metkap;
$ipp=$line1->ipp;
$limitfoto=$line1->limitfoto;
$osebe=$line1->osebe;
$pol=$line1->pol;
}	
$n_l= izloginanomer($line[2],$pdo);
echo"<a href='stdruga.php?id=$n_l'>$imya</a>";
							//вывод даты опубликования
$dataFriend=$line[1];
echo"<i>$dataFriend</i>"; 
 
echo"</div>";//END блок вывода фото или лозунга
}
}
?>
</div>

<div class="column3">
<?php
							//модуль выхода и показа даты
echo"<div class='block3'>";
echo"<a href='exit.php'>Выход</a>";
echo"<p><script src='/time.js'></script></p>";



echo"</div>";//END модуль выхода и показа даты

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
							//модуль гостей, черного списка
echo"<div class='block3'>";
							//если существуют друзья онлайн
if($friendCount>0){
echo"<p>Друзья</p>";
							//запрос со списком друзей существует и находится выше
							//массив со списком друзей
$friendList;
							//счетчик длявывода данных из массива
$i;
for($i=0;$i<count($friendList);$i++)
{
							//каждый логин помещается в переменную $friendLog
$friendLog=$friendList[$i];
							//по каждому логину запрашиваются его данные
$lich=dataFromLogin($friendLog,$pdo);
while($line1=$lich->fetch(PDO::FETCH_LAZY))
{
							//чтобы меня не показать
if($friendLog!=$login){
$imya=$line1->imya;
$n=izloginanomer($friendLog,$pdo);             
$foto=glavfoto($friendLog,$pdo);

							//проверка на онлайн
$online=isonline($friendLog,$pdo);
echo"<p><img src='$foto'  class='imgmoi'/><a href='stdruga.php?id=$n'>$imya</a>$online</p>";

}
}
}
}

							//вывод тех с кем прервано общение
$query=$pdo->prepare("SELECT COUNT(drug) FROM druzyainet WHERE moy=? AND net='1' AND da='0'");
$query->execute(array($login));
$blackCount=$query->fetchColumn();

							//если существует черный список
if(!empty($blackCount>0)){
echo"<p>Общение прервано с</p>";
							//вывод каждого логина
$query=$pdo->prepare("SELECT drug FROM druzyainet WHERE moy=? AND net='1' AND da='0'");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))
{							//каждый логин помещается в переменную $friendLog
$friendLog=$line[0];
							//по каждому логину запрашиваются его данные
$lich=dataFromLogin($friendLog,$pdo);
while($line1=$lich->fetch(PDO::FETCH_LAZY))
{
							//чтобы меня не показать
if($friendLog!=$login){
$imya=$line1->imya;
$n=izloginanomer($friendLog,$pdo);             
$foto=glavfoto($friendLog,$pdo);
echo"<p><img src='$foto' class='imgmoi'/>$imya<a href='' src='$n' onclick='fromblack(this);return false;'>Возобновить общение</a></p>";
}
}
}
}
 
$query=$pdo->prepare("SELECT  COUNT(login) FROM forgostey WHERE login_q=? ORDER BY data DESC");
$query->execute(array($login));
$guestCount=$query->fetchColumn();
							//если есть гости
if($guestCount>0){
$query=$pdo->prepare("SELECT  DISTINCT login FROM forgostey WHERE login_q=? ORDER BY data DESC");
$query->execute(array($login));


echo"<p>Мои гости</p>";
							//выбор логинов из БД , которые были в гостях
while($line=$query->fetch(PDO::FETCH_LAZY)){

//каждый логин помещается в переменную $friendLog
$friendLog=$line[0];
							//по каждому логину запрашиваются его данные
$lich=dataFromLogin($friendLog,$pdo);
while($line1=$lich->fetch(PDO::FETCH_LAZY))
{
							//чтобы меня не показать
if($friendLog!=$login){
$imya=$line1->imya;
$n=izloginanomer($friendLog,$pdo);             
$foto=glavfoto($friendLog,$pdo);
echo"<p><img src='$foto' class='imgmoi'/><a href='stdruga.php?id=$n'>$imya</a></p>";
}
}
}
}
echo"</div>";//END модуль гостей, черного списка
?>
</div>
<script>onload=neproch_soobsh();</script>
<script>setInterval('neproch_soobsh()',5000);</script>


<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter35753660 = new Ya.Metrika({ id:35753660, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/35753660" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->



</body>


</html>
