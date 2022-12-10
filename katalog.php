<?php
    require "dbBroker.php";
    require "model/user.php";


    session_start();
    if (empty($_SESSION['user']) || $_SESSION['user'] == null) {
        header("Location: index.php");
        die();
    }
    else{
        $user = $_SESSION['user'];
        $ime = $user->ime;
        $prezime = $user->prezime;
        $username = $user->username;
        $password = $user->password;
    }

    if(isset($_POST['LogOut'])){
        $_SESSION['user']=null;
        header("Location:index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/katalog.css" rel="stylesheet" id="style">
    <title>Katalog</title>
</head>
<body>
    <div class="heading-container">
        <div class="dataOfUser">
            <form method="post" aciton="#">
                <input type="submit" name="LogOut" id="logOut" value="LogOut"/>
        </div>
        <div class="heading">
            <h1 id="main-heading">Welcome  to Autumn shop</h1><h2 id="user"><?php echo (isset($user))?$ime." ".$prezime:''; ?></h2>
        </div>
    </div>
    <div>

</body>
</html>