<?php

//код, необходимый для файлов, работающих с ajax
include "generalforajaxfiles.php";

$text=$_POST['text'];
$text=htmlspecialchars($text);
								//меняет статус пользователя
$query=$pdo->prepare("UPDATE statusp SET texts=?,data=NOW() WHERE loginp=?");
$query->execute(array($text,$login));
echo "Ваш статус изменен";
?>
