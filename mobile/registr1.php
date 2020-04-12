<link rel="stylesheet" type="text/css" href="style.css"/>
<?php


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";//табл с личными данными
$userstable2 = "goroda";//табл с городами

$userstable3="regiongorod";//табл для регионов с городами

$link = mysqli_connect($sdb_name,$user_name,$user_password,$db_name) or die("Could not connect");//соединение с сервером

mysqli_query($link,"SET CHARACTER SET 'utf8';"); //для кодировки
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
                                                //модуль с полями для ввода пароля и логина
?>                                                     
<?php

$ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
                                             //модуль ввода данных в переменные 
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$login=substr($login,0,30);   //обработка при вводе не больше 30 символов


$osebe = $_POST['osebe'];//передает значение из поля в переменную
$osebe=trim($osebe);//убирает пробелы из начала и конца поля
$osebe=htmlspecialchars($osebe);

$imya = $_POST['imya'];//передает значение из поля в переменную
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$imya=substr($imya,0,30);   //обработка при вводе не больше 30 символов

$pol = $_POST['pol'];//передает значение из поля в переменную
$pol=htmlspecialchars($pol);

$region = $_POST['region'];//передает значение из поля в переменную

$gorod = $_POST['gorod'];//передает значение из поля в переменную
$gorod=trim($gorod);//убирает пробелы из начала и конца поля
$gorod=htmlspecialchars($gorod);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$gorod=substr($gorod,0,30);   //обработка при вводе не больше 30 символов

//


//сделать первую букву заглавной

/**
 * проверяем, что функция mb_ucfirst не объявлена
 * и включено расширение mbstring (Multibyte String Functions)
 */
if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    /**
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
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


//





$god = $_POST['god'];//передает значение из поля в переменную

$mesyatc = $_POST['mesyatc'];//передает значение из поля в переменную

$chislo = $_POST['chislo'];//передает значение из поля в переменную

$datarozd=$god."-".$mesyatc."-".$chislo;   //дата рождения

$vozrast=raznitcavozrasta($god,$mesyatc,$chislo);//возраст

$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol=substr($parol,0,30);   //обработка при вводе не больше 30 символов
$parol=sha1($parol);//зашифровка пароля

$parol1 = $_POST['parol1'];//передает значение из поля в переменную
$parol1=trim($parol1);//убирает пробелы из начала и конца поля
$parol1=htmlspecialchars($parol1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol1=substr($parol1,0,30);   //обработка при вводе не больше 30 символов
$parol1=sha1($parol1);//зашифровка пароля

$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начала и конца поля
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text1=substr($text1,0,30);   //обработка при вводе не больше 30 символов

$text2 = $_POST['text2'];//передает значение из поля в переменную
$text2=trim($text2);//убирает пробелы из начала и конца поля
$text2=htmlspecialchars($text2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text2=substr($text2,0,30);   //обработка при вводе не больше 30 символов 




$query="SELECT gorod FROM $userstable3 where region='$region' AND gorod='$gorod'";//запрос на выбор всех записей из таблицы 
$result=mysqli_query($link,$query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysqli_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 

if($num_rows==0){
$query="INSERT INTO $userstable3 (region,gorod,nom) VALUES('$region','$gorod',NULL)";//запрос на выбор всех записей из таблицы 
$result=mysqli_query($link,$query)or die("запрос не удался");//занесение в переменную результата запроса 
}

   

$query2="select loginp from $userstable where loginp='$login'";//запрос на выбор всех записей из таблицы 
$result2=mysqli_query($link,$query2)or die("запрос не удался11");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result2);//возвращает лоличество рядов результата запроса если есть то>0 
//echo "$num_rows";//количество рядов результата запроса
                                        //модуль вставки данных в таблицу клиента
if(!empty($login)&($parol==$parol1)&($text1=="два")&($text2=="2")&($num_rows=='1'))
{
$result1 = mysqli_query($link,"UPDATE $userstable SET parp='$parol1' WHERE loginp='$login'");


$result2 = mysqli_query($link,"UPDATE $userstable1 SET imya='$imya',region='$region',gorod='$gorod',datarozd='$datarozd', vozrast='$vozrast',ipp='$ip',osebe='$osebe',pol='$pol' WHERE loginp='$login'");


if(($result1 == 'true')&($result2 == 'true'))
{echo"Вы успешно зарегистрировались";
session_start();//инициируем сессию  

$_SESSION['login']=$login;//создается сессия логина
$_SESSION['ip']=$ip;//создается сессия ip
echo"<a href=/modredpol/index.php>Далее </a>";

}
else{header("Location:index.php");}



}             //если логин вписан и пароли в полях совпадают       

else{header("Location:index.php");} 
  




?>
                                                     
