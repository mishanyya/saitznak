<?php

//соединение через PDO
$dsn = "mysql:host=$sdb_name;dbname=$db_name;charset=utf8";
$opt = array(
   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //разобраться с этими обозначениями
/*  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ,*/
PDO::ATTR_PERSISTENT => true//постоянное подключение pdo
);

try {//подключение и создание объекта pdo
$pdo = new PDO($dsn, $user_name, $user_password, $opt);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}




$today = date("Y-m-d H:i:s");//время в формате mysql 
$segodnya = date("Y-m-d");//сегодняшний день
$segodnya_18_ = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-18);//-18 лет
$segodnya_18=date("Y-m-d",$segodnya_18_); 
$segodnya_70_ = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-70);//-70 лет
$segodnya_70=date("Y-m-d",$segodnya_70_);
$U=date("YmdHis");//время в формате mysql для записи имени фотографий
$god_70_ = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-70);//-70 лет
$god_70=date("Y",$god_70_);
$god_18_ = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-18);//-18 лет
$god_18=date("Y",$god_18_);
//cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31 количество дней в месяце такого то года

//функция вычисления возраста
function raznitcavozrasta($g,$m,$d) {
$seygod=date("Y");
$seymes=date("m");
$seyden=date("d");
$vozrast=$seygod-$g;
if($seymes<=$m){
if($seyden<$d){
$vozrast=$vozrast-1;}
else if($seyden==$d){$vozrast=$vozrast;echo"Сегодня ваш день !";}
if($seyden>$d){$vozrast=$vozrast;}
}
return $vozrast;  
}


//проверяется на блокировку администратором
function blocked($login,$pdo)
{
$select = $pdo->query("SELECT COUNT(login) FROM adminblockedlog WHERE login='$login'"); //выполнение запроса вывод количества строк pdo
$skoka=$select->fetchColumn();                                                     //количество строк блокированно   $skoka                 
if($skoka>0)
{
return exit("Ваша страница временно закрыта в связи с многочисленными жалобами.После быстрой проверки Вам будет открыт доступ к вашей странице<a href='index.php'>Далее</a>");
}
}


// в случае ошибки SQL выражения выведет сообщение об ошибке
//$error_array = $pdo->errorInfo();


//Функция при открытии проверяет наличие логина и совпадение парол и логина
function provlogparip($login,$ip,$pdo)
{
$kolv=$pdo->query("SELECT COUNT(loginp) FROM lichnoe WHERE loginp='$login' AND ipp='$ip'");
$kolv_num=$kolv->fetchColumn();
if($kolv_num=='0'){return exit("Попробуйте&nbsp;<a href='index.php'>войти снова</a>");}
}


//главное фото функция
function glavfoto($login,$pdo)
{
$folder1 = '/fotosait/';//папка для выгрузки файлов
$netfoto="/fotosait/fotonet.png";
$fotki=$pdo->prepare("SELECT COUNT(foto) FROM fototabl WHERE loginp=? AND metka='glav'");//выбор главного фото по логину и метке фото 
$fotki->execute(array($login));
$fotki_num=$fotki->fetchColumn();
if($fotki_num>0){
$fotka=$pdo->prepare("SELECT foto FROM fototabl WHERE loginp=? AND metka='glav'");//выбор главного фото по логину и метке фото 
$fotka->execute(array($login));
while($line=$fotka->fetch(PDO::FETCH_LAZY))          //выводит строки пока они не кончатся в бд
{
$foto=$line->foto;
$foto=$folder1.$foto;
}
if($foto){
return(array("<img class='glavfoto' src='$foto'>"));/*показывает главное фото*/
 }}//если существует файл
else {return (array("<img class='glavfoto' src='$netfoto'>")); }
}


//функция проверки и внесения посетителя online или нет
function online($login,$pdo)
{
$id_session = session_id();
                          //Будем считать, что пользователи, которые отсутствовали  в течении 20 минут - покинули ресурс - удаляем их   
$online=$pdo->query("SELECT COUNT(login) FROM online WHERE login='$login'");
$online_count=$online->fetchColumn();  
  if($online_count>0)
 {
 
$query=$pdo->query("SELECT COUNT(*) FROM online WHERE login='$login' AND idsession = '$id_session'");
$query_count=$query->fetchColumn();   
  if($query_count>0) //значит посетитель online
{ 
$query=$pdo->exec("UPDATE online SET vremya = NOW(),idsession = '$id_session' WHERE login='$login'");
}
 }
  // Иначе - посетитель только что вошёл - помещаем в таблицу нового посетителя  
 else {
$query=$pdo->exec("INSERT INTO online (login,idsession,vremya) VALUES('$login','$id_session',NOW())");
}  
$query=$pdo->exec("DELETE FROM online  WHERE vremya < NOW() -  INTERVAL '20' MINUTE");
  mysql_query($query);
}


