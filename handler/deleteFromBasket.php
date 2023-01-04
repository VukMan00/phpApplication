<?php
include "../dbBroker.php";

if(!isset($_GET["id"])){
    echo "Parametar id nije prosledjen!";
}
else{
    $id = $_GET["id"];
    $userId = $_GET["userId"];

    $sql = "DELETE FROM basket WHERE userId= '".$userId."' and articleId ='".$id."'";
    if($rezultat = $conn->query($sql)){
        echo "1";
    }

    $sql1 = "SELECT brojProizvoda FROM user WHERE userId='".$userId."'";
    $rsl = $conn->query($sql1);
    $rezultat1 = mysqli_fetch_row($rsl);
    $brojProizvoda = $rezultat1[0];
    $brojProizvoda = $brojProizvoda-1;
    
    $sql2 = "UPDATE user SET brojProizvoda='".$brojProizvoda."'WHERE userId='".$userId."'";
    $rsl1 = $conn->query($sql2);

    $conn->close();
}

?>