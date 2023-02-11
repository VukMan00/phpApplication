var xmlHttp;
var pomocna;
function obrisi(str,str1,red){
    pomocna = parseInt(red);
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }

    var cena = parseInt(document.getElementById('ukupno').innerHTML);

    var url="handler/deleteFromBasket.php";
    url=url+"?articleId="+str+"&userId="+str1+"&cena="+cena;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChanged(){
    if(xmlHttp.readyState==4){
        console.log(xmlHttp.responseText);
        if(xmlHttp.responseText>=0){
            document.getElementById("tblBasket").deleteRow(pomocna);
            document.querySelector('select').remove(pomocna);
            var cena = xmlHttp.responseText;
            document.getElementById('ukupno').innerHTML = `${cena}` + ' RSD';
        }
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