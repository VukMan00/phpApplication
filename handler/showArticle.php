<?php
include "../dbBroker.php";
if(!isset($_GET["articleId"]) || !isset($_GET["userId"])){
    echo "Jedan od parametra nije prosledjen";
}
else{
    $articleId = $_GET["articleId"];
    $userId = $_GET["userId"];

    $sql = "SELECT * FROM articles WHERE id='".$articleId."'";
    $rezultat = $conn->query($sql);

    $sql1 = "SELECT velicina FROM basket WHERE userId='".$userId."' AND articleId='".$articleId."'";
    $rezultat1 = $conn->query($sql1);
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