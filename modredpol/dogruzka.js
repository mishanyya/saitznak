function vozvrat() {
   // (1) создать объект для запроса к серверу
    var req = getXmlHttp()        
  var kolvo=document.getElementById('kolvo').value;//сколько всего строк в таблице
kolvo=parseInt(kolvo, 10);//перевод из строки в число с основанием 10
var dostroki=document.getElementById('dostroki').value;//вывод до строки №
dostroki=parseInt(dostroki, 10);//перевод из строки в число с основанием 10
var skolko=document.getElementById('skolko').value;//вывод до строки №
skolko=parseInt(skolko, 10);//перевод из строки в число с основанием 10
var chislo=document.getElementById('chislo').value;//вывод до строки №
chislo=parseInt(chislo, 10);//перевод из строки в число с основанием 10
var skakogo=document.getElementById('skakogo').value;//вывод со строки №
skakogo=parseInt(skakogo, 10);//перевод из строки в число с основанием 10
  var echo = document.getElementById('echo');
    req.onreadystatechange = function() { 
        // onreadystatechange активируется при получении ответа сервера
        if (req.readyState == 4) {
            // если запрос закончил выполняться 
           if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
 echo.innerHTML = req.responseText; // показать ответ сервера
 foundimgDogruzka();
            }
            // тут можно добавить else с обработкой ошибок запроса
        }
    }
      // (3) задать адрес подключения
   req.open('GET', 'dogruzka.php?skakogo='+skakogo+'&dostroki='+dostroki+'&skolko='+skolko, true);  
    // объект запроса подготовлен: указан адрес и создана функция onreadystatechange
    // для обработки ответа сервера      
        // (4)
    req.send(null);  // отослать запрос
if(skakogo<chislo){skakogo=dostroki%chislo;chislo=skakogo;}//когда строки вот вот кончатся 
if(skakogo==0){document.getElementById('ischo').style.display="none";}//когда строки кончаются кнопка убирается
skakogo=skakogo-chislo;
document.getElementById('skakogo').value=skakogo;// с какого номера выдает данные
skolko=skolko+chislo;
document.getElementById('skolko').value=skolko;//сколько записей выдает
document.getElementById('chislo').value=chislo;//сколько записей выдает
 }
//if(skakogo<chislo_vrem){chislo=dostroki%chislo_vrem;}   
//else{ chislo=15;}//по сколько записей выдает
 // chislo=parseInt(chislo, 10);//перевод из строки в число с основанием 10