function drug() {
 // (1) создать объект для запроса к серверу
    var req = getXmlHttp()        
 
var start_limit=document.getElementById('start_limit').value;//start_limit
start_limit=parseInt(start_limit, 10);//перевод из строки в число с основанием 10

var limit=document.getElementById('limit').value;//limit
limit=parseInt(limit, 10);//перевод из строки в число с основанием 10

var metkapol=document.getElementById('metkapol').value;//metkap
var esliestmetka=document.getElementById('esliestmetka').value;//esliestmetka
var imya=document.getElementById('imya').value;//imya
var pol=document.getElementById('pol').value;//pol

var region=document.getElementById('region').value;//region
var vozrast1=document.getElementById('vozrast1').value;//vozrast1
var vozrast2=document.getElementById('vozrast2').value;//vozrast2
 
vozrast1=parseInt(vozrast1, 10);//перевод из строки в число с основанием 10
vozrast2=parseInt(vozrast2, 10);//перевод из строки в число с основанием 10


  var drug_ajax = document.getElementById('drug_ajax');

							//создание элемента
var drug_ajax_in=document.createElement('div');
							//присвоение ему класса
drug_ajax_in.className='drug_ajax_in';
							//вставляем элемент drug_ajax_in в drug_ajax
drug_ajax.appendChild(drug_ajax_in);

    req.onreadystatechange = function() { 
							// onreadystatechange активируется при получении ответа сервера
        if (req.readyState == 4) {
							// если запрос закончил выполняться 
           if(req.status == 200) {
							 // если статус 200 (ОК) - выдать ответ пользователю
							 // показать ответ сервера в элементе drug_alax_in

drug_ajax_in.innerHTML = req.responseText;

							//если выводятся пустые строку - в данном случае с lenght<6 кнопка еще скрывается
var drug_ajax_in_length=drug_ajax_in.innerHTML.length;
if(drug_ajax_in_length<6){
document.getElementById('button_poisk').style.visibility='hidden';
}

            }
            // тут можно добавить else с обработкой ошибок запроса
        }
    }

 start_limit=start_limit+limit;
document.getElementById('start_limit').value=start_limit;//start_limit

document.getElementById('limit').value=limit;//limit

      // (3) задать адрес подключения
   req.open('GET', 'drug_ajax.php?metkapol='+metkapol+'&esliestmetka='+esliestmetka+'&imya='+imya+'&pol='+pol+'&region='+region+'&vozrast1='+vozrast1+'&vozrast2='+vozrast2+'&start_limit='+start_limit+'&limit='+limit ,true);  
    // объект запроса подготовлен: указан адрес и создана функция onreadystatechange
    // для обработки ответа сервера      
        // (4)
    req.send(null);  // отослать запрос



}