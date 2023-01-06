function provera(str){
    var value = str.value;
    if(value===""){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Polje je obavezno!";
        str.focus();
    }
    else{
        document.getElementById('error').style.visibility = 'hidden';
    }

}

function proveraBroja(str){
    var broj = str.value;
   
    if(broj===""){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Polje je obavezno!";
        str.focus();
        return;
    }
    const pattern = new RegExp('06[0-9]{1}-[0-9]{4}-[0-9]{3}');
    if(pattern.test(broj)){
        document.getElementById('error').style.visibility = 'hidden';
        return;
    }
    else{
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Pogresan unos broja telefona!";
        document.getElementById('brojTelefona').focus();
        return;
    }
    
}

function proveraEmail(str){
    var email = str.value;
    if(email===""){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Polje je obavezno!";
        str.focus();
        return;
    }

    const pattern = new RegExp('[a-zA-Z]+[0-9]*@(gmail|yahoo).com');
    if(pattern.test(email)){
        document.getElementById('error').style.visibility = 'hidden';
        return;
    }
    else{
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Pogresan unos broja email-a!";
        document.getElementById('email').focus();
        return;
    }
}

function proveraBrojaRacuna(str){
    var brojRacuna = str.value;
    if(brojRacuna===""){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Polje je obavezno!";
        str.focus();
        return;
    }
    if(brojRacuna.length!=18){
        document.getElementById('error').style.visibility = 'visible';
        document.getElementById('error').innerHTML = "Pogresan unos broja racuna!";
        document.getElementById('brojRacuna').focus();
        return;
    }
    else{
        document.getElementById('error').style.visibility = 'hidden';
        return;
    }
}

function prikaziPlatnaKartica(){
    document.getElementById('banka').style.visibility = 'visible';
    document.getElementById('brojRacuna').style.visibility = 'visible';

    document.getElementById('placanjeURadnji').checked = false;
    document.getElementById('gotovina').checked = false;
}

function prikaziGotovina(){
    document.getElementById('banka').style.visibility = 'hidden';
    document.getElementById('brojRacuna').style.visibility = 'hidden';
    document.getElementById('platnaKartica').checked = false;

    document.getElementById('placanjeURadnji').checked = false;
}

function prikaziPlacanjeRadnja(){
    document.getElementById('banka').style.visibility = 'hidden';
    document.getElementById('brojRacuna').style.visibility = 'hidden';
    document.getElementById('platnaKartica').checked = false;

    document.getElementById('gotovina').checked = false;
}

function prikaziBex(){
    document.getElementById('bex').checked = true;
    document.getElementById('aks').checked = false;
    document.getElementById('posta').checked = false;   
    document.getElementById('preuzimanjeLicno').checked = false;
}

function prikaziAks(){
    document.getElementById('bex').checked = false;
    document.getElementById('aks').checked = true;
    document.getElementById('posta').checked = false;   
    document.getElementById('preuzimanjeLicno').checked = false;
}

function prikaziPosta(){
    document.getElementById('bex').checked = false;
    document.getElementById('aks').checked = false;
    document.getElementById('posta').checked = true;   
    document.getElementById('preuzimanjeLicno').checked = false;
}

function prikaziLicno(){
    document.getElementById('bex').checked = false;
    document.getElementById('aks').checked = false;
    document.getElementById('posta').checked = false;   
    document.getElementById('preuzimanjeLicno').checked = true;
}

function zatvori(){
    document.getElementById('alert').style.visibility='hidden';
    window.location.reload();
}