//Функция проверки посетителя на онлайн
function isonline($login_q,$pdo){
$isonline =$pdo->query("SELECT COUNT(login) FROM online WHERE login='$login_q'");
$isonline_num=$isonline->fetchColumn();
  if($isonline_num>0) return online;
}





//Функция поиска по логину номера из табл регистр с дополнит шифрованием
function izloginanomer($login,$pdo){ 
$nomp=$pdo->query("SELECT nomp FROM polzovateli WHERE loginp='$login' LIMIT 1");
while($line=$nomp->fetch(PDO::FETCH_LAZY))
{
$nom=$line->nomp;
}
$nomer=base64_encode($nom.'a');//добавить лишний символ
return $nomer;
}


//Функция где номер дешифровывается

function iznomera($moy_q,$pdo){
$nomer=base64_decode($moy_q);
$nomer=substr($nomer,0,-1);             //убрать лишний символ

$nomer=$pdo->query("SELECT loginp FROM polzovateli WHERE nomp='$nomer' LIMIT 1");
while($line=$nomer->fetch(PDO::FETCH_LAZY))
{
$moy_q=$line->loginp;
}
$moy_q=htmlspecialchars($moy_q);
$moy_q=mysql_real_escape_string($moy_q);//экранирует символы кроме % и _
return $moy_q;
}

 

//Функция если есть в таблице значит закрыт профиль от всех кроме друзей
function metkidlyadruzey($login,$login_q,$pdo)
{  
$metkidlyadruzey=$pdo->query("SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q'AND net='0' AND da='1') OR (moy='$login_q' AND drug='$login'AND net='0' AND da='1')");
$metkidlyadruzey_num=$metkidlyadruzey->fetchColumn();
if($metkidlyadruzey_num>0) 
{
return  druzYa;//если есть в друзьях разрешено
}
else//если нет в друзьях
{
$metkidlyadruzey=$pdo->query("SELECT loginp FROM metki WHERE loginp='$login_q'");
$metkidlyadruzey_num=$metkidlyadruzey->fetchColumn();
 if($metkidlyadruzey_num>0)
{
return his_blocked;//если он заблокировался от всех и его нет в друзьях
}
else //если он не блокировался ни от кого и его нет в друзьях
{ 

//получение моей метки пользователя
$metkidlyadruzey=$pdo->query("SELECT metkap FROM lichnoe WHERE loginp='$login'");
while($line=$metkidlyadruzey->fetch(PDO::FETCH_LAZY))
{
$login_metka=$line->metkap;
}

//получение метки другого пользователя
$metkidlyadruzey=$pdo->query("SELECT metkap FROM lichnoe WHERE loginp='$login_q'");
while($line=$metkidlyadruzey->fetch(PDO::FETCH_LAZY))
{
$login_q_metka=$line->metkap;
}

 
if (($login_metka==$login_q_metka)||($login_q_metka=='0'))//если соблюдается то вход
{//если разрешен вход для данной группы
$metki_blocked_drugom=$pdo->query("SELECT COUNT(*) FROM druzyainet WHERE (moy='$login' AND drug='$login_q' AND net='1' AND da='0') OR (moy='$login_q' AND drug='$login'AND net='1' AND da='0')");
$metki_blocked_drugom_num=$metki_blocked_drugom->fetchColumn();
if($metki_blocked_drugom_num>0) 
{
return  blocked_frend;//если заблокирован в друзьях
}
else{
return ne_zablokirovan_;//если не  заблокирован в друзьях разрешено
}

}
else 
{
return zapret_dlya_gruppy;//если запрешен вход для группы
}
}
}                                           
}
//****************************






//Функция ввода пользователя в список гостей
function vgosti($login,$login_q,$pdo)
{

$query=exec("INSERT INTO forgostey (nomer,login,login_q,data)VALUES(NULL,'$login','$login_q',NOW())");

}



?>