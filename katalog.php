<?php
    require "dbBroker.php";
    require "model/user.php";


    session_start();
    if (empty($_SESSION['user']) || $_SESSION['user'] == null) {
        header("Location: index.php");
        die();
    }
    else{
        echo "Dobrodosli : " . $_SESSION['user']->username;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
</head>
<body>
</body>
</html>