<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php



$ip = $_SERVER['REMOTE_ADDR'];
session_start();//открыть сессию
$id_session = session_id();//коэффициент сессии

?>
<script src="ajax.js"></script>
<script src="podschet.js"></script>

﻿<link rel="stylesheet" type="text/css" href="/style.css"/>

<?php


                                             //модуль согласия с правилами сайта
if(!isset($_POST['text1'])){
exit("Вы не подтвердили согласие с правилами использования сайта! <a href='/registr.php'>Вернуться</a>");

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
$query=$pdo->prepare("INSERT INTO polzovateli (loginp,parp,vrepar,timeregistr) VALUES (?,'не задано',?,NOW())");
$query->execute(array($login,$vremen));//+

$query=$pdo->prepare("INSERT INTO anketa (loginp) VALUES (?)");
$query->execute(array($login));//+

$query=$pdo->prepare("INSERT INTO lichnoe (loginp,datarozd,ipp) VALUES (?,CURRENT_DATE(),?)");
$query->execute(array($login,$ip));//+

$query=$pdo->prepare("INSERT INTO adminblockedlog (login) VALUES (?)");
$query->execute(array($login));//+

$query=$pdo->prepare("INSERT INTO finansy (loginp) VALUES (?)");
$query->execute(array($login));//+

$query=$pdo->prepare("INSERT INTO statusp (loginp,data) VALUES (?,NOW())");
$query->execute(array($login));//+

$query=$pdo->prepare("INSERT INTO metki (loginp) VALUES (?)");
$query->execute(array($login));//+

$query=$pdo->prepare("INSERT INTO threetimesblock (loginp,ip,timer) VALUES (?,?,NOW())");
$query->execute(array($login,$ip));//+

$query=$pdo->prepare("INSERT INTO online (loginp,idsession) VALUES (?,?)");
$query->execute(array($login,$id_session));//+



/*пока отменяем верификацию, она будет по желанию!

							//адрес кому отправляется письмо
$address=base64_decode($login);
$sub="vmesteprosto.info Регистрация";

$mes="Пройдите пожалуйста по ссылке для регистрации http://vmesteprosto.info/modvhodreg/redaktpar1.php?a=$login&b=$vremen  \r\n";
//$from - смотреть в config.php
							//отправка сообщения

mail($address,$sub,$mes,$from);
*/
													//обновление временного пароля у логина

//$_SESSION['login']=$login;
//echo "Сообщение  отправлено!<br/>Сообщение  придет в течение некоторого времени, в зависимости от загрузки сети,также оно может находиться в папке 'Спам'<br/>Если не пришло отправьте его <a href='registr.php'>еще раз</a> или  <a href='mailto:admin@vmesteprosto.info'>нажмите на ссылку для отправки нам сообщения и Вас зарегистрируют в ближайщее время</a>";
?>
<form  action="registr2.php"  method="post">

Создайте новый пароль
<input type="password" required  value="" name="parol" id="parol"  onkeyup="podschet()"><i id="par"></i>

Введите пароль повторно
<input type="password" required value="" name="parol1" id="parol1" onkeyup="sravnitdlinupar()"><i id="par1"></i>


<input type="hidden" name="login" value="<?php echo "$login"; ?>">

<input  type="submit"  value="Зарегистрироваться" name="reg" ><br/>

 </form>
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
