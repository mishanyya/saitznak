<?php
include "/functions.php";//подключить файл с функциями и постоянными переменными
include "/work/general.php";//присоединить файл с общими функциями страниц пользователя сайта
?>


﻿<?php
echo "string";
//если есть логин другого пользователя
/*if(isset($_SESSION['login_q']))
{
$login_q=$_SESSION['login_q'];
$login_q=htmlspecialchars($login_q);
}*/

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
//$ip=$_SESSION['ip'];
//$ip=htmlspecialchars($ip);
							//вывод непрочитанных сообщений
$query=$pdo->prepare("SELECT DISTINCT otkogo FROM soobsheniya WHERE komu=? AND otmetka='0'");
$query->execute(array($login));
while($login_q=$query->fetch(PDO::FETCH_LAZY))//помещение в массив строк из бд
{
$lich_q=dataFromLogin($login_q[0],$pdo);
while($line_q=$lich_q->fetch(PDO::FETCH_LAZY))
{
$loginp_log_q=$line_q->loginp;
$imya_log_q=$line_q->imya;
$ipp_log_q=$line_q->ipp;
}
//шифрование каждого логина + ip
$fortranslate=loginencode($loginp_log_q,$ipp_log_q);
if(empty($fortranslate)){
  echo "<p>писем пока нет</p>";
}
else{
  echo"<p><a href='soobsheniya.php?id=$fortranslate'>У Вас непрочитанное письмо от $imya_log_q</a></p>";
}
}

//Этот запрос временно, просто для проверки работы
$countfriendsquery=$pdo->prepare("SELECT COUNT(otkogo) FROM soobsheniya WHERE komu=? AND otmetka='0'");//подсчет заявок в друзья
$countfriendsquery->execute(array($login));
$countfriends_num=$countfriendsquery->fetchColumn();
if($countfriends_num==0){
  echo "Приглашения в друзья отсутствуют, эта ф-ция временная!";
}
else {
  echo "Приглашения в друзья существуют, эта ф-ция временная!";
}

?>
