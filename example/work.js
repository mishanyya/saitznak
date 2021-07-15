function functionforajax(){
//создать объект для запроса к серверу
var req = getXmlHttp();

//указать блок в который будут вводиться исходные данные
var inputData= document.getElementById('RegExpInput').value;


//кодирование символов
inputData = encodeURIComponent(inputData);



//указать блок в который будет выводиться результат
var outputData= document.getElementById('RegExpOutput');

//код, работающий с PHP
req.onreadystatechange = function() {
if (req.readyState == 4) {
if(req.status == 200) {
// если статус 200 (ОК) - выдать ответ пользователю
//вывести результат в указанный блок
outputData.innerHTML=req.responseText;

}}}

//в одном файле рекомендуется одновременно использовать только один из запросов GET и POST

//запрос к файлу PHP с передачей значений переменных методом GET
//inputData - значение переменной, которое будет передано на сервер

req.open('GET', 'work1.php?inputData='+inputData, true);
req.send(null); // отослать запрос

/*req.open('POST', 'work1.php', true);//метод и файл обработки
req.setRequestHeader('Content-type','application/x-www-form-urlencoded');//передаваемый заголовок
req.send('inputData='+inputData); // отослать запрос с передаваемой переменной со значением
*/



}
