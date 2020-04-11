// javascript-код голосования из примера

function ajax_soobsh() {

    // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var statusElem = document.getElementById('ajax_soobsh')     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                statusElem.innerHTML=req.responseText;
            } } 
    }
      
 
 req.open('GET', 'index9ajax.php', true);
    req.send(null);  // отослать запрос 
    
}
