<?php
$host = "localhost";
$db = "phpdomaci";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_errno){
    exit("Neuspesna konekcija: ".$conn->connect_errno);
}


?>