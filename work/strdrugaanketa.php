<?php

$anketa=$pdo->prepare("SELECT obrazovanie,zanyatiya,prozhivanie,deti,uvlechenie,privichki,dopolnitelno FROM anketa WHERE loginp=? LIMIT 1");
$anketa->execute(array($login_q));

while($line=$anketa->fetch(PDO::FETCH_LAZY)) {
$obrazovanie=$line->obrazovanie;
$zanyatiya=$line->zanyatiya;
$prozhivanie=$line->prozhivanie;
$deti=$line->deti;
$uvlechenie=$line->uvlechenie;
$privichki=$line->privichki;
$dopolnitelno=$line->dopolnitelno;
}

if(!isset($obrazovanie)){$obrazovanie='';}
if(!isset($zanyatiya)){$zanyatiya='';}
if(!isset($prozhivanie)){$prozhivanie='';}
if(!isset($deti)){$deti='';}
if(!isset($uvlechenie)){$uvlechenie='';}
if(!isset($privichki)){$privichki='';}
if(!isset($dopolnitelno)){$dopolnitelno='';}





?>

<p class='vhod'>Анкета</p>


<p class='block1'>Образование:<p><?php echo $obrazovanie;?></p></p>
<p class='block1'>Род занятий:<p><?php echo $zanyatiya;?></p></p>
<p class='block1'>Проживание:<p><?php echo $prozhivanie;?></p></p>
<p class='block1'>Дети:<p><?php echo $deti;?></p></p>
<p class='block1'>Увлечения:<p><?php echo $uvlechenie;?></p></p>
<p class='block1'>Вредные привычки:<p><?php echo $privichki;?></p></p>
<p class='block1'>Дополнительно:<p><?php echo $dopolnitelno;?></p></p>
