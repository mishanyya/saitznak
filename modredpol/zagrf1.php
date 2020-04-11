<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
	<body>
<a href='index.php'><img src='<?php echo EMBLEMA; ?>' class='emblemaindex'/></a>
<div class='mesimg'>
<?php

try{
   
session_start();//инициируем сессию   
							//для входа если есть логин и пароль
 forenter();



 $userstable="fototabl";
$userstable1="lichnoe";

$login=$_SESSION['login'];
$login=htmlspecialchars($login);

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);

							//номер пользователя для имен файлов
$nomp=$_SESSION['np'];
$nomp=htmlspecialchars($nomp);

							
							//функция при открытии проверяет наличие логина и совпадение парол и логина
provlogparip($login,$ip,$pdo);
							//возвращает объект с личными данными
$lich=dataFromLogin($login,$pdo);
while($line=$lich->fetch(PDO::FETCH_LAZY)){
$limitfoto=$line->limitfoto;
}


							//проверка на существование uploadFile
if(isset($_FILES['uploadFile'])){     
//if($_FILES['uploadFile']['error']=='0') {echo"ошибок нет<br>";}//этой строки не надо
if($_FILES['uploadFile']['error']=='1') {echo"большой размер файла<br>";}
if($_FILES['uploadFile']['error']=='2') {echo" размер  файла превышает 3 Мб<br>";}
if($_FILES['uploadFile']['error']=='3') {echo"не загружен из-за соединения<br>";}
if($_FILES['uploadFile']['error']=='4') {echo"файл не выбран<br>";}
$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");

///////////////////////////////////////////////
$q=$folder.basename($_FILES['uploadFile']['name']);
/*echo"== $q  ==";


if (is_readable($q)) {
    echo '<i>Файл доступен для чтения</i><br/>';
} else {
    echo '<i>Файл недоступен для чтения</i><br/>';
}

$perms = fileperms($q);

if (($perms & 0xC000) == 0xC000) {
    // Сокет
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Символическая ссылка
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Обычный
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Специальный блок
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Директория
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Специальный символ
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // Поток FIFO
    $info = 'p';
} else {
    // Неизвестный
    $info = 'u';
}

// Владелец
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Группа
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// Мир
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

echo "== $info ==";
*/


//////////////////////////////////////////////////
  foreach ($blacklist as $item)
    if(preg_match("/$item\$/i", $_FILES['uploadFile']['name'])) {echo" файл опасен выберите другой файл- этот не подходит для системы"; 
exit;}
  $type = $_FILES['uploadFile']['type'];
  if (($type != "image/jpg") && ($type != "image/jpeg")&& ($type != "image/png")&& ($type != "image/gif")) 
{
exit;}
// имя файла должно быть на латинице
//Узнаем тип файла
if ($_FILES['uploadFile']['type'] == 'image/jpeg')
{
$imyafaila=$U.$nomp.".jpg";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === jpeg";
}
else if ($_FILES['uploadFile']['type'] == 'image/png')
{
$imyafaila=$U.$nomp.".png";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === png";
}
else if ($_FILES['uploadFile']['type'] == 'image/gif')
{
$imyafaila=$U.$nomp.".gif";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === gif";
}
else
{
//echo" тип === неизвестен";
exit(" тип === неизвестен");
}
//проверка загружаемых файлов
$types = array('image/jpg','image/jpeg','image/gif','image/png');//тип файла
$size = 3145728;//размер файла в байтах
// Проверяем тип файла
if (!in_array($_FILES['uploadFile']['type'], $types)) //проверка значений в массиве
die('<br>Запрещённый тип файла.');
// Проверяем размер файла
if ($_FILES['uploadFile']['size'] > $size)
die('<br>Слишком большой размер файла.');
  if(isset($_POST['upload']))
{
$upload=$_POST['upload'];
$upload=htmlspecialchars($upload);



  $uploadedFile = $folder.basename($_FILES['uploadFile']['name']); //.basename возвращает имя файла
  if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
{
  if(move_uploaded_file($_FILES['uploadFile']['tmp_name'],    $uploadedFile)) //(из какого места, в какое место =пути)
  {
     echo"<i>Файл загружен</i>";
  }
  else
  {
     echo " Во  время загрузки файла произошла ошибка";
  }
  }
  else
  {
   echo 'Файл не  загружен';
  }
  }
							// получаем массив, содержащий размеры изображения 
$size = getimagesize ($folder.basename($_FILES['uploadFile']['name'])); 
							// Значение флага,  
							// возвращаемого функцией getimagesize() под индексом 2 
							// после определения размера изображения 
$flag = array(1=>'GIF', 
             2=>'JPG', 
             3=>'PNG', 
             4=>'SWF', 
             5=>'PSD', 
             6=>'BMP', 
             7=>'TIFF(байтовый порядок intel)', 
             8=>'TIFF(байтовый порядок motorola)', 
             9=>'JPC', 
             10=>'JP2', 
             11=>'JPX'); 
//echo "Тип изображения: " . $flag[$size[2]] .'<br>'; //этих строк на странице не надо
//echo "Ширина и Высота: " . $size[3] .'<br>'; 
if (!isset($quality))
$quality = 75;
							// Cоздаём исходное изображение на основе исходного файла
if ($_FILES['uploadFile']['type'] == 'image/jpeg')
$source = imagecreatefromjpeg($folder.basename($_FILES['uploadFile']['name']));
else if ($_FILES['uploadFile']['type'] == 'image/png')
$source = imagecreatefrompng($folder.basename($_FILES['uploadFile']['name']));
else if ($_FILES['uploadFile']['type'] == 'image/gif')
$source = imagecreatefromgif($folder.basename($_FILES['uploadFile']['name']));
else return false;
							// Поворачиваем изображение если задан угол поворота $rotate- но он не задан
/*
if (!isset($rotate)){
$src = imagerotate($source, $rotate, 0);
}
else */$src = $source;

// Определяем ширину и высоту изображения

$w_src = imagesx($src);

$h_src = imagesy($src);

// В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.

// Если ширина больше заданной

// Вычисление пропорций

if($h_src>$w_src){

$w_dest=300;  //новая ширина

$h_dest=$w_dest*$h_src/$w_src; //новая высота
}

else if($h_src<=$w_src){

$h_dest=300;  //новая ширина

$w_dest=$h_dest*$w_src/$h_src; //новая высота
}

// Создаём пустую картинку
$dest = imagecreatetruecolor($w_dest, $h_dest);


// Копируем старое изображение в новое с изменением параметров

imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);//копирует и изменяет размеры части изображения



