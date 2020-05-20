<?php
//в этом файле прописываются переменные и постоянные значения, а также функции php
include "config.php";//присоединить файл для подключения к серверу
include "pdo.php";//присоединить файл для создания объекта PDO


//описание переменных, после их надо будет подключить к БД
$title="Title";
$keywords="ВИЧ знакомства";
$description="Описание";
$alt="alt для image Icon";
$regcatalog="registration";//имя папки с файлами для обработки регистрации и входа



							//ПЕРЕМЕННЫЕ
$from="From:admin@vmesteprosto.info";//от кого отправляется почта

							//ПОСТОЯННЫЕ
define('EMBLEMA','/mainfoto/VP.png');//адрес эмблемы сайта
$imyasayta=$_SERVER['SERVER_NAME'];
define('IMYASAYTA','&laquo;'.$imyasayta.'&raquo;');//адрес сайта
define('HEADLINE','&laquo;Вместе просто онлайн&raquo;');//название сайта


//////////////////////////////////////////////////////////

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
else if($seyden==$d){$vozrast=$vozrast;echo"Поздравляем с Днем Рождения!";}
if($seyden>$d){$vozrast=$vozrast;}
}
return $vozrast;
}

//функция для разрешения входа
function forenter(){
if(!isset($_SESSION['login'])||(!isset($_SESSION['ip'])))
{exit("Пройдите пожалуйста для входа на сайт по ссылке <a href='/index.php'>по ссылке</a>");}
}

//функция получения данных по логину/modredpol/index.php
function dataFromLogin($login,$pdo){
$lich=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,vozrast,metkap,ipp,limitfoto,osebe,pol FROM lichnoe WHERE loginp=? LIMIT 1");
$lich->execute(array($login));
return $lich;//объект с личными данными
}

//проверяется на блокировку администратором
function blocked($login,$pdo)
{
$select = $pdo->query("SELECT COUNT(login) FROM adminblockedlog WHERE login='$login'"); //выполнение запроса вывод количества строк pdo
$skoka=$select->fetchColumn();                                                     //количество строк блокированно   $skoka
if($skoka>0)
{
return exit("Ваша страница временно закрыта в связи с многочисленными жалобами.После быстрой проверки Вам будет открыт доступ к вашей странице<a href='/index.php'>Далее</a> Просим обратиться на адрес  admin@vmesteprosto.info");
}
}

//подтвержден ли логин если "0" то не подтвержден, если "1" то подтвержден
function confirmedLogin($login,$pdo){
$query=$pdo->prepare("SELECT COUNT(proveren) FROM polzovateli WHERE loginp=? AND proveren='0' LIMIT 2");
$query->execute(array($login));
$skolka=$query->fetchColumn();
if($skolka>0){echo"Отправьте сообщение 'reg' со своей электронной почты на admin@vmesteprosto.info для возможности обратной связи с Вами";}
}


// в случае ошибки SQL выражения выведет сообщение об ошибке
//$error_array = $pdo->errorInfo();

//Функция при открытии проверяет наличие логина и совпадение парол и логина
function provlogparip($login,$ip,$pdo)
{
$kolv=$pdo->query("SELECT COUNT(loginp) FROM lichnoe WHERE loginp='$login' AND ipp='$ip'");
$kolv_num=$kolv->fetchColumn();
if($kolv_num=='0'){return exit("Попробуйте&nbsp;<a href='/index.php'>войти снова</a>");}
}


//главное фото функция
function glavfoto($login,$pdo)
{
$folder11 = '/modredpol/fotosait/';//папка для выгрузки файлов
$netfoto="/modredpol/fotosait/fotonet.png";
$fotki=$pdo->prepare("SELECT COUNT(foto) FROM fototabl WHERE loginp=? AND metka='glav'");//выбор главного фото по логину и метке фото
$fotki->execute(array($login));
$fotki_num=$fotki->fetchColumn();
if($fotki_num>0){
$fotka=$pdo->prepare("SELECT foto FROM fototabl WHERE loginp=? AND metka='glav'");//выбор главного фото по логину и метке фото
$fotka->execute(array($login));
while($line=$fotka->fetch(PDO::FETCH_LAZY))          //выводит строки пока они не кончатся в бд
{
$foto=$line->foto;
$foto=$folder11.$foto;
}
if($foto){
return $foto;
 }}//если существует файл
else {return $netfoto; }
}
//НАДО ДОРАБОТАТЬ!!!
//функция проверки и внесения посетителя online или нет
//online	по умолчанию 0, т.е. не онлайн. Если онлайн, то 1
function online($login,$pdo)
{
$id_session = session_id();
                          //Будем считать, что пользователи, которые отсутствовали  в течении 10 минут - покинули ресурс - удаляем их
$online=$pdo->query("SELECT COUNT(login) FROM online WHERE login='$login'");
$online_count=$online->fetchColumn();
  if($online_count>0)
 {
 $query=$pdo->query("SELECT COUNT(login) FROM online WHERE login='$login' AND idsession = '$id_session'");
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
$query=$pdo->exec("DELETE FROM online  WHERE vremya < NOW() -  INTERVAL '10' MINUTE");

}

//Функция проверки посетителя на онлайн
function isonline($login_q,$pdo){
$isonline =$pdo->query("SELECT COUNT(login) FROM online WHERE login='$login_q'");
$isonline_num=$isonline->fetchColumn();
  if($isonline_num>0) return 'online';
}

//Функция поиска по логину номера из табл регистр с дополнит шифрованием
function izloginanomer($login,$pdo){
$query=$pdo->prepare("SELECT nomp FROM polzovateli WHERE loginp=? LIMIT 1");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))
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
return $moy_q;
}







