function deletemessage(elem){
var parent=elem.parentNode.parentNode.getAttribute('id');

var nomerelem=elem.getAttribute('src');
//


 // (1) создать объект для запроса к серверу
    var req = getXmlHttp()       
  
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
if(parent=='ajax_soobsh'){
ajax_soobsh();//обновляем блок с сообщениями
}
else if(parent=='echo'){
vozvrat();//обновляем блок дозагрузки
}
            }
            // тут можно добавить else с обработкой ошибок запроса
        } 
    }
          req.open('GET', 'deletesoobsheniya.php?ns='+nomerelem, true); 
    req.send(null);  // отослать запрос 









}