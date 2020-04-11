

 


function myslipolzovatelya() {




var myslipolzovatelya=document.getElementById('myslipolzovatelya');

if(myslipolzovatelya.innerHTML.length<=0){

var text=document.createElement('textarea');
text.name="text";
text.innerHTML="";
text.autofocus="true";
text.cols="25";
text.rows="10";
myslipolzovatelya.appendChild(text);
var butn=document.createElement('button'); 
butn.name="myslip"; 
butn.innerHTML="Выставить этот текст на всеобщее обозрение"; 
myslipolzovatelya.appendChild(butn);


}

}



   



