

<?php
session_start();//инициируем сессию   


include "time.php";//присоединить файл с реальными датой и временем       //общий модуль                   
include "config.php";//присоединить файл для подключения к серверу

$link = mysql_connect($sdb_name,$user_name,$user_password)
or die("Could not connect");//соединение с сервером
mysql_select_db($db_name) or die("не могу выбрать мою бд");//соединение с бд
mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";

                                             //модуль с полями для ввода пароля и логина

$login=$_SESSION['login'];
$login=htmlspecialchars($login);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _

$strochekparolya=forenter($login,$ip);


if($strochekparolya!=1){exit();} 
$login_q=$_SESSION['login_q'];   //номер пользователя входит в переменную  
$login_q=htmlspecialchars($login_q);//переводит некоторые спецсимволы, которые могут использоваться для кода 
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _

if(empty($login_q)){
header("location:index.php");
}

//если адресата нет то он добавляется
$query="SELECT otkogo FROM $userstable2 WHERE otkogo='$login' AND komu='$login_q'";
$result = mysql_query($query) or die("Query не получилось");
$num=mysql_num_rows($result);

if($num=='0'){
$query="INSERT INTO $userstable2 (nom,otkogo,komu) VALUES (NULL,'$login','$login_q')";
$result = mysql_query($query) or die("Query не получилось");
}



echo"Ваш login $login <br>";

echo"Вы общаетесь с $login_q <br>";
?>
<div class="column">

<div class="column1">



</div>





<div class="column2">


<script src="ajax_soobsh.js"></script>
<div id="ajax_soobsh">


<?php

//если есть записи в таблице по запросу
$query="SELECT * FROM $userstable1 WHERE  (otkogo='$login' AND komu='$login_q') OR (otkogo='$login_q' AND komu='$login')";
$result = mysql_query($query) or die("Query не получилось");
$kolvo=mysql_num_rows($result);

if($kolvo>0){
$xml = new DOMDocument();
$root = $xml->appendChild($xml->createElement('collection'));

$query="SELECT * FROM $userstable1 WHERE  (otkogo='$login' AND komu='$login_q') OR (otkogo='$login_q' AND komu='$login')  ORDER BY nomer DESC limit 0,10";
$result = mysql_query($query) or die("Query не получилось");
$tabl = $root->appendChild($xml->createElement('tabl'));

while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
$tre = $tabl->appendChild($xml->createElement('tre'));
$tre->appendChild($xml->createElement('nomer', $line[0]));
$tre->appendChild($xml->createElement('otkogo', $line[1]));
$tre->appendChild($xml->createElement('komu', $line[2]));
$tre->appendChild($xml->createElement('soobshenie', $line[3]));
$tre->appendChild($xml->createElement('data', $line[4]));
$tre->appendChild($xml->createElement('otmetka', $line[5]));
}

$xsl = new DOMDocument();
$xsl->load("ajax_soobsh.xsl");
$processor = new XSLTProcessor();
$processor->importStylesheet($xsl);	
$html = $processor->transformToXml($xml);

echo $html;
}


?>
</div>

<form action="soobsheniyap1.php" id="forma" method="POST">

 <textarea cols="50" rows="10" id="soobsh" name="soobsh" required  autofocus></textarea> 
<input type="submit" name="soob" value="отправить сообщение" /><br/>
<input type="reset" value="Сброс">


</form>



<a href="index.php">На мою страницу</a><br/>



</div>

<div class="column3">column3

<script>setInterval('ajax_soobsh()',10000);</script>
</div>

</div>

