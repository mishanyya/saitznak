<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         


                                             //модуль с полями для ввода пароля и логина
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

				
							//Функция при открытии проверяет наличие логина и совпадение парол и логина
($login,$ip,$pdo);							
    
							//если получено GET pn - при переходе с soobsheniya.php при выборе другого адресата
if(isset($_GET['pn']))  
{
$l=$_GET['pn'];
$login_q=iznomera($l,$pdo);                                

$login_q=trim($login_q);
$login_q=htmlspecialchars($login_q);
$_SESSION['login_q']=$login_q;
}
								//если существует login_q 
else if(isset($_SESSION['login_q'])&&(isset($_POST['soobsh']))){
$login_q=$_SESSION['login_q'];
$login_q=trim($login_q);
$login_q=htmlspecialchars($login_q);
$soobsh=$_POST['soobsh'];
$soobsh=trim($soobsh);//убирает пробелы из начала и конца поля
$soobsh=htmlspecialchars($soobsh);//переводит некоторые спецсимволы, которые могут использоваться для кода 
} 
//если нет login_q
else{
header("location:soobsheniya.php");
}


							//проверка наличия адресата в списке адресатов БД
$query=$pdo->prepare("SELECT COUNT(nom) FROM adresatsms WHERE (otkogo=? AND komu=?) OR (komu=? AND otkogo=?)");
$query->execute(array($login,$login_q,$login,$login_q));
$loginCount=$query->fetchColumn();

							//если адресата нет в БД
if($loginCount=='0')
{
$query=$pdo->prepare("INSERT INTO adresatsms (nom,otkogo,komu) VALUES (NULL,?,?)");
$query->execute(array($login,$login_q));
}











if(isset($login)&&(isset($soobsh))&&(isset($login_q)))
{
$query=$pdo->prepare("INSERT INTO soobsheniya (nomer,otkogo,komu,soobshenie,data,otmetka) VALUES (NULL,?, ?,?,?,'0')");
$query->execute(array($login,$login_q,$soobsh,$today));
}	
else{
header("location:soobsheniya.php");
}			

?>

