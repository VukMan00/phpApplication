var xmlHttp;
function prikaziArtikal(articleId,userId){
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return;
    }

    if(articleId!=''){
        var url = "handler/showArticle.php";
        url = url+"?articleId="+articleId+"&userId="+userId;
        //ne dozvoli kesiranje
        url = url+"&sid="+Math.random();
        xmlHttp.onreadystatechange = stateShow;
        xmlHttp.open("GET",url,true);
        xmlHttp.send(null);
    }else{
        window.location.reload();
    }

}

function stateShow(){
    if(xmlHttp.readyState==4){
        document.getElementById("tblBasket").innerHTML = xmlHttp.responseText;
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