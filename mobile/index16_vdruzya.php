<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>	
</head>
	<body>
<?php
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";//табл с фото
$userstable1 = "lichnoe";//табл 
$userstable2 = "goroda";//табл с  данными
$userstable3 = "druzyainet";//табл со списком друзей
$userstable4 = "soobsheniya";//табл со списком 
$userstable5 = "polzovateli";//табл со списком 
$userstable6 = "zalobyna";//табл для жалоб
$userstable7 = "statusp";//табл мыслей 
  
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);// проверка для входа

$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

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

echo"Ваше имя $imya  <br>";

$lich->execute(array($login_q));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya_q=$line->imya;
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

echo"Имя к кому зашли $imya_q $isonline<br/>";

if(isset($_GET['vdruzya'])){

$vdruzya=$_GET['vdruzya'];

$vdruzya=iznomera($vdruzya,$pdo);

$vdruzya=htmlspecialchars($vdruzya);
$vdruzya=mysql_real_escape_string($vdruzya);//экранирует символы кроме % и _

//запрос на поиск друзей
$query="SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q' AND da='1') OR (moy='$login_q' AND drug='$login' AND da='1')";

$query=$pdo->query($query);

$query_num=$query->fetchColumn();


echo"кол-во друзей $query_num <br/>";//кол-во друзей

if($query_num=='0'){

//поиск запросов на дружбу
$query="SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q' AND da='0' AND net='0') OR (moy='$login_q' AND drug='$login' AND da='0' AND net='0') ";

$query=$pdo->query($query);

$query_num=$query->fetchColumn();

echo"кол-во запросов в друзья $query_num <br/>";//кол-во запросов в  друзья

if($query_num=='1'){echo"Запрос на дружбу уже существует<a href='index2.php'>На главную страницу</a>";}

else {

//поиск тех кто находится в черном списке пользователя

$query="SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q' AND da='0' AND net='1') OR (moy='$login_q' AND drug='$login' AND da='0' AND net='1') ";

$query=$pdo->query($query);

$query_num=$query->fetchColumn();

echo"кол-во тех кто находится в черном списке пользователя $query_num <br/>";//кол-во запросов в  друзья



if($query_num>'0'){echo"$login_q $imya_q находится в черном списке<a href='index.php'>На главную страницу</a>";}

else{//создать приглашение в друзья
$query="INSERT INTO druzyainet (nom,moy,drug,net,da) VALUES (NULL,'$login','$login_q','0','0')";
$result =$pdo->exec($query);
echo"Запрос $result другу отправлен<a href='index2.php'>На мою страницу</a>";
}
}
}
else{echo"есть такой друг<br/><a href='index.php'>На главную страницу</a>";}
}




if(isset($_GET['izdruzey'])){

$izdruzey=$_GET['izdruzey'];

$izdruzey=iznomera($izdruzey,$pdo);

$izdruzey=htmlspecialchars($izdruzey);

$izdruzey=mysql_real_escape_string($izdruzey);//экранирует символы кроме % и _
//удаляет из списка друзей
$query="DELETE FROM druzyainet WHERE (moy='$login' AND drug='$login_q' AND da='1') OR (moy='$login_q' AND drug='$login' AND da='1') ";

$pdo->exec($query);

echo"Друг удален<br/><a href='index2.php'>На мою страницу</a>";

}





if(isset($_GET['blacklist'])){


$blacklist=$_GET['blacklist'];

$blacklist=iznomera($blacklist,$pdo);

$blacklist=htmlspecialchars($blacklist);
$blacklist=mysql_real_escape_string($blacklist);//экранирует символы кроме % и _

$query="SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q') OR (moy='$login_q' AND drug='$login') ";

$query=$pdo->query($query);

$query_num=$query->fetchColumn();

echo"кол-во тех кто есть в таблице $query_num <br/>";//кол-во  тех кто есть в таблице
if($query_num>'0'){//блокировка пользователя если он был другом
$query="UPDATE druzyainet SET net='1',da='0' WHERE (moy='$login' AND drug='$login_q' AND da='1') OR (moy='$login_q' AND drug='$login' AND da='1') ";

$pdo->exec($query);


echo"Отношения с другом разорваны<br/><a href='index2.php'>На мою страницу</a>";
}
else{
$query="INSERT INTO druzyainet (nom,moy,drug,net,da) VALUES (NULL,'$login','$login_q','1','0')";
$pdo->exec($query);
echo"Отношения разорваны<br/><a href='index2.php'>На мою страницу</a>";
}
}

if(isset($_POST['zgaloba'])){


$zaloba=$_POST['zaloba'];
$zaloba=htmlspecialchars($zaloba);
$zaloba=mysql_real_escape_string($zaloba);//экранирует символы кроме % и _

echo"$zaloba zaloba";


if($zaloba=='zaloba_1'){$prichina='Размещение фотографий эротического или порнографического содержания';}


else if($zaloba=='zaloba_2'){$prichina='Распространение спама или рекламы';}

else if($zaloba=='zaloba_3'){$prichina='Оскорбление пользователей';}

else if($zaloba=='zaloba_4'){$prichina='Регистрация с чужими данными';}

else if($zaloba=='zaloba_5'){$prichina='Распространение информации,по Вашему мнению, с экстремистким , противозаконным или иным содержанием, которая ,по Вашему мнению, не имеет права на существование';}

else {$prichina='Данные не прислали';}

echo"/   $prichina   $login_q   $login  /";
$query="INSERT INTO zalobyna (nom,login_q,login,vremya,prichina) VALUES (NULL,'$login_q','$login','$today','$prichina')";

$pdo->exec($query);

echo"Жалоба отправлена<br/><a href='index2.php'>На мою страницу</a>";

}





?>


</body>


</html>