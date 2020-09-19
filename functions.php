<?php
//в этом файле прописываются переменные и постоянные значения, а также функции php
include "config.php";//присоединить файл для подключения к серверу
include "pdo.php";//присоединить файл для создания объекта PDO
include "variable.php";//присоединить файл с переменными значениями сайта и запуском сессии

//////////////////////////////////////////////////////////
/*Функции для входа и безопасности*/

//Функция проверки введенных логина и пароля на странице ввода логина и пароля для входа на сайт
//Каждая попытка входа должна запоминать IP и время!
function threetimesenter($login,$parol,$pdo)
{							//логин уже проверен на существование в самом коде для входа
							//берем из БД кол-во запросов и разницу во времени для пользователя
$query=$pdo->prepare("SELECT times,TIMESTAMPDIFF(MINUTE, timer, NOW()) FROM threetimesblock WHERE loginp=?");
$query->execute(array(/*$times,*/$login));
$timesarray=$query->fetch(PDO::FETCH_LAZY);
$times=$timesarray[0];//количество попыток из БД
$period=$timesarray[1];//период с последнего ввода
//Проверяется время и количество попыток входа
if($times>2){
  //если количество уже совершенных попыток больше 2
if($period<=15){
  //если прошло 15 минут и меньше
exit("Вы превысили число попыток ввода - следующая попытка возможна через 15 минут <a href='/index.php'>Дальше</a>");
  //блокируется ввод пароля, даже если он правильный
}
//если прошло 15 минут и больше, то ничего не происходит и код работает дальше
}
else{//если количество уже совершенных попыток меньше 2
  $times++;
  //увеличивается счетчик на 1
  $query=$pdo->prepare("UPDATE threetimesblock SET timer=NOW(),times=? WHERE loginp=?");
  $query->execute(array($times,$login));
  //обновляется время ввода и значение счетчика в БД
}

//Проверяется пароль
$query=$pdo->prepare("SELECT parp FROM polzovateli WHERE loginp=? LIMIT 1");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))
{
$parolfrom=$line[0];
//извлекаем пароль из БД
}

//Сравниваются введенный и существующий пароли
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
//вносится дата и IP каждого входа  в БД
$query=$pdo->prepare("INSERT INTO forIP (login,ip) VALUES (?,?)");
$query->execute(array($login,$ip));


//происходит переход на страницу пользователя
header("location:/mainpage.php");
}
else{//если пароли не совпали
exit("Пароль НЕ верен! <a href='/index.php'>Повторите попытку!</a>");
}
}//конец функции

//Функция для разрешения входа,если есть сессии логина + IP + ID текущей сессии
//помещается только на страницах пользователя, а не на странице входа на сайт!
function forenter(){


echo '<br>login='.$_SESSION['login'];
echo '<br>ip='.$_SESSION['ip'];
echo '<br>id='.$_SESSION['id'];


//если не существует хотя бы что-то из сессий login,IP или сессия ID, созданная при входе не равна текущему ID, то переходим на страницу входа
if(!isset($_SESSION['login'])||!isset($_SESSION['ip'])||($_SESSION['id']!=session_id())){
  exit("Пройдите пожалуйста для входа на сайт по этой <a href='/index.php'>Ссылке</a>");
}
//если существует, даже и неверный, то сайт будет работать дальше, все равно с другим логином он не выдаст инфу
//проверяем куку PHPSESSID и сравниваем ее с БД,
//если  совпадает
//если не совпадает
}

//главное фото функция
function glavfoto($login,$pdo)
{
$folder11 = '/mainfoto/';//папка для выгрузки файлов
$netfoto="/mainfoto/fotonet.png";
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
else {
    return $netfoto;
}
}

//функция получения данных по логину
function dataFromLogin($login,$pdo){  
$lich=$pdo->prepare("SELECT imya,region,gorod,datarozd,TIMESTAMPDIFF(YEAR, datarozd, NOW()),ipp,pol FROM lichnoe WHERE loginp=? LIMIT 1");
$lich->execute(array($login));
return $lich;
}


//НЕПРОВЕРЕННЫЕ ФУНКЦИИ->>>
////////////////////////////////////////////////////////////

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



/*Функции несвязанные с входом и безопасностью*/













//подтвержден ли логин если "0" то не подтвержден, если "1" то подтвержден
function confirmedLogin($login,$pdo){
$query=$pdo->prepare("SELECT COUNT(proveren) FROM polzovateli WHERE loginp=? AND proveren='0' LIMIT 2");
$query->execute(array($login));
$skolka=$query->fetchColumn();
if($skolka>0){echo"Отправьте сообщение 'reg' со своей электронной почты на admin@vmesteprosto.info для возможности обратной связи с Вами";}
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
?>
<!--подключение стилей с сайта Bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
