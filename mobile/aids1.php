<link rel="stylesheet" type="text/css" href="style.css"/>

<?php
include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$userstable1 = "lichnoe";//табл 
$link = mysqli_connect($sdb_name,$user_name,$user_password,$db_name) or die("Could not connect");//соединение с сервером

mysqli_query($link,"SET CHARACTER SET 'utf8';"); //для кодировки
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
                                                //модуль с полями для ввода пароля и логина
?>
<?php
//email-пользователя
                                             //модуль ввода данных в переменные 

$text1 = $_POST['text1'];//передает значение из поля в переменную
$text1=trim($text1);//убирает пробелы из начала и конца поля
$text1=htmlspecialchars($text1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text1=substr($text1,0,30);   //обработка при вводе не больше 30 символов

$text2 = $_POST['text2'];//передает значение из поля в переменную
$text2=trim($text2);//убирает пробелы из начала и конца поля
$text2=htmlspecialchars($text2);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$text2=substr($text2,0,30);   //обработка при вводе не больше 30 символов
   
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

//$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 

$login=substr($login,0,30);   //обработка при вводе не больше 30 символов
$login=base64_encode($login);//шифрование логина 

$query="select loginp from $userstable where loginp='$login'";//запрос на выбор всех записей из таблицы $usertable1
$result=mysqli_query($link,$query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysqli_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0 

                                        //модуль вставки данных в таблицу клиента
if(!empty($login)&($text1=="два")&($text2=="2")&($num_rows==0))
{
$vremen=rand(); //вырабатывается временный пароль для установки пароля 

//timeregistr дата регистрации
//proveren если "0" то не подтвержден, если "1" то подтвержден
//dengymone виртуальные деньги- при регистрации=0
$result = mysqli_query($link,"INSERT INTO $userstable (nomp,loginp,parp,vrepar,timeregistr,proveren,dengymone) VALUES (NULL,'$login','не задано', '$vremen',NOW(),'0','0')");

$result2 = mysqli_query($link,"INSERT INTO $userstable1 (loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol) VALUES ('$login','','','',CURDATE(),'0','1','','5','','')");//1-ВИ

//Если запрос пройдет успешно то в переменную result вернется true 
/*
if($result2 == 'true') 
{echo "<script>alert('Ваш логин  введен') </script>";}
else{echo "<script>alert('Ваш логин не введен')</script>";} 
*/


$address =base64_decode($login); //адрес кому отправляется письмо 

$sub = "Это сообщение с моего сайта Зарегистрироваться";

$mes = "Ваш временный пароль http://vmesteprosto.info/modvhodreg/redaktpar1.php?a=$login&b=$vremen \nРегистрация </a>\n";

/*
$title = substr(htmlspecialchars(trim($_POST['title'])), 0, 1000);
$mess = substr(htmlspecialchars(trim($_POST['mess'])), 0, 1000000);
// $to - кому отправляем
$to = 'test@test.ru';
// $from - от кого
$from='test@test.ru';
// функция, которая отправляет наше письмо.
mail($to, $title, $mess, 'From:'.$from);
echo 'Спасибо! Ваше письмо отправлено.'; 
*/




$hea  = "Content-type: text/html; charset=utf-8 \r\n"; 
$hea .= "From: <admin@vmesteprosto.info>\r\n"; 

$send = mail ($ads, $sub, $mes,$hea); 







/* if (($send == 'true')&($result == 'true'))
{*/
echo"Вам отправлено эл.письмо - для подтверждения вашего email пройдите пожалуйста по ссылке в этом письме";
echo"<br/>Если Вы не получили этого письма пройдите по <a href='redaktpar1.php?gi=$login&ig=$vremen'>ссылке</a>";

/*}*///это на локальном сервере пока убираем
  
//else{echo "Сообщение не  отправлено!<a href='registr.php'>Вернуться назад</a>";}//это на локальном сервере пока убираем

}//окончание цикла

else{
echo"<script>alert('Вы уже зарегистрированы')</script><a href='/index.php'>Войти</a>";

/*Header("Location: /index.php");*/}

          


?>
</form>
