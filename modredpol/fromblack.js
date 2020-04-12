function fromblack(el){
var radiodrugb=el.getAttribute('src');

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
          req.open('POST', 'fromblack.php', true); 
req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
var radi='radiodrugb='+radiodrugb; 
req.send(radi);  // отослать запрос 


parentElem.removeChild(el);//удаление элемента
}