//Функция если есть в таблице значит закрыт профиль от всех кроме друзей
function metkidlyadruzey($login,$login_q,$pdo)
{
							//есть ли логин в metki если есть открыт только для друзей и закрыт для всех
	$metki=$pdo->prepare("SELECT COUNT(loginp) FROM metki WHERE loginp=?");
	$metki->execute(array($login_q));
	$metki_num=$metki->fetchColumn();
 	if($metki_num>0)
	{
$metkidlyadruzey=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE (moy=? AND drug=? AND net='1' AND da='1') OR (moy=? AND drug=? AND net='1' AND da='1')");
$metkidlyadruzey->execute(array($login,$login_q,$login_q,$login));
$metkidlyadruzey_num=$metkidlyadruzey->fetchColumn();

							//если нет в друзьях
if($metkidlyadruzey_num=='0')
{
$n=izloginanomer($login_q,$pdo);
exit("он закрыл свою страницу для всех кроме друзей <a href='vdruzya.php?vdruzya=$n'>Пригласить в друзья</a>");
}

	}
							//если нет в metki смотрим в черном списке ли я
else{
$metki_blocked_drugom=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE moy=? AND drug=? AND net='1' AND da='0'");
$metki_blocked_drugom->execute(array($login,$login_q));
			$metki_blocked_drugom_num=$metki_blocked_drugom->fetchColumn();
				if($metki_blocked_drugom_num>0)
				{
				return  "я его заблокировал";
				}
$metki_blocked_drugom=$pdo->prepare("SELECT COUNT(nom) FROM druzyainet WHERE moy=? AND drug=? AND net='1' AND da='0'");
$metki_blocked_drugom->execute(array($login_q,$login));
			$metki_blocked_drugom_num=$metki_blocked_drugom->fetchColumn();
				if($metki_blocked_drugom_num>0)
				{
				return  exit("я у него в черном списке");
				}
}
}

//Функция ввода пользователя в список гостей
function vgosti($login,$login_q,$pdo)
{
$query=$pdo->prepare("INSERT INTO forgostey (nomer,login,login_q,data)VALUES(NULL,?,?,NOW())");
$query->execute(array($login,$login_q));
}


//Функция попытка_ввести_данные_$kol_раза
function threetimes($login,$parol,$pdo)
{
							//проверяет логин на существование
$query=$pdo->prepare("SELECT COUNT(loginr) FROM threetimesblock WHERE loginr=? LIMIT 1");
$query->execute(array($login));
$loginCount=$query->fetchColumn();
							//если такой логин есть
if(($loginCount>0))
{
							//берем количество попыток
$query=$pdo->prepare("SELECT times FROM threetimesblock WHERE loginr=? LIMIT 1");
$query->execute(array($login));
$falseCount=$query->fetch(PDO::FETCH_LAZY);
$Count=$falseCount[0]+1;
							//увеличиваем его на 1 и обновляем БД
$query=$pdo->prepare("UPDATE threetimesblock SET timer=NOW(),times=? WHERE loginr=?");
$query->execute(array($Count,$login));

if($Count>2)
{
exit("Вы превысили число попыток ввода- следующая попытка возможна через 5 минут <a href='/index.php'>дальше</a>");
}
}
							//если такого логина нет
else{
$ip=$_SERVER['REMOTE_ADDR'];
$query=$pdo->prepare("INSERT INTO threetimesblock (nomer,loginr,ip,timer,parol,times)VALUES(NULL,?,?,NOW(),?,'0')");
$query->execute(array($login,$ip,$parol));
}


//SELECT times FROM threetimesblock WHERE loginr=? AND (timer BETWEEN (NOW()-INTERVAL '5' M
}
?>
<!--подключение стилей с сайта Bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
