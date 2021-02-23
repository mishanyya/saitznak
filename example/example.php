<?php
//получение переменной из JS файла
$varphp=$_GET['var'];
echo "3=".$varphp;

//получение переменной из JS файла
$varphp1=$_POST['blacklist1'];
echo "<br/>5=".$varphp1;

//проведение вычислений
$resultphp=$varphp*$varphp1;

//вывод результата вычислений
echo "<br/>3*5=".$resultphp;
?>
