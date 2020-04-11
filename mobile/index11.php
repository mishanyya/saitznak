<script src="poiskimya.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="opisanie.js" type="text/javascript"></script>
<script src="myslipolzovatelya.js" type="text/javascript"></script>
<script src="neproch_soobsh.js" type="text/javascript"></script>

<script src="izlivinput.js" type="text/javascript"></script>

<form  action="index4.php"  method="post">

&nbsp;<b class='s'>Поиск </b> (при незаполненных полях покажет всех пользователей)<br/><br/>

&nbsp;<b class='s'>Имя</b>&nbsp;<input type="text" autocomplete="off"   name="imya" onkeyup="poiskimya()">
<ul name="imya1"></ul>

<?php

//ошибки показывать

ini_set("display_errors",1);
error_reporting(E_ALL);
//подключить файлы

session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем 

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

provlogparip($login,$ip,$pdo);//проверка при входе

$metka=$_SESSION['metkap'];//метка моей группы

echo"=  $metka =";
if($metka!=0){
?>
&nbsp;<b class='s'>Из вашей группы</b><input type="checkbox" checked name="check[]" value="<?php echo $metka ?>"><br/>
<?php
}
?>

<br/>
&nbsp;<b class='s'>Пол</b>&nbsp;
<select name="pol">
<option></option>
<option>М</option>
<option>Ж</option>

</select><br/>

&nbsp;<b class='s'>Регион</b>&nbsp;
<select name="region" >
<?php

$region=$pdo->query("SELECT region FROM goroda");

echo"<option>$_region</option>";

while($line=$region->fetch(PDO::FETCH_LAZY))
{
echo"<option>$line->region</option>";
}
?>

</select><br/>

<?php  

$vozrast=date("Y");//для размещения в select option
$vozrast_70=$vozrast-$god_70;
$vozrast_18=$vozrast-$god_18;

$vozrast_t;
?>

&nbsp;<b class='s'>Возраст от&nbsp;</b><select name="vozrast1">

<?php
for($vozrast_t=$vozrast_18;$vozrast_t<=$vozrast_70;$vozrast_t++)
{
?>
<option value="<?php echo"$vozrast_t"; ?>"><?php echo"$vozrast_t"; ?></option>
<?php
}
?>
</select>
<b class='s'>до&nbsp;</b><select name="vozrast2">

<?php
for($vozrast_t=$vozrast_70;$vozrast_t>=$vozrast_18;$vozrast_t--)
{
?>
<option value="<?php echo"$vozrast_t"; ?>"><?php echo"$vozrast_t"; ?></option>
<?php
}
?>
</select><br/><br/>


&nbsp;<input  type="reset"  value="Очистить поля"><br/><br/>
&nbsp;<input  type="submit"  value="Найти" name="lich">
 </form>
