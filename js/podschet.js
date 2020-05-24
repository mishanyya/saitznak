//подсчет символов в строке ввода

function podschet() {


    var statusElem = document.getElementById('par');

     var parol = document.getElementById('parol');

var dlina=parol.value.length;

if(dlina<8){parol.style.color="red";
par.innerHTML="Создавайте пароль длиной не меньше 8 символов";
par.style.color="red";
}
else if(dlina>=8){parol.style.color="green";
par.innerHTML="Хороший пароль";
par.style.color="green";
}

}

//сравнить длину паролей

function sravnitdlinupar(){

     var parol = document.getElementById('parol');

var par1 = document.getElementById('par1');

     var parol1 = document.getElementById('parol1');

var dlina=parol.value.length;
var dlina=parol.value.length;
var dlina1=parol1.value.length;

if(dlina==dlina1){
par1.innerHTML="Длины паролей совпадают";
par1.style.color="green";
parol1.style.color="green";
}
else{
par1.innerHTML="Длины паролей не совпадают";
par1.style.color="red";
parol1.style.color="red";
}
}




//проверяет содержание только латинских букв и знаков @_-.
function islatinfont(){
  var inner = document.getElementById('inner').value;
  let regexp = /^([a-zA-Z0-9\-\_\.]+\@[a-z]+\.[a-z]+)/;

//let- объявление переменной, ее видно только внутри {}
//test- поиск совпадений, покажет true или false

//проверка вводимых символов
let regexperr = /[^\@\_\-\.a-zA-Z0-9]/;
if(regexperr.test(inner)==true){
alert('Вы ввели что-то не то!');
}



//отмечается, если введен email
if(regexp.test(inner)==true){
  document.getElementsByName('ifemail')[0].checked=true;
}
else{
  document.getElementsByName('ifemail')[0].checked=false;
}

}
