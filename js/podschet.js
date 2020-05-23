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
  document.getElementById('conclude').innerHTML=inner;
  document.getElementById('conclude1').innerHTML='нормальный символ';
  /*

 var parol = document.getElementById('conclude');

var dlina=statusElem.innerHTML.length;

if(dlina<8){parol.style.color="red";
par.innerHTML="Создавайте пароль длиной не меньше 8 символов";
par.style.color="red";
}
else if(dlina>=8){parol.style.color="green";
par.innerHTML="Хороший пароль";
par.style.color="green";
}*/
}
