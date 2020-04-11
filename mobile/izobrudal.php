<html>	
<head>
<title>Загрузка фото</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
 
<form action="izobrudal1.php" method="POST"  > 
<?php

session_start();//инициируем сессию   


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с сервером
mysql_select_db($db_name) or die("Приносим извинения за временные неудобства-на сайте проводятся технические работы,некоторые функции могут быть недоступны");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="fototabl";
  $folder1 = '/fotosait/';//папка для выгрузки файлов
   

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _ 



$ip=$_SESSION['ip'];

$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _ 


$strochekparolya=forenter($login,$ip);



if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}



$array=imyaizlogina($login);


echo"&nbsp;<i>$array[0]</i>  <br>";                                        //модуль с полями для ввода пароля и логина





$query="SELECT * FROM $userstable WHERE loginp='$login'";
$result = mysql_query($query) or die("Query не получилось");

while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
echo "<br>";
$v=$line[1]; 

?>
&nbsp;<input type="radio" name=dfile[]  <?php if($line[2]=='glav'){echo "checked";}?> value="<?php echo $v ?>" >

<?php 

//echo "$line[1]<br/>";

$opisanie=$line[3];

//echo "Описание фото: $opisanie<br/>";
//echo "ponravilos: $line[4]<br/>";
$fotki=$folder1.$line[1];
?>
<img class="imgmoi" src="<?php echo $fotki; ?>" >
<?php

}

?>


<br>

&nbsp;<a href="zagrf.php">Загрузить фото</a><br>
&nbsp;<input type="button"  value="Добавить описание к фото" onclick="opisanie()"  ><br>

&nbsp;<input type="submit"  value="Удалить" name="udal"  ><br>

&nbsp;<input type="submit"  value="Отключить показ главной фотографии"  name="pokaz" ><br>

&nbsp;<input type="submit"  value="Сделать главной"  name="glav" ><br>
&nbsp;<a href='index.php' class='naglavnuyu'>На мою страницу</a><br>

&nbsp;<div id="opisan"></div>

</form>




</body>


</html>