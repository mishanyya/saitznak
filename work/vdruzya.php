<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿
<?php

     
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();   

  

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);

//номер login_q
 $login_q_number=izloginanomer($login_q,$pdo);

if(isset($_POST['vdruzya'])||isset($_GET['vdruzya'])){
if(isset($_POST['vdruzya'])){
$vdruzya=$_POST['vdruzya'];
}
else if(isset($_GET['vdruzya'])){
$vdruzya=$_GET['vdruzya'];
}
 
$vdruzya=htmlspecialchars($vdruzya);
							//поиск друга login_q
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND drug=? AND da='1' AND net='1')OR(moy=? AND drug=? AND da='1' AND net='1')");
$query->execute(array($login,$login_q,$login_q,$login));
$friendNameCount=$query->fetchColumn();
							//если такого друга нет
if($friendNameCount=='0')
	{
							//существует ли запрос на дружбу
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND drug=? AND da='0' AND net='0')OR(moy=? AND drug=? AND da='0' AND net='0')");
$query->execute(array($login,$login_q,$login_q,$login));
$friendAskToFriendCount=$query->fetchColumn();

							//если запрос на дружбу существует
if($friendAskToFriendCount=='1')
		{
echo"Запрос на дружбу уже существует";
		}
							//если запроса на дружбу не существует
else 
		{
							//находится ли login_q в 'черном списке'
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE moy=? AND drug=? AND da='0' AND net='1'");
$query->execute(array($login,$login_q));
$friendBlackListCount=$query->fetchColumn();

							//если он у меня в черном списке
if($friendBlackListCount=='1')
			{
echo"находится в черном списке <a class='black' href='fromblack.php?radiodrugb= $login_q_number'>Возобновить общение</a>";
			}
							//если его нет в черном списке то отправляем запрос на дружбу
else
			{
$query=$pdo->prepare("INSERT INTO druzyainet (nom,moy,drug,net,da) VALUES (NULL,?,?,'0','0')");
$query->execute(array($login,$login_q));
echo"Запрос другу отправлен";
			}
		}

	}

else
	{
echo"есть такой друг";
	}

}
							//удалить из друзей
if(isset($_POST['izdruzey'])){

$izdruzey=$_POST['izdruzey'];
$izdruzey=htmlspecialchars($izdruzey);


$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND drug=? AND da='1' AND net='1')OR(moy=? AND drug=? AND da='1' AND net='1')");
$query->execute(array($login,$login_q,$login_q,$login));
							//если есть такой друг
$friendsCount=$query->fetchColumn();
if($friendsCount>0){
$query=$pdo->prepare("DELETE FROM druzyainet WHERE (moy=? AND drug=? AND da='1' AND net='1')OR(moy=? AND drug=? AND da='1' AND net='1')");
$query->execute(array($login,$login_q,$login_q,$login));
echo"Друг удален";
}
							//если такого друга не было
else{
echo"не было такого друга";
}
}

							//поместить в черный список
if(isset($_POST['blacklist'])){
$blacklist=$_POST['blacklist'];
$blacklist=htmlspecialchars($blacklist);

							//имеется ли пара в БД
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND drug=?) OR (moy=? AND drug=?)");
$query->execute(array($login,$login_q,$login_q,$login));

$pareCount=$query->fetchColumn();
							//если есть пара логинов в БД
if($pareCount>0){

							//выбор если я его приглашал в друзья
$query=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE moy=? AND drug=?");
$query->execute(array($login,$login_q));
$moyCount=$query->fetchColumn();
if($moyCount>0){
$query=$pdo->prepare("UPDATE druzyainet SET net='1',da='0' WHERE moy=? AND drug=?");
$query->execute(array($login,$login_q));
}
							//если он меня приглашал в друзья
else{
$query=$pdo->prepare("DELETE FROM druzyainet  WHERE moy=? AND drug=?");
$query->execute(array($login_q,$login));
}
}
else{
$query=$pdo->prepare("INSERT INTO druzyainet (nom,moy,drug,net,da) VALUES (NULL,?,?,'1','0')");
$query->execute(array($login,$login_q));
}
echo"Отношения сейчас разорваны";
}
							//если отправили жалобу на этого пользователя
if(isset($_POST['zgaloba'])){

$zgaloba=$_POST['zgaloba'];
$zgaloba=htmlspecialchars($zgaloba);

$prichina=$_POST['prichina'];
$prichina=htmlspecialchars($prichina);

$query=$pdo->prepare("INSERT INTO zalobyna (nom,login_q,login,vremya,prichina) VALUES (NULL,?,?,?,?)");
$query->execute(array($login_q,$login,$today,$prichina));

echo"Жалоба отправлена";
}
?>
