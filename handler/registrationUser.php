<?php
include '../dbBroker.php';
include '../model/user.php';

if(!isset($_GET['username']) || !isset($_GET['password']) || !isset($_GET['ime']) || !isset($_GET['prezime'])){
    echo "Jedan od parametara nije prosledjen";
}
else{
    $username = $_GET['username'];
    $password = $_GET['password'];
    $ime = $_GET['ime'];
    $prezime = $_GET['prezime'];

    if($username!='' && $password!='' && $ime!='' && $prezime!=''){
        User::register($username,$password,$ime,$prezime,$conn);
        echo "0";
    }
    else{
        echo "1";
    }

    $conn->close();
}



?>