// Вывод картинки и очистка памяти

imagejpeg($dest,$folder.basename($_FILES['uploadFile']['name']), $quality);

imagedestroy($dest);//очистка памяти

imagedestroy($src);//очистка памяти


  /*
  $x_o и $y_o - координаты левого верхнего угла выходного изображения на исходном
  $w_o и h_o - ширина и высота выходного изображения
  */

  function crop($image, $x_o, $y_o, $w_o, $h_o) 
{

    if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0))     
    {
      echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // функция list($,$,$) сразу из массива значения в переменные заносит.Получаем размеры и тип изображения (число)

    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений

    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа

    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения   "."для соединения в одно слово используется

      $img_i = $func($image); // Создаём дескриптор / копию для работы с исходным изображением

              } 
     else {
      echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый

      return false;

           }

    if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её

    if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её

    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения с размерами конечного изображения

    imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное

    $func = 'image'.$ext; // Получаем функция для сохранения результата

    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции

}

$koor_w=0;//координаты начала нового рисунка
$koor_h=0;

if($h_dest>$w_dest){ $koor_h=($koor_h+$h_dest)/2-($w_dest/2);}
else if($w_dest>=$h_dest){ $koor_w=($koor_w+$w_dest)/2-($h_dest/2);}


if($w_dest<$h_dest){$h_dest=$w_dest;}
 else if($h_dest<=$w_dest){$w_dest=$h_dest;}

							// Вызываем функцию обрезать изображение по центру
  crop($folder.basename($_FILES['uploadFile']['name']), $koor_w, $koor_h, $w_dest,$h_dest); 

							//загружаем фотографию и путь к ней в БД
$query=$pdo->prepare("INSERT INTO fototabl (loginp,foto,metka,opisanie,ponravilos,nom,data) VALUES (?, ?,'','','',NULL,NOW())");
$query->execute(array($login,$imyafaila));
 							//выбор из БД всех фотографий пользователя
//echo"<br/>";
/*$query=$pdo->prepare("SELECT foto FROM fototabl WHERE loginp=? LIMIT $limitfoto");
$query->execute(array($login));
while($line=$query->fetch(PDO::FETCH_LAZY))//выводит строки пока они не кончатся в бд
{*/
$adres="fotosait/".$imyafaila;
 ?>
<img src="<?php  echo $adres; ?>  " />
<?php
/*
}
*/
//header("location:izobrudal.php");

}//проверка на существование uploadFile
else{"Файл пока не загружается";}



}catch (Exception $e) {
    echo $e->getMessage(); //выведет либо сообщение об ошибке подключения, либо об ошибке выбора
}
?>




<a href='izobrudal.php' class='naglavnuyu'>Мои фото</a>
<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</div>
</body>



</html>