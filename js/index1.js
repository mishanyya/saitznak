

function vozvrat() {

    // (1) создать объект для запроса к серверу

    var req = getXmlHttp() 

        

        // (2)

    // span рядом с кнопкой

    // в нем будем отображать ход выполнения
var strok=document.getElementById('strok').value;//сколько всего строк в таблице

strok=parseInt(strok, 10);//перевод из строки в число с основанием 10


var skakogo=document.getElementById('hidden').value;

skakogo=parseInt(skakogo, 10);//перевод из строки в число с основанием 10


    var echo = document.getElementById('echo');


    var echo1=document.createElement('div'); 
echo1.className='echo1';
echo.appendChild(echo1);



    req.onreadystatechange = function() { 


        // onreadystatechange активируется при получении ответа сервера



        if (req.readyState == 4) {

            // если запрос закончил выполняться

 
 

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю


          echo1.innerHTML = req.responseText; // показать ответ сервера



            }

            // тут можно добавить else с обработкой ошибок запроса

        }

 

    }



       // (3) задать адрес подключения

    req.open('GET', 'index1php.php?skakogo='+skakogo, true); 

 

    // объект запроса подготовлен: указан адрес и создана функция onreadystatechange

    // для обработки ответа сервера

      

        // (4)

    req.send(null);  // отослать запрос

   

        // (5)
//document.getElementsByClassName('echo1')[length-1].innerHTML=req.responseText;



skakogo=skakogo+5;
document.getElementById('hidden').value=skakogo;

if(skakogo>=strok){document.getElementById('button').style.display="none";}//когда строки кончаются кнопка убирается
}
