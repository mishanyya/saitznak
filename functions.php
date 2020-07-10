<?php
//в этом файле прописываются переменные и постоянные значения, а также функции php
include "config.php";//присоединить файл для подключения к серверу
include "pdo.php";//присоединить файл для создания объекта PDO
include "variable.php";//присоединить файл с переменными значениями сайта и запуском сессии


//////////////////////////////////////////////////////////
//функция внесения посетителя online вносит последнее время

function online($login,$pdo)
{
  $query=$pdo->prepare("UPDATE online SET vremya=NOW() WHERE loginp=?");
  $query->execute(array($login));
}

//Функция проверки посетителя на онлайн если был больше 5 минут назад, то не онлайн
function isonline($login,$pdo){
//$login_q
$query=$pdo->prepare("SELECT TIMESTAMPDIFF(MINUTE, vremya, NOW()) FROM online WHERE loginp=?");
$query->execute(array($login));
$vremyaarray=$query->fetch(PDO::FETCH_LAZY);
$vremya=$vremyaarray[0];//прошло количество минут с последнего входа
if($vremya<5){
  echo "on-line";
}
}

/*пока отменяем верификацию, она будет по желанию!

							//адрес кому отправляется письмо
$address=base64_decode($login);
$sub="vmesteprosto.info Регистрация";

$mes="Пройдите пожалуйста по ссылке для регистрации http://vmesteprosto.info/modvhodreg/redaktpar1.php?a=$login&b=$vremen  \r\n";
//$from - смотреть в config.php
							//отправка сообщения

mail($address,$sub,$mes,$from);
*/
													//обновление временного пароля у логина

//$_SESSION['login']=$login;
//echo "Сообщение  отправлено!<br/>Сообщение  придет в течение некоторого времени, в зависимости от загрузки сети,также оно может находиться в папке 'Спам'<br/>Если не пришло отправьте его <a href='registr.php'>еще раз</a> или  <a href='mailto:admin@vmesteprosto.info'>нажмите на ссылку для отправки нам сообщения и Вас зарегистрируют в ближайщее время</a>";
/////////////


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
if(!isset($_SESSION['login'])||(!isset($_SESSION['ip']))||(!empty($id_session)) )
{
  exit("Пройдите пожалуйста для входа на сайт по этой <a href='/index.php'>Ссылке</a>");}
}

//функция получения данных по логину
function datafromfogin($login,$pdo){
$lich=$pdo->prepare("SELECT loginp,imya,region,gorod,datarozd,TIMESTAMPDIFF(YEAR, datarozd, NOW()),ipp,semeinpolozh,pol FROM lichnoe WHERE loginp=? LIMIT 1");
$lich->execute(array($login));
return $lich;
}

//проверяется на блокировку администратором
function blocked($login,$pdo)
{
$query = $pdo->prepare("SELECT blocked FROM adminblockedlog WHERE login=? LIMIT 1"); //выполнение запроса вывод количества строк pdo
$query->execute(array($login));
$blocked=$query->fetch(PDO::FETCH_LAZY);
$qwerty=$blocked[0];
if($qwerty==1)
{
return exit("Ваша страница временно закрыта в связи с многочисленными жалобами. После быстрой проверки вопрос будет решен в ближайшее время!");
}
}




