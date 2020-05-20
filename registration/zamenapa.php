<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>
<?php


							//если зашли по ссылке заменить пароль
if(isset($_GET['ab'])){
$login=$_GET['ab'];
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
 }
//если зашли напрямую
else{
exit("<a href='/index.php'>зайти на сайт</a>");
}


?>
<form action="zamenapaq.php" method="POST" >
Введите новый пароль:
<input type="password" required name="parol" maxlength='40' size='40'><br/>
Подтвердите пароль:
<input type="password" required name="parol1" maxlength='40' size='40'><br/>
<input type="hidden" name="logi" value="<?php echo $login; ?>">
<input type="submit"  value="Обновить пароль">
</form>

