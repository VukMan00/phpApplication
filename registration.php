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
    <title>Registration</title>
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet" id="style">
    <!-- Bootstrap core Library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript"  src="js/validacijaUsername.js"></script>
    <script type="text/javascript"  src="js/registracijaKorisnika.js"></script>
</head>
<body>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">
            <h1 class='text-white'>Autumn online shop registracija</h1>
            <form method="GET" onsubmit="return false;">
                <div class="form-login"></br>
                    <h4>Registruj se. Sva polja su obavezna!</h4>
                    </br>
                    <input type="text" name="username" id="username" class="form-control input-sm chat-input" placeholder="username" onblur="proveri(document.getElementById('username'))"/>
                    </br></br>
                    <input type="password" name="password" id="password" class="form-control input-sm chat-input" placeholder="password" />
                    </br></br>
                    <input type="text" name="name" id="name" class="form-control input-sm chat-input" placeholder="name" />
                    </br></br>
                    <input type="text" name="lastname" id="lastname" class="form-control input-sm chat-input" placeholder="lastname"/>
                    </br></br>
                    <div class="wrapper">
                            <span class="group-btn">
                                <input name="submit" id="register" type="submit" class="btn btn-danger btn-md" value="Register" onclick="registruj(document.getElementById('username'),document.getElementById('password'),document.getElementById('name'),document.getElementById('lastname'));" />
                            </span>
                    </div>
                    <br>
                    <a href="index.php">Povratak na login formu</a>
                    <input type="text" name="error" id="error" class="form-control input-sm chat-input" style="border:none" value=''/>
                </div>
                <div id="alert" style="visibility:hidden;">
                    <div id="box">
                        <div class="obavestenje">
                            Obaveštenje!
                        </div>
                        <div class="sadrzaj">
                            <p id="textAlert">Uspesna registracija!</p>
                            <button id="confirm" onclick="potvrdi()">OK</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </br></br></br>
</div>
</body>
</html>