

function zgaloba() {


var zgaloba=document.getElementsByName('forma')[0];

 
var text=document.createElement('input');




zgaloba.appendChild(text);

text.name="prichina";

text.value="";



var butn=document.createElement('button'); 


butn.name="zgaloba"; 

butn.innerHTML="Добавить описание"; 

zgaloba.appendChild(butn);
 
}



