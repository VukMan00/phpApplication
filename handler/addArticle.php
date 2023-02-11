<?php
include "../dbBroker.php";
include "../model/user.php";
include "../model/article.php";
include "../model/basket.php";

if(!isset($_GET["userId"]) || !isset($_GET["articleId"]) || !isset($_GET['sizes'])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $userId = $_GET["userId"];
    $articleId = $_GET["articleId"];
    $selectedSizes = $_GET["sizes"];
    $kolicina = 0;
    $arrayOfSizes = array();
    $arrayOfSizes = explode(" ",$selectedSizes);
    if($selectedSizes==''){
        echo "Error";
        return;
    }
    if(sizeof($arrayOfSizes)==0){
        //Ukoliko nekim slucajem ne bude odabrana nijedna velicina, artikal ce imati 1 kolicinu
        $kolicina++;
    }
    else{
        $kolicina = sizeof($arrayOfSizes)-1;
    }

    $rslUser = User::getUserByUserId($userId,$conn);
    $user = $rslUser->fetch_object();

    $rslArticle = Article::getArticleById($articleId,$conn);
    $article = $rslArticle->fetch_object();

    $rslProvera = Basket::getArticleByArticleId($articleId,$userId,$conn);
    $provera = mysqli_fetch_row($rslProvera);

    if($provera==null){
        $user->brojProizvoda = $user->brojProizvoda+1;
        $article->velicina = implode(" ",$arrayOfSizes);

        Basket::add($userId,$articleId,$kolicina,$article->velicina,$conn);
        User::updateBrojProizvoda($userId,$user->brojProizvoda,$conn);
    }
    else{
        $rslCheck = Basket::getSizesByArticleId($articleId,$userId,$conn);
        $checkArray = mysqli_fetch_row($rslCheck);
        $velicinaUKorpi = $checkArray[0];
        $kolicinaUKorpi = $checkArray[1];

        $velicineKorpe = explode(" ",$velicinaUKorpi);
        $flag = true;

        for($i=0;$i<sizeof($arrayOfSizes);$i++){
            $velicinaUKorpi = $velicinaUKorpi." ".$arrayOfSizes[$i];
            $kolicinaUKorpi++;
        }
        Basket::updateVelicinaKolicina($articleId,$userId,$kolicinaUKorpi,$velicinaUKorpi,$conn);
    }
    
    echo $user->brojProizvoda;

    $conn->close();
}
?>