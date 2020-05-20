<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         

session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();					
							//логин и ип выводим из сессии
$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//вывод главного фото и имени
$glavfoto=$_SESSION['glavfoto'];
$glavfoto=htmlspecialchars($glavfoto);							
$imya=$_SESSION['imya'];
$imya=htmlspecialchars($imya);

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

echo"<a href='index.php' class='naglavnuyu'>На мою страницу</a>";
?>
