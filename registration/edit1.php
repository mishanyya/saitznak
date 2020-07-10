<?php
include "../functions.php";//подключить файл с функциями и постоянными переменными, и подключенными файлами config.php и pdo.php
?>


﻿<link rel="stylesheet" type="text/css" href="/css/style.css"/>
<?php


		forenter();//функция для разрешения входа



$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

echo "<br/>login=".$login;
//echo $ip;

							//функция при открытии проверяет наличие логина и совпадение парол и логина
//($login,$ip,$pdo);

$imya=$_POST['imya'];
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода

echo "<br/>imya=".$imya;

 $region=$_POST['region'];
$region=htmlspecialchars($region);
echo "<br/>region=".$region;

$gorod=$_POST['gorod'];
$gorod=trim($gorod);//убирает пробелы из начала и конца поля
$gorod=htmlspecialchars($gorod);//переводит некоторые спецсимволы, которые могут использоваться для кода
echo "<br/>gorod=".$gorod;
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

echo "<br/>god=".$god;

$pol=$_POST['pol'];
$pol=htmlspecialchars($pol);

echo "<br/>pol=".$pol;

$mesyatc=$_POST['mesyatc'];
$mesyatc=trim($mesyatc);//убирает пробелы из начала и конца поля
$mesyatc=htmlspecialchars($mesyatc);//переводит некоторые спецсимволы, которые могут использоваться для кода

echo "<br/>mesyatc=".$mesyatc;

if($mesyatc<10){$mesyatc="0".$mesyatc;} //если число=1 делаем= 01

$lengthmesyatc=strlen($mesyatc);
if($lengthmesyatc>2){$mesyatc=substr($mesyatc,1,2);} //если число=001 делаем= 01

$chislo=$_POST['chislo'];
$chislo=trim($chislo);//убирает пробелы из начала и конца поля
$chislo=htmlspecialchars($chislo);//переводит некоторые спецсимволы, которые могут использоваться для кода

echo "<br/>chislo=".$chislo;


$datarozd=$god."-".$mesyatc."-".$chislo;   //дата рождения

echo "<br/>datarozd=".$datarozd;

$vozrast=raznitcavozrasta($god,$mesyatc,$chislo);

if (isset($_POST['lich']))
{
$lich=$_POST['lich'];
$lich=htmlspecialchars($lich);
if($imya==''){
  exit("<a href='edit.php'>Введите имя!</a>");
}

  echo "<br/>start";
                                   //обновление данных в таблице личное
$query=$pdo->prepare("UPDATE lichnoe SET imya=?/*,region=?*/,gorod=?,datarozd=?,pol=? WHERE loginp=?");
$query->execute(array($imya/*,$region*/,$gorod,$datarozd,$pol,$login));

echo "<br/>ok!!!";//здесь не работает!!!

//header("location:../mainpage.php");
}
else{
  exit("<a href='edit.php'>Попробуйте снова!</a>");
}
?>
