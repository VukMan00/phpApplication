<?php 
include "../dbBroker.php";
include "../model/user.php";
include "../model/article.php";
include "../model/basket.php";
include "../model/transaction.php";
include "../model/payment.php";

if(!isset($_GET["userId"]) || !isset($_GET["adresa"]) || !isset($_GET["opstina"]) || !isset($_GET["brojTelefona"]) || !isset($_GET["email"]) || !isset($_GET["placanje"]) || !isset($_GET["isporuka"]) || !isset($_GET["banka"]) || !isset($_GET["brojRacuna"])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $userId = $_GET["userId"];
    $adresa = $_GET["adresa"];
    $opstina = $_GET["opstina"];
    $brojTelefona = $_GET["brojTelefona"];
    $email = $_GET["email"];
    $placanje = $_GET["placanje"];
    $isporuka = $_GET["isporuka"];
    $banka = $_GET["banka"];
    $brojRacuna = $_GET["brojRacuna"];

    $ukupanIznos = 0;
    $rezultat = Basket::getArticlesByUserId($userId,$conn);
    $articles = array();
    while($row = mysqli_fetch_object($rezultat)){
        $articleId = $row->articleId;
        $kolicina = $row->kolicina;
        $velicina = $row->velicina;

        $rezultat2 = Article::getArticleById($articleId,$conn);
        $article = $rezultat2->fetch_object();

        $article->velicina = $velicina;
        $article->kolicina = $kolicina;
        $articles[] = $article;
    }

    for($i=0;$i<sizeof($articles);$i++){
        $ukupanIznos = $ukupanIznos + $articles[$i]->cena*$articles[$i]->kolicina;
    }

    Transaction::addTransaction($adresa,$opstina,$brojTelefona,$email,$placanje,$isporuka,$ukupanIznos,$userId,$conn);

    $rsl = Transaction::getTransaction($conn);
    $rslTransaction = mysqli_fetch_row($rsl);
    $transactionId = $rslTransaction[0];
    if($banka!='' && $brojRacuna!=''){
        Payment::addPayment($banka,$brojRacuna,$transactionId,$conn);
    }

    for($j=0;$j<sizeof($articles);$j++){
        $articleId = $articles[$j]->id;
        $velicine = $articles[$j]->velicina;
        $q="INSERT INTO transactionarticles(transactionId,articleId,velicine) VALUES('$transactionId','$articleId','$velicine')";
        $conn->query($q);
    }

    Basket::deleteArticlesOfUser($userId,$conn);
    User::updateBrojProizvoda($userId,0,$conn);

    echo "1";

    $conn->close();
}



?>