function sendmessage() {
var soobsh=document.querySelector('#soobsh').innerHTML;
if((soobsh.length>0)&&(soobsh!=' ')){
// (1) создать объект для запроса к серверу
    var req = getXmlHttp();       
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
	ajax_soobsh();//обновляет модуль с сообщениями
adresatupdate();//обновляет список адресатов
            }
                    } 
    }
 req.open('POST', 'soobsheniya1.php', true); 
req.setRequestHeader('Content-type','application/x-www-form-urlencoded');


forpost='soobsh='+soobsh;
req.send(forpost);  // отослать запрос 

document.querySelector('#soobsh').innerHTML='';
}							
 }