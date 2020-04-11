<html>	
<head>
<title>	Знакомства</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<script src="ajax_soobsh.js"></script>
<script src="dogruzka.js"></script>
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
сообщения
<?php


session_start();//инициируем сессию
include "config.php";//присоединить файл для подключения к серверу //обязательный модуль подключения
include "time.php";//присоединить файл с реальными датой и временем                        

$userstable="lichnoe";
$userstable1="soobsheniya";
$userstable2="adresatsms";

mysql_query("SET CHARACTER SET 'utf8';"); //для кодировки
mysql_query("SET SESSION collation_connection = 'utf8_general_ci';"); //для кодировки                                            //модуль с полями для ввода пароля и логина

$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _
echo"* мой login $login *";

$ip=$_SESSION['ip'];
 $ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _
  
echo"*мое ip $ip *";

online($login,$pdo);//внесение в онлайн


provlogparip($login,$ip,$pdo);//проверка при входе


                                    //модуль получения значения логина для переписи с ним
if(isset($_GET['id']))
{//если получено id через url -> введение значения в login_q при проходе по ссылке
echo"+зашел по ссылке на непрочитанное сообщение *его логин был пустой+<br/>";
$id=$_GET['id'];
$id=htmlspecialchars($id);
$id=mysql_real_escape_string($id);//экранирует символы кроме % и _
$login_q=iznomera($id,$pdo);
$_SESSION['login_q']=$login_q;
}

else
{//если проход без ссылки
echo"+зашел по ссылке просто для отправки сообщений+<br/>";

 if(isset($_SESSION['login_q']))
{//если login_q есть в сессии
echo"сессия его логина существует*его логин был не пустой<br/>";
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
}
else if(!empty($_SESSION['login_q']))
{
echo"сессия его логина не пустая*его логин был не пустой -> дубляж предыдущего if<br/>";
$login_q=$_SESSION['login_q']; 
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
}

else if(!empty($_POST['adresat']))
{
echo"в логин пришел адресат*его логин был изменен<br/>";
$login_q=$_POST['adresat'];
$login_q=htmlspecialchars($login_q);
$login_q=mysql_real_escape_string($login_q);//экранирует символы кроме % и _
$_SESSION['login_q']=$login_q;

}
else {
echo"в логин пришел NULL*сессия его логина не существует, сессия его логина и адресат были  пустыми<br/>";
$login_q=NULL;
}


}//конец цикла



                          //модуль добавления адресата с кем имелась переписка,если адресата нет то он добавляется

$query=$pdo->query("SELECT COUNT(otkogo) FROM adresatsms WHERE otkogo='$login' AND komu='$login_q' UNION SELECT COUNT(komu) FROM adresatsms WHERE komu='$login' AND otkogo='$login_q'");

$query_num=$query->fetchColumn();
echo"? $query_num  ?";
if($query_num=='0'){
$query=$pdo->exec("INSERT INTO adresatsms (nom,otkogo,komu) VALUES (NULL,'$login','$login_q')");
}



                         //модуль вывода логина пользователя и его собеседника

//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}

echo"мое имя<i>$imya</i>  <br>";//имя
echo"мое Регион<i>$region</i>  <br>";//Регион 
echo"мое Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"мое Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"мое имя<i>$vozrast</i>  <br>";//имя
echo"мое метка группы<i>$metka</i>  <br>";//метка группы 
echo"мое ип<i>$ipp</i>  <br>";//ип 
echo"фото<i>$limitfoto</i>  <br>";//фото 
echo"мое о себе<i>$osebe</i>  <br>";//о себе 
$foto=glavfoto($login,$pdo);//показ главного фото
echo $foto[0];



echo"<br/>->$login_q login_q<-";
if($login_q!=''){
//Функция выдает личные данные по логину
                                                       
$lich=$pdo->prepare("SELECT * FROM lichnoe WHERE loginp=?"); 
$lich->execute(array($login_q));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$ego_imya=$line->imya;
$ego_region=$line->region;
$ego_gorod=$line->gorod;
$ego_datarozd=$line->datarozd;
$ego_vozrast=$line->vozrast;
$ego_metka=$line->metkap;
$ego_ipp=$line->ipp;
$ego_limitfoto=$line->limitfoto;
$ego_osebe=$line->osebe;
}

echo"<br/>собеседник- его имя<i>$ego_imya</i>  <br>";//имя
echo"его Регион<i>$ego_region</i>  <br>";//Регион 
echo"его Населенный пункт<i>$ego_gorod</i>  <br>";//Населенный пункт 
echo"его Возраст<i>$ego_datarozd</i>  <br>";//Возраст 
echo"имя<i>$ego_vozrast</i>  <br>";//имя
echo"его метка группы<i>$ego_metka</i>  <br>";//метка группы 
echo"его ип<i>$ego_ipp</i>  <br>";//ип 
echo"его фото<i>$ego_limitfoto</i>  <br>";//фото 
echo"его о себе<i>$ego_osebe</i>  <br>";//о себе 



