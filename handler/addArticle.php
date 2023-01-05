<?php
include "../dbBroker.php";

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
    if(sizeof($arrayOfSizes)==0){
        $kolicina++;
    }
    else{
        $kolicina = sizeof($arrayOfSizes)-1;
    }

    $q = "SELECT * FROM user WHERE userId='".$userId."'";
    $rslUser = $conn->query($q);
    $user = $rslUser->fetch_object();

    $q1 = "SELECT * FROM articles WHERE id='".$articleId."'";
    $rslArticle = $conn->query($q1);
    $article = $rslArticle->fetch_object();

    $q2 = "SELECT articleId FROM basket WHERE articleId = '".$articleId."' and userId='".$userId."'";
    $rslProvera = $conn->query($q2);
    $provera = mysqli_fetch_row($rslProvera);

    if($provera==null){
        $user->brojProizvoda = $user->brojProizvoda+1;

        $article->velicina = implode(" ",$arrayOfSizes);

        $q3 = "UPDATE user SET brojProizvoda='".$user->brojProizvoda."'WHERE userId='".$user->userId."'";
        $conn->query($q3);

        $q4 = "INSERT INTO basket(userId,articleId,kolicina,velicina) VALUES ('$user->userId','$articleId','$kolicina','$article->velicina')";
        $conn->query($q4);
    }
    else{
        $q5 = "SELECT velicina,kolicina FROM basket WHERE userId= '".$user->userId."' and articleId ='".$articleId."'";
        $rslCheck = $conn->query($q5);
        $checkArray = mysqli_fetch_row($rslCheck);
        $velicinaUKorpi = $checkArray[0];
        $kolicinaUKorpi = $checkArray[1];

        $velicineKorpe = explode(" ",$velicinaUKorpi);
        $flag = true;

        for($i=0;$i<sizeof($arrayOfSizes);$i++){
            $velicinaUKorpi = $velicinaUKorpi." ".$arrayOfSizes[$i];
            $kolicinaUKorpi++;
        }

        $q6 = "UPDATE basket SET kolicina='".$kolicinaUKorpi."' ,velicina='".$velicinaUKorpi."' WHERE userId='".$userId."' and articleId='".$articleId."'";
        $conn->query($q6);
    }

    $q7 = "SELECT brojProizvoda FROM user WHERE userId = '".$userId."'";
    $rslBrProizvoda = $conn->query($q7);
    $brojProizvoda = mysqli_fetch_row($rslBrProizvoda);
    echo $brojProizvoda[0];

    $conn->close();
}




?>