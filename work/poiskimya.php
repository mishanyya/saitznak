	<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>
<?php



session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
 
//Функция при открытии проверяет наличие логина и совпадение парол и логина
($login,$ip,$pdo);


$imya=$_GET['imya']; 
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);

if($imya!=''){
$imya="%$imya%";
$query=$pdo->prepare("SELECT imya FROM lichnoe WHERE imya LIKE ? LIMIT 20");
$query->execute(array($imya));

while($line=$query->fetch(PDO::FETCH_LAZY)){
echo "<li><a href='' onClick='izlivinput(this); return false;'>$line[0]</a></li>";
}}
?>


