<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными  

$radiovalue=$_GET['radiovalue'];
$radiovalue=htmlspecialchars($radiovalue);

$query=$pdo->prepare("UPDATE  polzovateli  SET proveren='1' WHERE loginp=? LIMIT 1");
$query->execute(array($radiovalue));

?>