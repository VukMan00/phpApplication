var xmlHttp;
function proveri(str){
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "handler/checkUsername.php";
    url=url+"?username="+str;
    url=url+"&sid="+Math.random()
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChanged(){
    if(xmlHttp.readyState == 4){
        console.log("Zahtev je obradjen");
        if(xmlHttp.responseText == "0"){
            document.getElementById('error').setAttribute('value','Korisnik sa takvim username vec postoji.');
            document.getElementById("username").focus();
        }
        else{
            document.getElementById("error").setAttribute('value','Korisnicko ime je dostupno!');
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