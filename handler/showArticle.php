<?php
include "../dbBroker.php";
include "../model/article.php";
include "../model/basket.php";

if(!isset($_GET["articleId"]) || !isset($_GET["userId"])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $articleId = $_GET["articleId"];
    $userId = $_GET["userId"];

    $rezultat = Article::getArticleById($articleId,$conn);

    $rezultat1 = Basket::getVelicina($articleId,$userId,$conn);
    $velicine = mysqli_fetch_row($rezultat1);

    echo "<table border='1'>
    <tr>
    <thead>
        <th></th>
        <th>Naziv</th>
        <th>Marka</th>
        <th>Cena</th>
        <th>Velicine</th>
    </thead>
    </tr>";

    while($article=$rezultat->fetch_object()){
        echo "<tr>";
        echo "<td>"."<label for='select[]'>".$article->id."</label>" . "<input type='checkbox' id='select' class='select' name='select[]' value=".$article->id."/>"."</td>";
        echo "<td>".$article->naziv."</td>";
        echo "<td>".$article->marka."</td>";
        echo "<td>".$article->cena." "."RSD"."</td>";
        echo "<td>".$velicine[0]."</td>";
        echo "</tr>";
    }

    echo "</table>";

    $conn->close();
}



?>