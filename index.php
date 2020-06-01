<?php
include "functions.php";//подключить файл с функциями и постоянными переменными

//session_start();//открыть сессию
//если существует сессия login и ip то переходим сразу на страницу пользователя
if(isset($_SESSION['login'])&&(isset($_SESSION['ip']))){
header("location:mainpage.php");
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta name="Keywords" content="<?php echo $keywords; /*показать keywords для сайта*/?>"/>
  <meta name="Description" content="<?php echo $description; /*показать description для сайта*/?>"/>
  <title><?php echo $title; /*показать title*/?></title>

  <script src="js/ajax.js"></script>
  <script src="js/opisanie.js"></script>
  <script src="js/podschet.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
<link href='https://fonts.googleapis.com/css?family=Rubik+Mono+One|Yeseva+One|Prosto+One|Press+Start+2P|Playfair+Display+SC|Marck+Script|Bad+Script|Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>

<div>
<img src='<?php echo EMBLEMA ;?>' class='rounded mx-auto d-block emblemaindex' alt="<?php echo $alt; /*показать alt для эмблемы сайта*/?>">
<h1 class='display-3 mx-auto  d-flex justify-content-center'><?php echo IMYASAYTA; ?></h1>

    <form action="/<?php echo $regcatalog; /*показать имя папки с файлами для регистрации и входа*/?>/enter.php" method="POST" class='vhod'>
    <p class="h4 text-primary">Введите Логин:</p>
    <input required name='login'/>
    <p class="h4 text-primary">Введите Пароль:</p>
    <input type="password" required name="parol"/>
    <input type="submit"  value="Войти" class=''/>
    <p class="h6"><a href="<?php /*показать имя папки с файлами для регистрации и входа*/?>/registr.php">Регистрация</a></p>
  <!--временно закрыл восстановление пароля  <p class="h6"><a href="<?php /*показать имя папки с файлами для регистрации и входа*/?>/parolvsp.php">Вспомнить пароль</a></p> -->
    </form>
</div>

</body>
</html>
