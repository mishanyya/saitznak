<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>

<?php
             

                         
							//если галочка не введена
if(!isset($_POST['text1'])){
exit("галочка не нажата&nbsp;<a href='/aids.php'>Попробуйте еще раз</a>");
}
else{
$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начал{а и конца поля
$text1= strtolower($text1);
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
}   
 
							//если логин не введен
if(!isset($_POST['login'])){
exit("логин или электронный адрес не указан&nbsp;<a href='/aids.php'>Попробуйте еще раз</a>");
}
else{
$login = $_POST['login'];
$login= strtolower($login);
$login=trim($login);
$login=htmlspecialchars($login);
$login=base64_encode($login);
}

							//проверка на повторную регистрацию
$query=$pdo->prepare("SELECT COUNT(loginp) FROM  polzovateli WHERE loginp=?");
$query->execute(array($login));
$num_rows=$query->fetchColumn();   //возвращает количество рядов результата запроса если есть то>0 должно быть 0 
                             
							//если уже зарегистрирован 
if($num_rows>0){
confirmedLogin($login,$pdo);   //если не проверен
exit("<br/>такой логин или электронный адрес уже зарегистрирован&nbsp;<a href='/index.php'>войдите</a>");
}
							//если еще не зарегистрирован
else{		
							//вырабатывается временный пароль для установки пароля 				
$vremen=rand(); 
							//вносится запись нового пользователя с временным паролем
$query=$pdo->prepare("INSERT INTO polzovateli (nomp,loginp,parp,vrepar,timeregistr,proveren,dengymone) VALUES (NULL,?,'не задано',?,NOW(),'0','0')");
$query->execute(array($login,$vremen));

$query=$pdo->prepare("INSERT INTO lichnoe (loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol)VALUES (?,'не указано','не указан','не указан',CURDATE(),'0','1','не указано','5','не указано','не указано')");
$query->execute(array($login));
echo"Вам должно придти сообщение для дальнейшей регистрации- пройдите пожалуйста по ссылке в том сообщении (рекомендуется)";
 echo "<br/>Если сообщение не пришло то пройдите пожалуйста <a href='redaktpar1.php?gi=$login&ig=$vremen'>далее</a>(в этом случае не гарантируется восстановление пароля и могут не работать некоторые функции сайта)"; 
 
$address=base64_decode($login);
$sub="vmesteprosto.info Регистрация";
$mes="Пройдите пожалуйста по ссылке для регистрации http://vmesteprosto.info/modvhodreg/redaktpar1.php?a=$login&b=$vremen  \r\n";
//$from - смотреть в config.php
							//отправка сообщения
mail($address,$sub,$mes,$from);
 

}//если еще не зарегистрирован - конец блока
?>