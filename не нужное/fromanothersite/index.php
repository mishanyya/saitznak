<?php
$adresURL="http://www.volgaplastic-a.ru/pricelist.php";
$q=file_get_contents($adresURL);



preg_match_all('|<[^>]+>(.*)</[^>]+>|U',$q,$c);

echo $c[0][0];
echo $c[0][1];
echo $c[1][0];
echo $c[1][1];

?>
