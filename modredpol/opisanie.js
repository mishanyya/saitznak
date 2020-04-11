function opisanie() {
var opis=document.getElementById('opisan');
if(opis.innerHTML.length<=0){
var text=document.createElement('textarea');
opis.appendChild(text);
text.name="textopis";
text.innerHTML="";
text.cols="25";
text.rows="10";
var butn=document.createElement('button'); 
butn.name="opis"; 
butn.innerHTML="Добавить описание"; 
opis.appendChild(butn);
 }
}



