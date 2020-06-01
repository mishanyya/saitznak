<?php
include ("functions.php");//подключить файл с функциями и постоянными переменными

//session_start();//открыть сессию
//удаляем логин этого пользователя
unset($_SESSION['login']);
?>
<!DOCTYPE html>
<html>
<head>
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



<form action="/<?php echo $regcatalog; ?>/registr1.php" method="POST"  class="vhod"/>

<p class="h4 text-primary">Для регистрации на сайте рекомендуется вводить логин или адрес электронной почты, в виде цифр, символов латинского алфавита и знаков -_.@</p>


<input type="text" required name='login' maxlength='40' size='40' id="inner" onkeyup="islatinfont()"/>
<p class="h4 text-primary">У вас появилась возможность подтвердить свой e-mail</p>
<input type="checkbox"  name='ifemail'/>
<p class="h4 text-primary">Подтвердите согласие с условиями использования данного ресурса</p>
<input type="checkbox"  name='text1' value='2'/>
<input type="submit"   value="Отправить" class=''/>
<p class="h6"><a href='/index.php'>Регистрация была произведена ранее</a></p>

      </form>

    </div>

</body>
</html>
