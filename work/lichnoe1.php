<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>	
<?php

               
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();
$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);

$imya=$_POST['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода 

 $region=$_POST['region']; 
$region=htmlspecialchars($region);

$gorod=$_POST['gorod'];
$gorod=trim($gorod);//убирает пробелы из начала и конца поля
$gorod=htmlspecialchars($gorod);//переводит некоторые спецсимволы, которые могут использоваться для кода 

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
$gorod=mb_convert_case($gorod, MB_CASE_TITLE, 'UTF-8');

$god=$_POST['god'];
$god=trim($god);//убирает пробелы из начала и конца поля
$god=htmlspecialchars($god);//переводит некоторые спецсимволы, которые могут использоваться для кода 

$pol=$_POST['pol']; 
$pol=htmlspecialchars($pol);

$mesyatc=$_POST['mesyatc'];
$mesyatc=trim($mesyatc);//убирает пробелы из начала и конца поля
$mesyatc=htmlspecialchars($mesyatc);//переводит некоторые спецсимволы, которые могут использоваться для кода 

if($mesyatc<10){$mesyatc="0".$mesyatc;} //если число=1 делаем= 01

$lengthmesyatc=strlen($mesyatc);
if($lengthmesyatc>2){$mesyatc=substr($mesyatc,1,2);} //если число=001 делаем= 01

$chislo=$_POST['chislo'];
$chislo=trim($chislo);//убирает пробелы из начала и конца поля
$chislo=htmlspecialchars($chislo);//переводит некоторые спецсимволы, которые могут использоваться для кода 

$osebe=$_POST['osebe'];
$osebe=trim($osebe);//убирает пробелы из начала и конца поля
$osebe=htmlspecialchars($osebe);//переводит некоторые спецсимволы, которые могут использоваться для кода 

$datarozd=$god."-".$mesyatc."-".$chislo;   //дата рождения

$vozrast=raznitcavozrasta($god,$mesyatc,$chislo);

if (isset($_POST['lich']))
{
$lich=$_POST['lich'];
$lich=htmlspecialchars($lich);
if($imya==''){exit("<a href='lichnoe.php'>Введите имя</a>");}
                                     //обновление данных в таблице личное
$query=$pdo->prepare("UPDATE lichnoe SET imya=?,region=? ,gorod=?,datarozd=?,vozrast=?,osebe=?,pol=? WHERE loginp=? LIMIT 1");
$query->execute(array($imya,$region,$gorod,$datarozd,$vozrast,$osebe,$pol,$login));
}
header("location:index.php");
?>