if($ego_imya!=''){
$glavfoto=glavfoto($login_q,$pdo);//показ главного фото
$isonline=isonline($login_q,$pdo);//показ если online
echo"&nbsp;Ваш собеседник:<b> $ego_imya </b>&nbsp;$isonline егго фо-- $glavfoto[0] --то <br/>";}}

echo"<br/>";


//список адресатов
echo"адресаты:<br/>";

                                //модуль вывода списка адресатов
$adresat=$pdo->query("SELECT komu FROM adresatsms WHERE otkogo='$login' AND komu!='$login' UNION SELECT otkogo FROM adresatsms WHERE komu='$login' AND otkogo!='$login'");

while($line=$adresat->fetch(PDO::FETCH_LAZY))
{//3 начало
if($line[0]!='')//если есть адресат
{//2 начало



//echo"&nbsp;<img src='$fotoadres' class='imgmoi'/>"; 

$lich->execute(array($line[0]));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{//1 начало
$adresat_imya=$line->imya;
$adresat_region=$line->region;
$adresat_gorod=$line->gorod;
$adresat_datarozd=$line->datarozd;
$adresat_vozrast=$line->vozrast;
$adresat_metka=$line->metkap;
$adresat_ipp=$line->ipp;
$adresat_limitfoto=$line->limitfoto;
$adresat_osebe=$line->osebe;

echo"adresat_имя<i>$adresat_imya</i>  <br/>";//имя
echo"Регион<i>$adresat_region</i>  <br/>";//Регион 
echo"Населенный пункт<i>$adresat_gorod</i>  <br/>";//Населенный пункт 
echo"Возраст<i>$adresat_datarozd</i>  <br/>";//Возраст 
echo"имя<i>$adresat_vozrast</i>  <br/>";//имя
echo"метка группы<i>$adresat_metka</i>  <br>";//метка группы 
echo"ип<i>$adresat_ipp</i>  <br/>";//ип 
echo"фото<i>$adresat_limitfoto</i>  <br/>";//фото 
echo"о себе<i>$adresat_osebe</i>  <br/>";//о себе

$glavfoto=glavfoto($line[0],$pdo);//показ главного фото
echo "фото адре- $glavfoto[0] -са- $line[0] -та<br/>";

$l=izloginanomer($line[0],$pdo);
echo"<a href='index8.php?pn=$l'>";
$isonline=isonline($line[0],$pdo);//показ если online
echo"&nbsp;<b> $adresat_imya </b> ";
echo"&nbsp;$isonline";
echo"</a>";//ссылка для выбора адресата
echo"&nbsp;<a href='index15.php?del=$l'>Удалить переписку</a><br/>"; 
}//1 конец
}//2 конец
}//3 конец



if (!empty($login_q)){

//сейчас общаемся с этим
echo"<br/>сейчас общаемся с этим:<br/>";


$lich->execute(array($login_q));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$seichas_imya=$line->imya;
$seichas_region=$line->region;
$seichas_gorod=$line->gorod;
$seichas_datarozd=$line->datarozd;
$seichas_vozrast=$line->vozrast;
$seichas_metka=$line->metkap;
$seichas_ipp=$line->ipp;
$seichas_limitfoto=$line->limitfoto;
$seichas_osebe=$line->osebe;
}

echo"seichas_имя<i>$seichas_imya</i>  <br>";//имя
echo"Регион<i>$seichas_region</i>  <br>";//Регион 
echo"Населенный пункт<i>$seichas_gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$seichas_datarozd</i>  <br>";//Возраст 
echo"имя<i>$seichas_vozrast</i>  <br>";//имя
echo"метка группы<i>$seichas_metka</i>  <br>";//метка группы 
echo"ип<i>$seichas_ipp</i>  <br>";//ип 
echo"фото<i>$seichas_limitfoto</i>  <br>";//фото 
echo"о себе<i>$seichas_osebe</i>  <br>";//о себе
echo"<a href='index5.php'>На страницу друга <b> $seichas_imya </b> </a>";
}



//из непрочитанных сообщений делает прочитанные

$query=$pdo->exec("UPDATE soobsheniya SET otmetka='1' WHERE  otkogo='$login_q' AND komu='$login'  AND otmetka!='1' ");

//отсюда делать
?>
<br/><a href='index2.php'>На мою страницу</a>

<div id='obshsoobsheniya'>
<?php

