<link rel="stylesheet" type="text/css" href="style.css"/>
<?php

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл с паролями и логинами
$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

 
                                                //модуль с полями для ввода пароля и логина


if(isset($_GET['a'])){
$login=$_GET['a'];
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$login=mysql_real_escape_string($login);//экранирует символы кроме % и _
    }

else if(isset($_GET['ab'])){
$login=$_GET['ab'];
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$login=mysql_real_escape_string($login);//экранирует символы кроме % и _
echo"login пользователя $login <br/> Ваш email не подтвержден. отправьте пожалуйста с вашего email сообщение'zab' на admin@vmesteprosto.info";
 }


?>
<form action="zamenapaq.php" method="POST" >
Введите новый пароль:
<input type="password" required name="parol" maxlength=30 size=30><br/>
Подтвердите пароль:
<input type="password" required name="parol1" maxlength=30 size=30><br/>

<input type="hidden" name="logi" value="<?php echo $login; ?>">

Введите  число "2" буквами<input type="text" required name="text1" maxlength=10 size=10 autocomplete='off'><br/>
Введите  число "2" цифрами<input type="text" required name="text2" maxlength=10 size=10 autocomplete='off'><br/>


<input type="submit"  value="Обновить пароль">
</form>

