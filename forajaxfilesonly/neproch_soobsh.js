//function neproch_soobsh(){
        // (1) создать объект для запроса к серверу
  var req = getXmlHttp();
           var neproch_soobsh= document.getElementsByClassName('neproch_soobsh')[0];
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
//neproch_soobsh.innerHTML="req.responseText";
//alert(req.responseText);
  neproch_soobsh.innerHTML=req.responseText;

            }
                    }
    }
          req.open('GET', '/phpforajax/neproch_soobsh.php', true);
    req.send(null);  // отослать запрос
//}
