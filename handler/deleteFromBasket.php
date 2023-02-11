<?php
include "../dbBroker.php";
include "../model/user.php";
include "../model/article.php";
include "../model/basket.php";

if(!isset($_GET["articleId"]) || !isset($_GET["userId"]) || !isset($_GET["cena"])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $articleId = $_GET["articleId"];
    $userId = $_GET["userId"];
    $ukupnaCena = $_GET["cena"];

    $rsl = User::getBrojProizvoda($userId,$conn);
    $rezultat1 = mysqli_fetch_row($rsl);
    $brojProizvoda = $rezultat1[0];
    $brojProizvoda = $brojProizvoda-1;
    
    User::updateBrojProizvoda($userId,$brojProizvoda,$conn);

    $rezultat2 = Basket::getKolicina($articleId,$userId,$conn);
    $rsl2 = mysqli_fetch_row($rezultat2);
    $kolicina = $rsl2[0];

    $rezultat3 = Article::getCena($articleId,$conn);
    $rsl3 = mysqli_fetch_row($rezultat3);
    $cenaArtikla = $rsl3[0];
    $trenutnaCena = $ukupnaCena - $cenaArtikla*$kolicina;

    Basket::delete($articleId,$userId,$conn);

    echo $trenutnaCena;
    $conn->close();
}
?>