if(!empty($login_q)){echo"<input type='button' value='Еще' id='button' onclick='vozvrat()'>";

echo"<div id='echo'></div>";

echo"<div id='ajax_soobsh'>";//модуль вывода сообщений

$soobsh=$pdo->query("SELECT COUNT(*) FROM soobsheniya WHERE (otkogo='$login' AND komu='$login_q') OR (otkogo='$login_q' AND komu='$login')");
$kolvo=$soobsh->fetchColumn();//количество строк в результате запроса




if(!empty($login_q)&($kolvo>0)){
$s=$kolvo-15;//с какой строки выходит
if($s<0){$s=0;}//для нормального вида ajax сообщений

$query=$pdo->query("SELECT * FROM soobsheniya WHERE  otkogo='$login' AND komu='$login_q'  UNION SELECT * FROM soobsheniya WHERE otkogo='$login_q' AND komu='$login' ORDER BY nomer ASC limit $s,15");
 
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{
if($line[1]==$login){
echo"<b class='textno'>$line[0]</b>";
 



$lich->execute(array($line[1]));
while($lines=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$lines->imya;

}

echo"имя<i>$imya</i>  <br/>";//имя
echo"<b class='textsoobout'>$imya</b>";
echo"<b class='textsoobin'></b>";
echo"<b class='textsoob' style='color:red;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='index15.php?np=$line[0]'>Удалить сообщение</a></span></b>";
echo"<b class='textno'>$line[5]</b>";
echo"<br/>";
}
else if($line[1]==$login_q){
echo"<b class='textno'>$line[0]</b>";
$lich->execute(array($line[1]));
while($lines=$lich->fetch(PDO::FETCH_LAZY))
{
$imya1=$lines->imya;
}

echo"имя<i>$imya1</i>  <br>";//имя
echo"<b class='textsoobin'>$imya1</b>";
echo"<b class='textsoob' style='color:blue;'>$line[3]<br/><span class='soobtimedelete'>$line[4]<a href='index15.php?np=$line[0]'>Удалить сообщение</a></span></b>";
echo"<b class='textno'>$line[5]</b>";
echo"<b class='textsoobout'></b>";
echo"<br/>";
}
}
}
else
{
echo"Сообщений еще нет";
}
echo"</div>";
}






?>

</div>

<br/>





&nbsp;<b class='s'><script src="time.js"></script></b><br/>
<a href="pay.php" class='pay'>Помочь в содержании и развитии сайта</a><br/>


<?php

                       //модуль вывода непрочитанных сообщений

$soob=$pdo->query("SELECT DISTINCT otkogo FROM soobsheniya WHERE komu='$login' AND otmetka='0'");//выбор непрочитанных сообщений
while($line1=$soob->fetch(PDO::FETCH_LAZY))
{
$lich->execute(array($line1->otkogo));
while($line=$lich->fetch(PDO::FETCH_LAZY))
{
$imya=$line->imya;
$region=$line->region;
$gorod=$line->gorod;
$datarozd=$line->datarozd;
$vozrast=$line->vozrast;
$metka=$line->metkap;
$ipp=$line->ipp;
$limitfoto=$line->limitfoto;
$osebe=$line->osebe;
}

echo"имя<i>$imya</i>  <br>";//имя
echo"Регион<i>$region</i>  <br>";//Регион 
echo"Населенный пункт<i>$gorod</i>  <br>";//Населенный пункт 
echo"Возраст<i>$datarozd</i>  <br>";//Возраст 
echo"имя<i>$vozrast</i>  <br>";//имя
echo"метка группы<i>$metka</i>  <br>";//метка группы 
echo"ип<i>$ipp</i>  <br>";//ип 
echo"фото<i>$limitfoto</i>  <br>";//фото 
echo"о себе<i>$osebe</i>  <br>";//о себе
echo"<a href='stdruga.php'>На страницу друга <b> $imya </b> </a>";
//}




$nomer=izloginanomer($line1->otkogo,$pdo);//шифруется номер


echo"<a href='index7.php?id=$nomer'>Вам  <b>письмо</b> от $imya </a>";
}

$metka=metkidlyadruzey($login,$login_q,$pdo);
echo"-*- $login * $login_q * $metka *-*";

if(($metka=='his_blocked')&&($login_q!=''))
{echo "<br/>&nbsp;Он заблокировал свою страницу!!!";}

else if(($metka=='blocked_frend')&&($login_q!=''))
{echo "<br/>&nbsp;Его заблокировал другой пользователь!!!";}

else if(($metka=='zapret_dlya_gruppy')&&($login_q!=''))
{echo "<br/>&nbsp;он не подходит по группе - подружитесь!!!";}

else if($login_q=='')
{echo "<br/>&nbsp;Не выбран собеседник!!!";}



else {

?>
<br/>
<input type='hidden' id='skakogo' value='<?php echo $s-10 ?>' >
<input type='hidden' id='kolvo' value='<?php echo $kolvo ?>'>
<input type='hidden' id='dostroki' value='<?php echo $s ?>'>
<input type='hidden' id='skolko' value='10'><br/>
<input type='hidden' id='chislo' value='10'><br/>

<?php

echo " <form action='index8.php' id='forma' method='POST'>           ";

echo " <textarea cols='50' rows='10' id='soobsh' name='soobsh' required autofocus></textarea> ";
echo " <input type='submit' name='soob' value='Отправить сообщение' /><br/>             ";
echo " <input type='reset' value='Сброс'>            ";

echo "</form>            ";

}//конец цикла, если нельзя отправлять ему сообщения
?>

<script>setInterval('ajax_soobsh()',10000);</script>


</body>

</html>