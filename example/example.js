function functionforajax(){
//создать объект для запроса к серверу
var req = getXmlHttp();

//указать блок в который будет выводиться результат
var ajaxresult= document.getElementsByClassName('ajaxresult')[0];

//код, работающий с PHP
req.onreadystatechange = function() {
if (req.readyState == 4) {
if(req.status == 200) {
// если статус 200 (ОК) - выдать ответ пользователю
//вывести результат в указанный блок
ajaxresult.innerHTML=req.responseText;
}}}

//в одном файле рекомендуется одновременно использовать только один из запросов GET и POST

//1 метод GET
//запрос к файлу PHP с передачей значений переменных методом GET
//указать значение переменной, которое будет передано на сервер
var varjs=3;
req.open('GET', 'example.php?var='+varjs, true);
req.send(null); // отослать запрос

//2 метод POST
//запрос к файлу PHP с передачей значений переменных методом POST
//указать значение переменной, которое будет передано на сервер
var varjs1=5;
req.open('POST', 'example.php', true);
req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
req.send('blacklist1='+varjs1);  // отослать запрос
}
