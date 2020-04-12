// javascript-код голосования из примера

function neproch_soobsh() {

    // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       


    var neproch_soobsh = document.getElementById('neproch_soobsh')


    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

               neproch_soobsh.innerHTML=req.responseText;

            }

            // тут можно добавить else с обработкой ошибок запроса

        } 
    }
      
    req.open('GET', 'index12ajax.php', true); 

    req.send(null);  // отослать запрос 
 
}


