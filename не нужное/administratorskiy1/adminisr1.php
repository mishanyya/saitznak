<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

<link rel="stylesheet" type="text/css" href="/style.css"/>



<?php
$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
                                                                                               
$login = $_POST['login'];
$login=trim($login);
$login=htmlspecialchars($login);

$loginl="bWlzaGFueXlh";
$parolp="f46c3b24cda23dba2b6dd52691dfacdb40db3894";


if(($login==$loginl) & ($parol==$parolp)){

echo"<a href='adminisr.php'>Вернуться</a>";
}
else{
threetimes($login,$parol,$pdo);
header("location:index.php");

}

if(isset($_POST['prosm'])){
if(isset($_POST['toadmin'])){
$toadmin = $_POST['toadmin'];
$toadmin=trim($toadmin);
$login_polzovatelya=htmlspecialchars($toadmin);

$log=base64_decode($login_polzovatelya);//шифрование
echo"Логин выбранного пользователя $log <br/>";



$query=$pdo->prepare("SELECT texts FROM statusp WHERE login=? UNION SELECT soobshenie FROM soobsheniya WHERE otkogo=?");
$query->execute(array($login_polzovatelya,$login_polzovatelya));

while($line=$query->fetch(PDO::FETCH_LAZY)){
echo"$line[0]<br/>";
}

$query=$pdo->prepare("SELECT foto FROM fototabl WHERE loginp=?");
$query->execute(array($login_polzovatelya));
while($line=$query->fetch(PDO::FETCH_LAZY)){
echo"<img src='/modredpol/fotosait/$line[0]'><br/>";
}

?>

<form method="post" action="adminisr2.php">
<input type="hidden" value="<?php echo $parol ?>" name="parol">
<input type="hidden" value="<?php echo $login ?>" name="login">
<input type="hidden" name="login_polzovatelya" value="<?php echo $login_polzovatelya ?>">
<input type="submit" name="otadminablock" value="заблокировать пользователю вход на его страницу">
</form>

<?php
}}

if(isset($_POST['razbl'])){
if(isset($_POST['fromadmin'])){
$fromadmin = $_POST['fromadmin'];
$fromadmin=trim($fromadmin);
$login_polzovatelya=htmlspecialchars($fromadmin);

$log=base64_decode($login_polzovatelya);//шифрование
echo"Логин выбранного пользователя $log <br/>";


$query=$pdo->prepare("DELETE FROM adminblockedlog  WHERE login=?");
$query->execute(array($login_polzovatelya));

echo "<a href='adminisr.php'>Продолжить</a>";
}}
?>