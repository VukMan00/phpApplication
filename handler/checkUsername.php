<?php
include "../dbBroker.php";

if(!isset($_GET["username"])){
    echo "Username je obavezno polje!";
}
else{
    $username = $_GET["username"];
    $sql = "SELECT username FROM user WHERE username='".$username."'";
    $rezultat = $conn->query($sql);

    if($rezultat->num_rows!=0){
        echo "0";
    }
    else{
        echo "1";
    }

    $conn->close();
}

?>