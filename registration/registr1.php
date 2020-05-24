<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php



$ip = $_SERVER['REMOTE_ADDR'];
session_start();//открыть сессию
$id_session = session_id();//коэффициент сессии


                                             //модуль согласия с правилами сайта
if(!isset($_POST['text1'])){
exit("Вы не подтвердили согласие с правилами использования сайта! <a href='/registr.php'>Вернуться</a>");
}

//если для регистрации используется email
if(isset($_POST['ifemail'])){
$email='1';
}
else{
  $email='0';
}
/*else{
$text1 = $_POST['text1'];
$text1 =strtolower($text1);//переводит в нижний регистр
$text1=trim($text1);
$text1=htmlspecialchars($text1);
}*/


                                              //модуль ввода и зашифровки логина
$login = $_POST['login'];
$login =strtolower($login);//переводит в нижний регистр
$login=trim($login);
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование логина

						                               	//модуль поиска введенного логина в БД
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=?");

$query->execute(array($login));

$loginCount=$query->fetchColumn();

							//если такой  логин уже есть
if($loginCount>0){
exit("Такой логин уже есть <a href='/index.php'>Войдите</a>");
}
							//если такого логина еще нет
else{
						//вырабатывается временный пароль для установки пароля
$vremen=rand();//на случай подтверждения логина - электронной почты
							//вставка логина в БД
              //этот код работает

//ввод нового логина сразу в несколько основных таблиц в БД
$query=$pdo->prepare("INSERT INTO polzovateli (loginp,parp,vrepar,timeregistr,proveren) VALUES (?,'не задано',?,NOW(),?)");
$query->execute(array($login,$vremen,$email));//+
//echo "1";
$query=$pdo->prepare("INSERT INTO anketa (loginp) VALUES (?)");
$query->execute(array($login));//+
//echo "2";
$query=$pdo->prepare("INSERT INTO lichnoe (loginp,datarozd,ipp) VALUES (?,CURRENT_DATE(),?)");
$query->execute(array($login,$ip));//+
//echo "3";
$query=$pdo->prepare("INSERT INTO adminblockedlog (login) VALUES (?)");
$query->execute(array($login));//+
//echo "4";
$query=$pdo->prepare("INSERT INTO finansy (loginp) VALUES (?)");
$query->execute(array($login));//+
//echo "5";
$query=$pdo->prepare("INSERT INTO statusp (loginp,data) VALUES (?,NOW())");
$query->execute(array($login));//+
//echo "6";
$query=$pdo->prepare("INSERT INTO metki (loginp) VALUES (?)");
$query->execute(array($login));//+
//echo "7";
$query=$pdo->prepare("INSERT INTO threetimesblock (loginp,timer) VALUES (?,NOW())");
$query->execute(array($login));//+
//echo "8";
$query=$pdo->prepare("INSERT INTO online (loginp,idsession) VALUES (?,?)");
$query->execute(array($login,$id_session));//+
//echo "9";



?>
<!DOCTYPE html>
<html>
<head>
  <meta name="Keywords" content="<?php echo $keywords; /*показать keywords для сайта*/?>"/>
  <meta name="Description" content="<?php echo $description; /*показать description для сайта*/?>"/>
  <title><?php echo $title; /*показать title*/?></title>





  <script src="js/ajax.js"></script>
  <script src="js/opisanie.js"></script>
  <script src="js/podschet.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/style.css"/>
<link href='https://fonts.googleapis.com/css?family=Rubik+Mono+One|Yeseva+One|Prosto+One|Press+Start+2P|Playfair+Display+SC|Marck+Script|Bad+Script|Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body onload="islatinfont(id)">
<div>
  <img src='<?php echo EMBLEMA ;?>' class='rounded mx-auto d-block emblemaindex' alt="<?php echo $alt; /*показать alt для эмблемы сайта*/?>">
  <h1 class='display-3 mx-auto  d-flex justify-content-center'><?php echo IMYASAYTA; ?></h1>


<form action="registr2.php" method="POST" class='vhod'>


<p class="h4 text-primary">Создайте новый пароль:</p>
<input type="text" required  value="" name="parol" id="parol"  onkeyup="podschet()">
<p><i id="par"></i></p>
<p class="h4 text-primary">Введите пароль повторно:</p>
<input type="password" required value="" name="parol1" id="parol1" onkeyup="sravnitdlinupar()">
<p><i id="par1"></i></p>
<input type="hidden" name="login" value="<?php echo "$login"; ?>">
<input  type="submit"  value="Зарегистрироваться" name="reg" ><br/>

</form>
</div>

</body>
</html>







<?php



}//окончание цикла

/*подсчет затронутых строк
$stmt->execute();
$count = $stmt->rowCount();

if($count =='0'){
    echo "Failed !";
}
else{
    echo "Success !";
}
*/
?>
