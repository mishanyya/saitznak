function deletemessages(elem){
var parent=elem.parentNode.getAttribute('class');

var nomerelem=elem.getAttribute('src');

var delet=confirm('Удалить переписку ?','');

if(delet==true){
 // (1) создать объект для запроса к серверу
    var req = getXmlHttp()       
  
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
adresatupdate();//обновить вывод адресатов
            }
            // тут можно добавить else с обработкой ошибок запроса
        } 
    }
          req.open('GET', 'deletesoobsheniya.php?del='+nomerelem, true); 
    req.send(null);  // отослать запрос 
}

}

