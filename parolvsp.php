<?php 
include ("../time.php");//подключить файл с функциями и постоянными переменными         
?>


﻿<html>
	
<head>

<title>Знакомства</title>

<script src="ajax.js"></script>
<script src="opisanie.js"></script>


<link rel="stylesheet" type="text/css" href="/style.css"/>	
</head>
<body>
<img src='<?php echo EMBLEMA ;?>' class='emblemaindex'><h1 class='headline-index'><?php echo IMYASAYTA; ?></h1>
 


<form action="parolvspq.php" method="POST"  class="vhod" />
<p class='underline'>Чтобы вспомнить пароль:</p>
<p>Введите email, указанный при входе:</p>
<input type="text" required name="login" maxlength='40' size='40'/>

<p>Поставьте галочку, что Вы не робот</p>
<input type="checkbox" name="text1" value='2'/>

<input type="submit"   value="Отправить" class='small'/>
</fieldset>
<p><a href='/index.php'>Ввести логин и пароль</a></p>
</form>


</body>
</html>