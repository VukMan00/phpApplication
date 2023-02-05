<?php
    require "dbBroker.php";
    require "model/user.php";
    require "model/article.php";
    require "model/basket.php";

    $pictures = array("slike/thmw0mw27688-bds-5_16227.jpg","slike/boot.jpg","slike/cipele.webp","slike/asos chukka boots.webp","slike/kapa.webp","slike/Kickers- Kick HI patike.webp","slike/kozna jakna.webp","slike/Only & sons kaput.webp");

    session_start();
    if (empty($_SESSION['user']) || $_SESSION['user'] == null) {
        header("Location: index.php");
        die();
    }
    else{
        $user = $_SESSION['user'];
        $idUser = $user->userId;
        $ime = $user->ime;
        $prezime = $user->prezime;
        $username = $user->username;
        $password = $user->password;
        $brojProizvoda = $user->brojProizvoda;
    }

    $result = Article::getArticles($conn);
    while($row=mysqli_fetch_object($result)){
        $id = $row->id;
        $naziv = $row->naziv;
        $marka = $row->marka;
        $cena = $row->cena;
        $velicina = $row->velicina;

        $article = new Article($id,$naziv,$marka,$cena,$velicina);
        $articles[] = $article;
    }

    if(isset($_POST['vidiKorpu'])){
        header('Location:korpa.php');
    }

    if(isset($_POST['LogOut'])){
        $_SESSION['user']=null;
        unset($_SESSION['korpa']);
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/katalog.css?<?php echo time(); ?>" rel="stylesheet">
    <script type="text/javascript" src="js/katalog.js?t=1491313943549"></script>
    <title>Katalog</title>
</head>
<body>
    <div class="heading-container">
        <div class="dataOfUser">
            <form method="post" aciton="#">
                <input type="submit" name="LogOut" id="logOut" value="LogOut"/>
            </form>
        </div>
        <div class="heading">
            <h1 id="main-heading">Welcome to Autumn shop</h1><h2 id="user"><?php echo (isset($user))?$ime." ".$prezime:''; ?></h2>
        </div>
    </div>
    <br><br>
    <div class="between">
        <div class="bucket">
            <form method="POST" action="#">
                <input type="submit" name="vidiKorpu" id="vidiKorpu" value="Pogledaj korpu"/>
            </form>
            <img src="slike/giphy.gif" id="shopping-cart">
        </div>
        <div class="cart-shopping">
            <img src="slike/icon-cart.png" style="width:70px; height:50px;" id="cart">
            <h4 id="brojProizvoda"><?php
            $user = $_SESSION['user'];
            if($user->brojProizvoda!=0)
            {echo $user->brojProizvoda;}
            else{echo 'Broj proizvoda';}?></h4>
        </div>
    </div>
    <br><br>
    <div class="articles">
        <?php
            $i = 0;
            $selektovaneVelicine = array();
            foreach($articles as $ar):
        ?>
        <div class="item">
            <form method="POST" onsubmit="dodaj('<?php echo $ar->id;?>','<?php echo $user->userId;?>'); return false;">
                <input type="hidden" name="id" value="<?php echo $ar->id?>"/>
                <h1 id="name" style="text-align:center"><?php echo $ar->naziv ?></h1>
                <div class="picture" style="text-align: center;">
                    <img src="<?php echo $pictures[$i]; $i++;?>">
                </div>
                <div class="description">
                    <div class="brand">
                        <h2>Marka: 
                        <h2><?php echo $ar->marka ?></h2>
                        </h2>
                    </div>
                    <div class="price">
                    <h2>Cena:
                        <h2><?php echo $ar->cena ?></h2>
                        <h2></h2>
                        <h2>RSD</h2>
                    </h2>
                    </div>
                    <div class="size">
                        <h2>Veličine:</h2>
                        <?php
                            $arrayVelicina = explode(',',$ar->velicina);
                            for($j=0;$j<sizeof($arrayVelicina);$j++):
                        ?>
                        <div>
                            <label for="size" style="margin-left:10px"><?php echo $arrayVelicina[$j]; ?></label>
                            <input type="checkbox" class=<?php echo "size".$ar->id; ?> name="size[]" value="<?php echo $arrayVelicina[$j];?>" />
                        </div>
                        <?php 
                            endfor;
                        ?>
                    </div>
                </div>
                <div class="add-cart">
                    <input type="submit" name="submit" class="btn-add-basket" value="Dodaj u korpu"/>
                </div>
            </form>
            <div id="alert" style="visibility:hidden;">
                <div id="box">
                    <div class="obavestenje">
                        Obaveštenje!
                    </div>
                    <div class="sadrzaj">
                        <p id="textAlert">Proizvod je dodat u korpu</p>
                        <button id="confirm">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</body>
</html>