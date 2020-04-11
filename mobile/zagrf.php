<html>	
<head>
<title>Сайт знакомств</title>
<script src="ajax.js"></script>
<script src="opisanie.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
	<body>
<i style='color:blue;'>&alpha;</i>-версия сайта<br/><br/>
<a href='index.php'><img src='/fotosait/VP.png' class='emblema'/></a>
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
$userstable1="lichnoe";



$login=$_SESSION['login'];
$login=htmlspecialchars($login);
$login=mysql_real_escape_string($login);//экранирует символы кроме % и _

$ip=$_SESSION['ip'];
$ip=htmlspecialchars($ip);
$ip=mysql_real_escape_string($ip);//экранирует символы кроме % и _



$strochekparolya=forenter($login,$ip);

if($strochekparolya!=1){exit("Пройдите для входа по <a href='/index.php'>ссылке</a>");}
$array=imyaizlogina($login);
echo"<i>$array[0]  </i><br/><br/>";                                    //модуль с полями для ввода пароля и логина
$query="SELECT limitfoto FROM $userstable1 WHERE loginp='$login'"; 
$result = mysql_query($query) or die("Query не получилось");
while($line=mysql_fetch_row($result))
{
$limitfoto=$line[0];
}
$query="SELECT foto FROM $userstable WHERE loginp='$login'"; 
$result = mysql_query($query) or die("Query не получилось");
$kol=mysql_num_rows($result);
echo"У вас фотографий $kol<br/>";
if($kol>=$limitfoto){echo"Количество загруженных Вами файлов составляет $kol ,К сожалению сейчас у нас нет возможности размещать более $limitfoto файлов ";
echo"<a href='index.php' class='naglavnuyu'>На мою страницу</a>";
exit();}
$nomp=$_SESSION['np'];


$nomp=htmlspecialchars($nomp);
$nomp=mysql_real_escape_string($nomp);//экранирует символы кроме % и _



$ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
//echo"Ваш ip $ip<br/>";
?>
Размер файла должен быть до 3 Мб <br/>
  <form  enctype="multipart/form-data" action=""  method="post">
  <input  type="hidden" name="MAX_FILE_SIZE" value="3145728"  />
  <input  type="file" name="uploadFile" accept="image/jpeg,image/png,image/gif"/>
  <input  type="submit" name="upload" value="Загрузить"/>
  </form>
<?php

if(isset($_FILES['uploadFile'])){     //проверка на существование uploadFile

if($_FILES['uploadFile']['error']=='0') {echo"ошибок нет<br>";}
if($_FILES['uploadFile']['error']=='1') {echo"большой размер файла<br>";}
if($_FILES['uploadFile']['error']=='2') {echo" размер  файла превышает 3 Мб<br>";}
if($_FILES['uploadFile']['error']=='3') {echo"не загружен из-за соединения<br>";}
if($_FILES['uploadFile']['error']=='4') {echo"файл не выбран<br>";}
$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
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

echo" тип === jpeg";
}
else if ($_FILES['uploadFile']['type'] == 'image/png')
{

$imyafaila=$U.$nomp.".png";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин

echo" тип === png";
}
else if ($_FILES['uploadFile']['type'] == 'image/gif')
{

$imyafaila=$U.$nomp.".gif";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин

echo" тип === gif";
}
else
{
echo" тип === неизвестен";
exit();
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
$upload=mysql_real_escape_string($upload);//экранирует символы кроме % и _



//  $folder = '/home/u284627933/public_html/fotosait/';//папка для загрузки файлов vmesteprosto.info
//$folder = '/server/www/fotosait/';//папка для загрузки файлов дома на localhost
$folder = '/home/localhost/www/fotosait/';//папка для загрузки файлов на ноутбуке
 $folder1 = '/fotosait/';//папка для выгрузки файлов

  $uploadedFile = $folder.basename($_FILES['uploadFile']['name']); //.basename возвращает имя файла

  if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
{
  if(move_uploaded_file($_FILES['uploadFile']['tmp_name'],    $uploadedFile)) //(из какого места, в какое место =пути)

  {
     echo" Файл загружен";
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


echo "Тип изображения: " . $flag[$size[2]] .'<br>'; 
echo "Ширина и Высота: " . $size[3] .'<br>'; 


if ($quality == null)
$quality = 75;

 
// Cоздаём исходное изображение на основе исходного файла

if ($_FILES['uploadFile']['type'] == 'image/jpeg')

$source = imagecreatefromjpeg($folder.basename($_FILES['uploadFile']['name']));

else if ($_FILES['uploadFile']['type'] == 'image/png')

$source = imagecreatefrompng($folder.basename($_FILES['uploadFile']['name']));

else if ($_FILES['uploadFile']['type'] == 'image/gif')

$source = imagecreatefromgif($folder.basename($_FILES['uploadFile']['name']));

else

return false;


// Поворачиваем изображение

if ($rotate != null)

$src = imagerotate($source, $rotate, 0);

else

$src = $source;

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


  crop($folder.basename($_FILES['uploadFile']['name']), $koor_w, $koor_h, $w_dest,$h_dest); // Вызываем функцию обрезать изображение по центру

// переименовать файл в индивидуальное имя


/* $query1="SELECT metka FROM $userstable WHERE loginp='$login'AND metka='glav'";
$result1 = mysql_query($query1) or die("Query не получилось");
$strok1=mysql_num_rows($result1);//кол-во строк
if($strok1==0)
{
$result = mysql_query("INSERT INTO $userstable (loginp,foto,metka,opisanie,ponravilos,nom,data) VALUES ('$login', '$imyafaila','glav','','',NULL,NOW())");//вставляет первое фото и делает его главным 
$query="SELECT * FROM $userstable WHERE loginp='$login'";//выбирает и выводит эту фотографию
$result = mysql_query($query) or die("Query не получилось");
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
 ?>
<img  class="imgmoi" src="<?php  echo $folder1.$line[1];     ?> "  />
<?php
}
}
else if($strok1>=1)
{
*/

$result = mysql_query("INSERT INTO $userstable (loginp,foto,metka,opisanie,ponravilos,nom,data) VALUES ('$login', '$imyafaila','','','',NULL,NOW())");//загружает фотографию и путь к ней
$query="SELECT * FROM $userstable WHERE loginp='$login'";
$result = mysql_query($query) or die("Query не получилось");//выбирает и выводит все фотографии
while($line=mysql_fetch_row($result))//выводит строки пока они не кончатся в бд
{
 ?>
<img  class="imgmoi" src="<?php  echo $folder1.$line[1];     ?>  " />
<?php
}

/* } */

//unset($_POST['upload']);
header("location:izobrudal.php");

}//проверка на существование uploadFile
else{"Файл пока не загружается";}
?>





<a href='index.php' class='naglavnuyu'>На мою страницу</a>
</body>



</html>