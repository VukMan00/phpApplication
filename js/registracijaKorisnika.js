var xmlHttp;
function registruj(str,str1,str2,str3){
    var username = str.value;
    var password = str1.value;
    var ime = str2.value;
    var prezime = str3.value;
    console.log("aaaaa");
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "handler/registrationUser.php";
    url=url+"?username="+username+"&password="+password+"&ime="+ime+"&prezime="+prezime;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange = stateChangedRegistration;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChangedRegistration(){
    if(xmlHttp.readyState == 4){
        console.log("Zahtev je obradjen");
        console.log(xmlHttp.responseText);
        if(xmlHttp.responseText == "0"){
            document.getElementById('alert').style.visibility = 'visible';
            document.getElementById('textAlert').innerHTML = 'Uspesna registracija!';
        }
        else{
            document.getElementById('alert').style.visibility = 'visible';
            document.getElementById('textAlert').innerHTML = 'Neuspesno registrovanje';
        }
    }
}

function GetXmlHttpObject(){
    var xmlHttp = null;
    try{
        //Fireforx,Opera,Safarik
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


function potvrdi(){
    document.getElementById('alert').style.visibility="hidden";
    if(document.getElementById('textAlert').innerHTML === 'Uspesna registracija!'){
        window.location.href = 'index.php';
    }
}