var latitude= document.getElementById("latitude");
var longitude= document.getElementById("longitude");

function bloque(event){
    if((event.keyCode >=48 && event.keyCode <=57) || (event.keyCode == 44)){
        return true;
    }
    else{
        return false;
    }
}
