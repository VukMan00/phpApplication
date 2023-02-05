var xmlHttp;

function dodaj(articleId,userId){
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp==null){
        alert("Browser does not support HTTP Request");
        return false;
    }

    var selectedSizes = document.getElementsByClassName('size'.concat('',articleId));
    var arraySizes = '';
    for(let i=0;i<selectedSizes.length;i++){
        if(selectedSizes[i].checked){
            arraySizes = selectedSizes[i].value + " " + arraySizes;
            selectedSizes[i].checked = false;
        }
    }
    var url="handler/addArticle.php";
    url = url+"?userId="+userId+"&articleId="+articleId+"&sizes="+arraySizes;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

    return false;
}

function stateChanged(){
    if(xmlHttp.readyState==4){
        console.log(xmlHttp.responseText)
        if(xmlHttp.responseText=="Error"){
            document.getElementById("alert").style.visibility = "visible";
            document.getElementById("textAlert").innerHTML = "Morate izabrati velicinu da bi ste mogli da dodate artikal u korpu!!";
        }
        else if(xmlHttp.responseText!=0){
            document.getElementById("brojProizvoda").innerHTML = `${xmlHttp.responseText}`;
            document.getElementById("alert").style.visibility = "visible";
        }
        else{
            document.getElementById("brojProizvoda").innerHTML = "Broj proizvoda";
        }

        document.getElementById("confirm").addEventListener('click',function(){
            zatvori();
        })
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


function zatvori(){
    document.getElementById("alert").style.visibility = "hidden";
    document.getElementById("textAlert").innerHTML = "Proizvod je dodat u korpu";
}