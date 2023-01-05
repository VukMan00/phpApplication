<?php
include "../dbBroker.php";

if(!isset($_GET["articleId"]) || !isset($_GET["userId"]) || !isset($_GET["cena"])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $articleId = $_GET["articleId"];
    $userId = $_GET["userId"];
    $ukupnaCena = $_GET["cena"];

    $sql1 = "SELECT brojProizvoda FROM user WHERE userId='".$userId."'";
    $rsl = $conn->query($sql1);
    $rezultat1 = mysqli_fetch_row($rsl);
    $brojProizvoda = $rezultat1[0];
    $brojProizvoda = $brojProizvoda-1;
    
    $sql2 = "UPDATE user SET brojProizvoda='".$brojProizvoda."'WHERE userId='".$userId."'";
    $conn->query($sql2);

    $sql3 = "SELECT kolicina FROM basket WHERE articleId='".$articleId."' AND userId='".$userId."'";
    $rezultat2 = $conn->query($sql3);
    $rsl2 = mysqli_fetch_row($rezultat2);
    $kolicina = $rsl2[0];

    $sql4 = "SELECT cena FROM articles WHERE id='".$articleId."'";
    $rezultat3 = $conn->query($sql4);
    $rsl3 = mysqli_fetch_row($rezultat3);
    $cenaArtikla = $rsl3[0];

    $trenutnaCena = $ukupnaCena - $cenaArtikla*$kolicina;

    $sql = "DELETE FROM basket WHERE userId= '".$userId."' and articleId ='".$articleId."'";
    $rezultat = $conn->query($sql);

    echo $trenutnaCena;

    $conn->close();
}

?>