<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>
<script src="ajax.js"></script>
<script src='podtverdit.js'></script>
﻿<link rel="stylesheet" type="text/css" href="/style.css"/>



<form method="post" action="adminisr1.php">

<?php
$parol = $_POST['papapp'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);

$parol=sha1($parol);// зашифровка пароля
                                                                                               
$login = $_POST['lalall'];
$login=trim($login);
$login=htmlspecialchars($login);

$login=base64_encode($login);


//echo"mishanyya +$login <br/> ";ndex.php

$loginl="bWlzaGFueXlh";
$parolp="f46c3b24cda23dba2b6dd52691dfacdb40db3894";


if(($login==$loginl) & ($parol==$parolp)){
echo"Все на кого есть жалобы <br/>";
}
else{
header("location:index.php");
}
$query=$pdo->query("SELECT login_q,login,vremya,prichina FROM zalobyna");

while($line=$query->fetch(PDO::FETCH_LAZY)){
echo"<input type='radio' name='toadmin' value='$line[0]'>";

$log=base64_decode($line[0]);//дешифрование
echo"$log";
$logi=base64_decode($line[1]);//дешифрование
echo"&nbsp;Жалоба &nbsp; от $logi ->$line[3]&nbsp; $line[2]";

echo"<br/>";
}

echo"Заблокированные пользователи<br/>";
$query=$pdo->query("SELECT distinct login FROM adminblockedlog");
while($line=$query->fetch(PDO::FETCH_LAZY)){
echo"<input type='radio' name='fromadmin' value='$line[0]'>";
$log=base64_decode($line[0]);//шифрование
echo"$log";
echo"<br/>";
}
?>
<input type="hidden" value="<?php echo $parol ?>" name="parol">
<input type="hidden" value="<?php echo $login ?>" name="login">
<?php
echo"<input type='submit' name='prosm' value='Просмотреть'>";
echo"<input type='submit' name='razbl' value='Разблокировать'>";
?>
</form>

<?php
echo"Неподтвержденные пользователи<br/>";
$query=$pdo->query("SELECT loginp FROM polzovateli WHERE proveren='0'");

while($line=$query->fetch(PDO::FETCH_LAZY)){
echo"<input type='radio' name='confirmlogin' value='$line[0]' onclick='podtverdit()'>";

$log=base64_decode($line[0]);//шифрование
echo"$log";

echo"<br/>";
}
?>



