var xmlHttp;
function proveri(str){
    var username = str.value;
    console.log("AAAAA");
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "handler/checkUsername.php";
    url=url+"?username="+username;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange = stateChangedUsername;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChangedUsername(){
    if(xmlHttp.readyState == 4){
        console.log("Zahtev je obradjen");
        console.log(xmlHttp.responseText);
        if(xmlHttp.responseText == "0"){
            document.getElementById('error').style.visibility = 'visible';
            document.getElementById('error').setAttribute('value','Korisnik sa takvim username vec postoji.');
            document.getElementById('username').focus();
        }
        else if(xmlHttp.responseText == "2"){
            document.getElementById('error').style.visibility = 'visible';
            document.getElementById('error').setAttribute('value','Polje je obavezno!!');
            document.getElementById("username").focus();
        }
        else{
            document.getElementById('error').style.visibility = 'hidden';
            document.getElementById("error").setAttribute('value','');
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