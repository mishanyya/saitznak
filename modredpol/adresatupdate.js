
function adresatupdate() {

var parent=document.querySelector('.block2');

    // (1) создать объект для запроса к серверу
    var req = getXmlHttp();       
          
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
                parent.innerHTML=req.responseText;
            } } 
    }      
 req.open('GET', 'adresatupdate.php', true);
    req.send(null);  // отослать запрос 
    }
