﻿function poiskimya(){
    // (1) создать объект для запроса к серверу
    var req = getXmlHttp()       
       
    var imya = document.getElementsByName('imya')[0] 
var imya1 = document.getElementsByName('imya1')[0]  
  
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
                imya1.innerHTML=req.responseText;
            }
            // тут можно добавить else с обработкой ошибок запроса
        } 
    }
          req.open('GET', 'poiskimya.php?imya='+imya.value, true); 
    req.send(null);  // отослать запрос 
  
 }

