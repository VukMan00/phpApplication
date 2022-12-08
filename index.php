<?php

    require "dbBroker.php";
    require "model/user.php";

    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
        $uname = $_POST['username'];
        $upass = $_POST['password'];
        $korisnik = new User(1,$uname,$upass);
        $odg = User::logIn($uname,$upass,$conn);

        if(!empty($odg) && $odg->num_rows > 0){
            $_SESSION['user'] = $korisnik;
            header('Location:katalog.php');
            exit();
        }
        else{
            $error = $_POST['error'];
            $error = "Pogresan unos podataka. Pokusajte ponovo!";
        }
    }
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet" id="style">
    <!-- Bootstrap core Library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">
            <h1 class='text-white'>Welcome to Login Form</h1>
            <form method="post" action="#">
                <div class="form-login"></br>
                    <h4>Login form</h4>
                    </br>
                    <input type="text" name="username" id="username" class="form-control input-sm chat-input" placeholder="username"/>
                    </br></br>
                    <input type="password" name="password" id="password" class="form-control input-sm chat-input" placeholder="password"/>
                    </br></br>
                    <div class="wrapper">
                            <span class="group-btn">
                                <input name="submit" type="submit" class="btn btn-danger btn-md">
                            </span>
                    </div>
                    <br>
                    <input type="text" name="error" class="form-control input-sm chat-input" style="border:none" value = "<?php echo (isset($error))?$error:'';?>"/>
                    
                </div>
            </form>
        </div>
    </div>
    </br></br></br>
</div>
</body>
</html>