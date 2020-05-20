function podtverdit(){

var radioArray=document.getElementsByName('confirmlogin');
for(var i=0;i<radioArray.length;i++)
{
if(radioArray[i].checked)
{
var radioValue=radioArray[i].value;
}
}

if(confirm('подтверждаем ?'))
{

  // (1) создать объект для запроса к серверу
    var req = getXmlHttp()  ;

 req.onreadystatechange = function()
{  

 if (req.readyState == 4)
{        
if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
document.getElementById('proba').innerHTML=req.responseText;            
}
} 

 }
req.open('GET', 'podtverdit.php?radiovalue='+radioValue, true); 
req.send(null);  // отослать запрос 
}
}
