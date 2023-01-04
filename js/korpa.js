var xmlHttp;

function obrisi(str,str1,red){
    console.log("AA");
    console.log(str);
    console.log(str1);

    pomocna = parseInt(red);
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }

    var url="handler/deleteFromBasket.php";
    url=url+"?id="+str+"&userId="+str1;
    url = url +"&sid="+Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

}

function stateChanged(){
    if(xmlHttp.readyState==4){
        console.log(xmlHttp.responseText);
        if(xmlHttp.responseText!=0){
            var cena = xmlHttp.responseText;
            console.log(cena);
            var stringCena = document.getElementById("ukupno").innerHTML;
            console.log(stringCena);
            var trenutnaCena = parseInt(stringCena);

            let izracunataCena = trenutnaCena - cena;
            document.getElementById("ukupno").innerHTML = izracunataCena.toString();
            document.getElementById("tblBasket").deleteRow(pomocna);
        }
        else{
            console.log("NE CAO");
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