<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<link rel="stylesheet" type="text/css" href="/style.css"/>
<script src="ajax.js"></script>
<script src="podschet.js"></script>


<?php


?>
<form  action="registr1.php"  method="post">
<?php
							//значит письмо пришло
if(isset($_GET['a'])&&(isset($_GET['b'])))
{
							//получение логина и временного пароля через почту
$login=$_GET['a'];
$vrepar=$_GET['b'];
$login=trim($login);
$login=htmlspecialchars($login);
$vrepar=trim($vrepar);
$vrepar=htmlspecialchars($vrepar);

							//получение почты и обновление статуса на 'проверенный'
$query=$pdo->prepare("UPDATE polzovateli SET proveren='1' WHERE loginp=? LIMIT 1");
$query->execute(array($login));
}
else if(isset($_GET['gi'])&&(isset($_GET['ig'])))
{							//получение логина и временного пароля
$login=$_GET['gi'];
$vrepar=$_GET['ig'];
$login=trim($login);
$login=htmlspecialchars($login);
$vrepar=trim($vrepar);
$vrepar=htmlspecialchars($vrepar);
}
							//если вход просто по адресу
else{exit("<a href='/index.php'>в начало</a>");}
							
							//проверка на существование логина и временного пароля
$query=$pdo->prepare("SELECT COUNT(loginp) FROM polzovateli WHERE loginp=? AND vrepar=?");
$num_row=$query->execute(array($login,$vrepar));
if($num_row=='0'){exit("<a href='/index.php'>в начало</a>");}



//декодирование
$_loginDecode=base64_decode($login);

echo"Ваш логин $_loginDecode <br/>";
?>
<br/>
Введите новый пароль<br/>
<input type="password" required  value="" name="parol" id="parol"  onkeyup="podschet()"><i id="par" ></i>
<br/>
Введите пароль повторно<br/>
<input type="password" required value="" name="parol1" id="parol1" onkeyup="sravnitdlinupar()"><i id="par1" ></i><br/>
Введите имя<br/>
<input type="text" required value="" name="imya">
<br/>
Введите регион<br/>
<select name="region" >
<?php
							//выбор регионов из БД
echo"<option></option>";
$query=$pdo->query("SELECT region FROM goroda LIMIT 90");
while($line=$query->fetch(PDO::FETCH_LAZY))
{
 echo"<option>$line[0]</option>";
}
?>
</select>
<br/>
Укажите свой пол
<select name="pol"><br/>
<?php
echo"<option>$_pol</option>";
?>
<option>М</option>
<option>Ж</option>
</select>
<br/>

Укажите ваш город, район или поселок(не обязательно)
<br/>
<input type="text" value="" name="gorod">
<br/>

Укажите дату рождения<br/>

Число:<select required name="chislo">
<option></option>
<?php
$chislo=1;
do {
if($chislo<10){$chislo="0".$chislo;}	
?>
<option><?php echo"$chislo"; ?></option>
<?php
$chislo++;
}while($chislo<=31);	
?>
</select><br/>


Месяц:<select required name="mesyatc">
<option></option>
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
Год:<select required name="god">
<option></option>
<?php
for($god=$god_70;$god<=$god_18;$god++)
{
?>
<option><?php echo"$god"; ?></option>
<?php
}
?>
</select><br/>



О себе:
<select name="osebe">
<option></option>
<option>в активном поиске</option>
<option>в официальном браке</option>
<option>в гражданском браке</option>

</select>

<br/>

<input type="hidden" name="login" value="<?php echo"$login"; ?>">

<input  type="submit"  value="Зарегистрироваться" name="reg" ><br/>

 </form>
