<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="ajax.js"></script>
<script src="podschet.js"></script>


<?php

include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу
$userstable = "polzovateli";//табл
$userstable1 = "lichnoe";//табл с личными данными
$userstable2 = "goroda";//табл с  данными
$link = mysqli_connect($sdb_name,$user_name,$user_password,$db_name) or die("Could not connect");//соединение с сервером

mysqli_query($link,"SET CHARACTER SET 'utf8';"); //для кодировки
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки
 
?>
<form  action="registr1.php"  method="post">
<?php
if(isset($_GET['a'])&&(isset($_GET['b'])))//значит письмо пришло
{
$login=$_GET['a'];
$vrepar=$_GET['b'];//логин и пароль с полученной эл.почты

$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$login=substr($login,0,30);   //обработка при вводе не больше 30 символов

$vrepar=trim($vrepar);//убирает пробелы из начала и конца поля
$vrepar=htmlspecialchars($vrepar);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
//$vrepar=substr($vrepar,0,30);   //обработка при вводе не больше 30 символов


$result=mysqli_query($link,"UPDATE $userstable SET proveren='1' WHERE loginp='$login'");//ставится значение "1" - подтвержден email



$query="SELECT loginp FROM $userstable WHERE loginp='$login' AND vrepar='$vrepar' AND parp='не задано'";

$result=mysqli_query($link,$query)or die("запрос не удался");//занесение в переменную результата запроса 
$num_rows = mysql_num_rows($result);//возвращает лоличество рядов результата запроса если есть то>0

if($num_rows=='1')
{
$_login=base64_decode($login);
} 


//данные из таблицы
$query="SELECT * FROM $userstable WHERE loginp='$login'";
$result = mysqli_query($link,$query) or die("Query не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
$_imya=$line[1];                        
$_region=$line[2];
$_gorod=$line[3];
$_datarozd=$line[4];
$_vozrast=$line[5];
$_osebe=$line[9];
$_pol=$line[10];
} 




echo"Ваш логин $_login  <br/>";
?>
Введите новый Пароль<input type="password" required  value="" name="parol" id="parol"  onkeyup="podschet()"><i id="par" ></i>
<br/>
Введите Пароль повторно<input type="password" required value="" name="parol1" id="parol1" onkeyup="sravnitdlinupar()"><i id="par1" ></i><br/>

<?php
}
else if(isset($_GET['ig'])&&(isset($_GET['gi'])))//значит письмо не пришло
{
$vrepar_ig=$_GET['ig'];//временный пароль с предыдущей страницы
$vrepar_ig=trim($vrepar_ig);//убирает пробелы из начала и конца поля
$vrepar_ig=htmlspecialchars($vrepar_ig);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$login_gi=$_GET['gi'];//логин с предыдущей страницы
$login_gi=trim($login_gi);//убирает пробелы из начала и конца поля
$login_gi=htmlspecialchars($login_gi);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



$result=mysqli_query($link,"UPDATE $userstable SET proveren='0' WHERE loginp='$login_gi'");//ставится значение "0" - не подтвержден email

$_login=base64_decode($login_gi);

echo"Ваш логин $_login  <br/>";
echo"Ваш email не подтвержден- отправьте пожалуйста с Вашей электронной почты сообщение 'reg' на  <i>admin@vmesteprosto.info</i> ";
?>
<br/>Введите новый Пароль<input type="password" required  value="" name="parol" id="parol"  onkeyup="podschet()"><i id="par" ></i>
<br/>
Введите Пароль повторно<input type="password" required value="" name="parol1" id="parol1" onkeyup="sravnitdlinupar()"><i id="par1" ></i><br/>

<?php

}//окончание else if

?>


Имя<input type="text" required value="" name="imya"><br/>
Регион
<select name="region" >
<?php


$query="SELECT region FROM $userstable2";

$result = mysqli_query($link,$query) or die("Query не получилось");

echo"<option>$_region</option>";

while($line=mysqli_fetch_row($result))//выводит строки пока они не кончатся в бд
{
 echo"<option>$line[0]</option>";
}

?>

</select><br/>
Пол
<select name="pol">
<?php
echo"<option>$_pol</option>";
?>
<option></option>
<option>М</option>
<option>Ж</option>

</select>
<br/>

Ваш город, район или поселок не обязательно<input type="text" value="" name="gorod"><br/>

Дата рождения
Год:<select required name="god">

<?php  
$god;
$go=substr($_datarozd,0,4); 
$mesya=substr($_datarozd,5,2);
$chisl=substr($_datarozd,8,2);


?>

<option><?php echo "$go"; ?></option>
<?php
for($god=$god_70;$god<=$god_18;$god++)
{
?>
<option><?php echo"$god"; ?></option>
<?php
}
?>
</select><br/>

<?php

$f = fopen("month.txt", "r");
$mesy = explode(",",fgets($f));


fclose($f);
?>


Месяц:<select required name="mesyatc">
<option><?php $mesya=$mesya-1; echo "$mesy[$mesya]"; ?></option>

<?php
$i=0;


 
$f = fopen("month.txt", "r");

 
$mesyatc = explode(",",fgets($f)); 
do {
$im=$i+1;
if($im<10){$im="0".$im;}	
?>

<option value="<?php echo "$im"; ?>"><?php echo"$mesyatc[$i]"; ?></option>

<?php



$i++;
}while($i<12);	

fclose($f);
?>
</select><br/>




Число:<select required name="chislo">
<option><?php echo "$chisl"; ?></option>
<?php
$chislo=1;
do {

if($chislo<10){$chislo="0".$chislo;}	
?>

<option><?php echo"$chislo"; ?></option>

<?php
$chislo++;
}while($chislo<=31);	

$_login=base64_encode($_login);//шифрование логина 

?>
</select><br/>

<textarea name="osebe" cols="50" rows="5"></textarea><br/>

Введите  число "2" буквами<input type="text" required name=text1 maxlength=10 size=10 autocomplete="off"><br>
Введите  число "2" цифрами<input type="text" required name=text2 maxlength=10 size=10 autocomplete="off"><br>



<input type="hidden" name="login" value="<?php echo"$_login"; ?>">

<input  type="submit"  value="Зарегистрироваться" name="reg" ><br/>

 </form>
