function ajax_soobsh() {
    // (1) создать объект для запроса к серверу
    var req = getXmlHttp()       
           var statusElem = document.getElementById('ajax_soobsh')     
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
                statusElem.innerHTML=req.responseText;
scrolling();
var kolvo=document.querySelector('#kolvo').value;
document.querySelector('#kolvo').value=kolvo;

if(kolvo>15){document.querySelector('#ischo').style.visibility='visible';}
foundimg();
            } } 
    }      
 req.open('GET', 'ajax_soobsh.php', true);
    req.send(null);  // отослать запрос 
    }
