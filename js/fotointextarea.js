function getimage(src){
var image=document.createElement('img');
this.width=18;
this.src=src;
}

function zamenaintextarea(){//работает- не трогать
var elem = document.querySelector('#soobsh');
var smiles = ["::01.png","::02.png","::03.png","::04.png","::05.png","::06.png","::07.png","::08.png","::09.png"];
var smilesImage = ["fotosmile/smile01.png","fotosmile/smile02.png","fotosmile/smile03.png","fotosmile/smile04.png","fotosmile/smile05.png","fotosmile/smile06.png","fotosmile/smile07.png","fotosmile/smile08.png","fotosmile/smile09.png"];
for (var x=0;x<smiles.length;x++){
    if (elem.innerHTML.indexOf(smiles[x])>-1){
    	var searchSmile = new RegExp(smiles[x],'g');
elem.innerHTML = elem.innerHTML.replace(searchSmile,"<img src="+smilesImage[x]+" width='18'>");  
}}
}   


function vstavit(elem){//работает-не трогать
title=elem.getAttribute('title');
var mysmile=new getimage(title);
var smil=mysmile.src;
smil='::'+smil;
var poluchilos=document.querySelector('.textarea').innerHTML.replace(document.querySelector('.textarea').innerHTML,document.querySelector('.textarea').innerHTML+smil);
document.querySelector('.textarea').innerHTML=poluchilos;
zamenaintextarea();
}


function foundimg(){//не менять- работает
var elems = document.querySelectorAll('#formessage #ajax_soobsh p');
var docLength=document.querySelectorAll('#formessage #ajax_soobsh p').length;

var smilesInsert = ["<img src='fotosmile/smile01.png' width='18'>","<img src='fotosmile/smile02.png' width='18'>","<img src='fotosmile/smile03.png' width='18'>","<img src='fotosmile/smile04.png' width='18'>","<img src='fotosmile/smile05.png' width='18'>","<img src='fotosmile/smile06.png' width='18'>","<img src='fotosmile/smile07.png' width='18'>","<img src='fotosmile/smile08.png' width='18'>","<img src='fotosmile/smile09.png' width='18'>"];

var smiles=["&lt;img src=\"fotosmile/smile01.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile02.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile03.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile04.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile05.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile06.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile07.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile08.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile09.png\" width=\"18\"&gt;"];
for(var i=0;i<docLength;i++)
{
if((i-2)%5==0)
{
for (var x=0;x<smiles.length;x++)
{ 
var searchSmile = new RegExp(smiles[x],'g');
elems[i].innerHTML = elems[i].innerHTML.replace(searchSmile,smilesInsert[x]);  
}}}}


function foundimgDogruzka(){
var elems = document.querySelectorAll('#formessage #echo p');
var docLength=document.querySelectorAll('#formessage #echo p').length;

var smilesInsert = ["<img src='fotosmile/smile01.png' width='18'>","<img src='fotosmile/smile02.png' width='18'>","<img src='fotosmile/smile03.png' width='18'>","<img src='fotosmile/smile04.png' width='18'>","<img src='fotosmile/smile05.png' width='18'>","<img src='fotosmile/smile06.png' width='18'>","<img src='fotosmile/smile07.png' width='18'>","<img src='fotosmile/smile08.png' width='18'>","<img src='fotosmile/smile09.png' width='18'>"];

var smiles=["&lt;img src=\"fotosmile/smile01.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile02.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile03.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile04.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile05.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile06.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile07.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile08.png\" width=\"18\"&gt;","&lt;img src=\"fotosmile/smile09.png\" width=\"18\"&gt;"];
for(var i=0;i<docLength;i++)
{
if((i-2)%5==0)
{
for (var x=0;x<smiles.length;x++)
{ 
var searchSmile = new RegExp(smiles[x],'g');
elems[i].innerHTML = elems[i].innerHTML.replace(searchSmile,smilesInsert[x]);  
}}}}














