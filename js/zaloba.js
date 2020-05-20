function zaloba() {
var prichina=prompt('Введите жалобу','');

if(prichina.length>0){
							// (1) создать объект для запроса к серверу
    var req = getXmlHttp();       
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
	alert(req.responseText);
            }
                    } 
    }
 req.open('POST', 'vdruzya.php', true); 
req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
forpost='zgaloba='+true+'&prichina='+prichina;
req.send(forpost);  // отослать запрос 
}
 }