//подтвержден ли логин если "0" то не подтвержден, если "1" то подтвержден
function confirmedLogin($login,$pdo){
$query=$pdo->prepare("SELECT COUNT(proveren) FROM polzovateli WHERE loginp=? AND proveren='0' LIMIT 2");
$query->execute(array($login));
$skolka=$query->fetchColumn();
if($skolka>0){echo"Отправьте сообщение 'reg' со своей электронной почты на admin@vmesteprosto.info для возможности обратной связи с Вами";}
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







//Функция проверки введенных логина и пароля при входе на сайт
//Каждая попытка входа должна запоминать IP и время!
function threetimesenter($login,$parol,$pdo)
{
							//логин уже проверен на существование в самом коде для входа
							//берем из БД кол-во запросов и разницу во времени для пользователя
$query=$pdo->prepare("SELECT times,TIMESTAMPDIFF(MINUTE, timer, NOW()) FROM threetimesblock WHERE loginp=?");


$query->execute(array(/*$times,*/$login));
$timesarray=$query->fetch(PDO::FETCH_LAZY);
$times=$timesarray[0];//количество попыток из БД
$period=$timesarray[1];//период с последнего ввода

//echo 'times:'.$times.'<br/>';
//echo 'count:'.$period.'<br/>';
if($times>2){
  //считаем разницу в минутах
if($period<=15){
  //если прошло 15 минут и меньше
exit("Вы превысили число попыток ввода- следующая попытка возможна через 15 минут <a href='/index.php'>Дальше</a>");
  //блокируется ввод пароля, даже если он правильный
}}
else{
  //увеличивается счетчик на 1
  $times++;
  $query=$pdo->prepare("UPDATE threetimesblock SET timer=NOW(),times=? WHERE loginp=?");
  $query->execute(array($times,$login));
  //проверяется пароль
}

//извлекаем пароль из БД
$query=$pdo->prepare("SELECT parp FROM polzovateli WHERE loginp=? LIMIT 1");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))
{
$parolfrom=$line[0];
}

//сравниваем пароли
if (hash_equals($parolfrom, crypt($parol, $parolfrom))) {
//если логин и пароль совпали
//если вход удачен, то обнуляем счетчик попыток
$query=$pdo->prepare("UPDATE threetimesblock SET timer=NOW(),times=0 WHERE loginp=?");
$query->execute(array($login));

//ip пользователя
$ip = $_SERVER['REMOTE_ADDR'];
//обновляется ip в БД
$query=$pdo->prepare("UPDATE lichnoe SET ipp=? WHERE loginp=?");
$query->execute(array($ip,$login));
//создается сессия IP
$_SESSION['ip']=$ip;
//создается сессия логина
$_SESSION['login']=$login;

//вносим IP каждого входа и дату в таблицу

$query=$pdo->prepare("INSERT INTO forIP (login,ip) VALUES (?,?)");
$query->execute(array($login,$ip));

//переход на страницу пользователя
header("location:/mainpage.php");
}
else{
  exit("Пароль НЕ верен! <a href='/index.php'>Повторите попытку!</a>");
}
}//конец функции

//вставка всех регионов РФ в таблицу goroda
//взять список из файла "регионы РФ.txt" и вставить кавычки перед и после каждой запятой
function insertregionnames($pdo){

/*
//$pdo->exec() возвращает количество строк, которые были модифицированы или удалены в ходе его выполнения
$query=$pdo->exec("INSERT INTO goroda (region) VALUES (44)");//работает
echo $query;//работает
*/

/*
//$pdo->query просто выполняет запрос
$query=$pdo->query("INSERT INTO goroda (region) VALUES (445)");//работает
*/

/*
//$pdo->prepare создает подготовленный запрос
//$query->execute выполняет этот запрос, возможно несколько раз
$query=$pdo->prepare("INSERT INTO goroda (region) VALUES (?)");//работает
$query->execute(array('qqq'));
*/

//из содержимого текстового файла regions.txt из значений разделенных знаком ',' (запятая) создается массив $array
$f = fopen("regions.txt", "r");
//$array = explode(",",fgets($f));//из строк делает массив

fclose($f);
/*//вывод через каждый элемент массива, работает!
$array=array('2','22','222','3');
//создается подготовленный запрос
$query=$pdo->prepare("INSERT INTO goroda (region) VALUES (?)");//работает
//для каждого элемента массива выполняется этот запрос
try {
    $pdo->beginTransaction();
    foreach ($array as $key)
    {
        $query->execute(array($key));
    }
    $pdo->commit();
}catch (Exception $e){
    $pdo->rollback();
    throw $e;
}
*/

/*//вывод через каждый элемент массива, работает!
$array=array(4,44,444);
//создается подготовленный запрос
$query=$pdo->prepare("INSERT INTO goroda (region) VALUES (?)");//работает
//для каждого элемента массива выполняется этот запрос
    foreach ($array as $key)
    {
        $query->execute(array($key));
    }
*/



//$query->execute(array($array));//работает? пока нет. эту функцию нужно сделать!!!
//echo "ok!!!";


}

?>
<!--подключение стилей с сайта Bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
