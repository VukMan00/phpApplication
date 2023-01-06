var xmlHttp;
var adresa;
var opstina;
var brojTelefona;
var email;
var placanje;
var isporuke;
var vrstaPlacanja;
var vrstaIsporuke;

function transakcija(str){
    var userId = str;
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }

    adresa = document.getElementById('adresa').value;
    opstina = document.getElementById('opstina').value;
    brojTelefona = document.getElementById('brojTelefona').value;
    email = document.getElementById('email').value;
    placanje = document.getElementsByClassName('payment');
    isporuke = document.getElementsByClassName('delivery');

    let brojacPlacanje = 0;
    let brojacIsporuke = 0;

    vrstaPlacanja = '';
    vrstaIsporuke = '';
    for(let i=0;i<placanje.length;i++){
        if(placanje[i].checked == true){
            brojacPlacanje++;
            vrstaPlacanja = placanje[i].value;
        }
    }

    for(let j=0;j<isporuke.length;j++){
        if(isporuke[j].checked==true){
            brojacIsporuke++;
            vrstaIsporuke=isporuke[j].value;
        }
    }
    
    if(document.getElementById('error').style.visibility == 'visible'){
        document.getElementById('error').innerHTML = 'Morate pravilno uneti podatke!';
        return;
    }
    else if(adresa==="" || opstina==="" || brojTelefona==="" || email==="" || brojacPlacanje==0 || brojacIsporuke==0){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = 'Morate pravilno uneti podatke!';
        return;
    }
    else{
        document.getElementById('error').style.visibility = 'hidden';
        var banka = document.getElementById('banka').value;
        var brojRacuna = document.getElementById('brojRacuna').value;

        var url = "handler/addTransaction.php";
        url = url+"?userId="+userId+"&adresa="+adresa+"&opstina="+opstina+"&brojTelefona="+brojTelefona+"&email="+email;
        url = url+"&placanje="+vrstaPlacanja+"&isporuka="+vrstaIsporuke+"&banka="+banka+"&brojRacuna="+brojRacuna;
        url = url+"&sid="+Math.random();
        xmlHttp.onreadystatechange = stateChanged;
        xmlHttp.open("GET",url,true);
        xmlHttp.send(null);
    }
}

function stateChanged(){
    if(xmlHttp.readyState==4){
        document.getElementById('alert').style.visibility='visible';
    }
}


function GetXmlHttpObject(){
    var xmlHttp = null;
    try{
        //Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }catch(e){
        //Internet Explorer
        try{
            xmlHttp = new ActiveXObject("Msxm12.XMLHTTP");
        }catch(e){
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }

    return xmlHttp;
}