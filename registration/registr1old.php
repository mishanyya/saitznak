<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>

﻿<link rel="stylesheet" type="text/css" href="/style.css"/>
<?php

$ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$Ref = $_SERVER['HTTP_REFERER']; // получает URL, с которого пришёл посетитель 
if(!isset($_POST['login'])){exit("<a href='$Ref'>попробуйте еще раз</a>");}                                           
$login = $_POST['login'];
$login=trim($login);
$login=htmlspecialchars($login);

							//временный пароль из БД
$query=$pdo->prepare("SELECT vrepar FROM polzovateli WHERE loginp=? LIMIT 1");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY)){
$vremen=$line[0];
}
							//проверка на пустые значения
if (empty($_POST['login'])||empty($_POST['imya'])||empty($_POST['pol'])||empty($_POST['region'])||empty($_POST['god'])||empty($_POST['mesyatc'])||empty($_POST['chislo'])||empty($_POST['parol'])){exit("введены не все значения <a href='redaktpar1.php?gi=$login&ig=$vremen'>вернуться</a>");}

$osebe = $_POST['osebe'];
$osebe=trim($osebe);
$osebe=htmlspecialchars($osebe);

$imya = $_POST['imya'];
							//сделать первую букву заглавной
if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{   
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
// преобразовываем функцией mb_convert_case
$imya=mb_convert_case($imya, MB_CASE_TITLE, 'UTF-8');
$imya=trim($imya);
$imya=htmlspecialchars($imya);

$pol = $_POST['pol'];
$pol=htmlspecialchars($pol);

$region = $_POST['region'];
$region=htmlspecialchars($region);

$gorod = $_POST['gorod'];
$gorod=trim($gorod);
$gorod=htmlspecialchars($gorod);


							//сделать первую букву заглавнойlichnoe
/*
 * проверяем, что функция mb_ucfirst не объявлена
 * и включено расширение mbstring (Multibyte String Functions)
 */
if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{$imya=htmlspecialchars($imya);
    /*
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
               mb_substr($str, 1, mb_strlen($str), $eregiongorodncoding);
        return $str;$imya=htmlspecialchars($imya);
    }
}							
$gorod=mb_convert_case($gorod, MB_CASE_TITLE, 'UTF-8');


$god = $_POST['god'];
$god=htmlspecialchars($god);

$mesyatc = $_POST['mesyatc'];
$mesyatc=htmlspecialchars($mesyatc);

$chislo = $_POST['chislo'];
$chislo=htmlspecialchars($chislo);

							//дата рождения
$datarozd=$god."-".$mesyatc."-".$chislo;   

							//возрастpolzovateli
$vozrast=raznitcavozrasta($god,$mesyatc,$chislo);

$parol = $_POST['parol'];
$parol=trim($parol);
$parol=htmlspecialchars($parol);
$parol=sha1($parol);//зашифровка пароля

$parol1 = $_POST['parol1'];
$parol1=trim($parol1);
$parol1=htmlspecialchars($parol1);
$parol1=sha1($parol1);//зашифровка пароля

							//сравнение паролей
if($parol!=$parol1){exit("введены разные пароли <a href='redaktpar1.php?gi=$login&ig=$vremen'>повторить</a>");}

							//проверка введенного поселка на наличие в базе данных							
$query=$pdo->prepare("SELECT COUNT(gorod) FROM regiongorod where region=? AND gorod=? LIMIT 1");
$query->execute(array($region,$gorod));
$num_rows=$query->fetchColumn();
						
							//если такого поселка в БД нет
if($num_rows==0){
$query=$pdo->prepare("INSERT INTO regiongorod (region,gorod,nom) VALUES(?,?,NULL)");
$query->execute(array($region,$gorod));
}

							//обновление данных нового пользователя в БД 
$query=$pdo->prepare("UPDATE polzovateli SET parp=? WHERE loginp=? LIMIT 1");
$query->execute(array($parol1,$login));
$query=$pdo->prepare("UPDATE lichnoe SET imya=?,region=?,gorod=?,datarozd=?,vozrast=?,ipp=?,osebe=?,pol=? WHERE loginp=? LIMIT 1");
$query->execute(array($imya,$region,$gorod,$datarozd,$vozrast,$ip,$osebe,$pol,$login));
                          
							//вставляем новую запись в таблицу anketa
$query=$pdo->prepare("INSERT INTO anketa (loginp,obrazovanie,zanyatiya,prozhivanie,deti,uvlechenie,privichki,dopolnitelno) VALUES(?,'','','','','','','')");
$query->execute(array($login));							
							
							//помещаем логин и ип в сессию
session_start();//инициируем сессию  
$_SESSION['login']=$login;
$_SESSION['ip']=$ip;
echo"Вы успешно зарегистрировались <a href='/modredpol/index.php'>далее</a>";
 
?>
                                                     
