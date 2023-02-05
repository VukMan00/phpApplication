<?php
    require "dbBroker.php";
    require "model/user.php";
    require "model/article.php";
    require "model/basket.php";


    session_start();
    $user=null;
    if(!isset($_SESSION['korpa'])){
        $_SESSION['korpa']='';
    }

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $rsl = User::getUserByUserId($user->userId,$conn);
        $user = $rsl->fetch_object();
        $result = Basket::getArticlesByUserId($user->userId,$conn);
        $korpa = array();

        while($row = mysqli_fetch_object($result)){
            $korpa[] = $row->articleId;
        }

        $korpa_items = array();

        for($i=0;$i<sizeof($korpa);$i++){
            $result = Article::getArticleById($korpa[$i],$conn);
            $article = $result->fetch_object();
            $korpa_items[] = $article->naziv;
        }

        $_SESSION['korpa']=implode(",",$korpa_items);
    }


    if(isset($_POST['LogOut'])){
        $_SESSION['user']=null;
        header("Location:index.php");
    }

    if(isset($_POST['back'])){
        header("Refresh:0; url=korpa.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/kupovina.css?<?php echo time(); ?>" rel="stylesheet">
    <script type="text/javascript" src="js/kupovina.js?t=1491313943549"></script>
    <script type="text/javascript" src="js/transakcija.js"></script>
    <title>Kupovina</title>
</head>
<body>
    <form method="POST" aciton="#">
        <div class="go-back">
            <input type="submit"  name="back" id="back" value="Povratak na korpu"/>
            <input type="submit"  name="LogOut" id="logOut" value="LogOut"/>
        </div>
    </form>
    <form method="POST" onsubmit="transakcija('<?php echo $user->userId; ?>'); return false;">
        <div class="transaction">
            <div class="dataOfUser">
                <h1>Unesite vase podatke</h1>
                <h3 style="font-style: italic; background-color:#FF9933; border-radius:10px; border:2px solid aliceblue;">*Popuniti polja. Paziti na format podataka koji se unosi, sva polja su obavezna!</h3>
                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime" placeholder="Ime" value="<?php echo $user->ime;?>" readonly/>
                <br>
                <label for="prezime">Prezime:</label>
                <input type="text" id="prezime" name="prezime" placeholder="Prezime" value="<?php echo $user->prezime;?>" readonly/>
                <br>
                <label for="adresa">Adresa:</label>
                <input type="text" id="adresa" name="adresa" placeholder="Adresa" onblur="provera(document.getElementById('adresa'))"/>
                <br>
                <label for="opstina">Opstina:</label>
                <input type="text" id="opstina" name="opstina" placeholder="Opstina" onblur="provera(document.getElementById('opstina'))"/>
                <br>
                <label for="brojTelefona">Broj telefona:</label>
                <input type="text" id="brojTelefona" name="brojTelefona" placeholder="06#-####-###"  onblur="proveraBroja(document.getElementById('brojTelefona'));"/>
                <br>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="example@mail.com" onblur="proveraEmail(document.getElementById('email'));"/>

                <h3 id="error" style="visibility:hidden;"></h3>
            </div>
            <div class="type-transaction">
                <h1>Izaberite vrstu placanja</h1>
                <div class="logo">
                    <img src='slike/masterCard.png' width="70px" height="40px">
                    <img src='slike/visa.png' width="60px" height="40px">
                </div>
                <br>
                <div>
                    <input type="radio" class="payment"  id="platnaKartica" name="platna" value="Platna kartica" placeholder="Platna kartica" onclick="prikaziPlatnaKartica();"/> 
                    <label class="placanja" for="platna">Platna kartica</label>
                    <p style="font-style: italic; margin-left:20px;  background-color:#FF9933; border-radius:10px; border:2px solid aliceblue;">*Nas sajt nudi i opciju online placanja. Ukoliko se odlucite za ovu opciju, potrebno je i dodatno uneti banku i racun preko kojeg se vrsi placanje</p>
                    <div class="podaci-placanja">
                        <input type="text" id="banka" name="banka" placeholder="Unesite ime banke" onblur="provera(document.getElementById('banka'))"/>
                        <br>
                        <br>
                        <input type="text" id="brojRacuna" name="brojRacuna" placeholder="Unesite broj racuna. Racun mora da ima 18 cifara!" onblur="proveraBrojaRacuna(document.getElementById('brojRacuna'))"/>
                    </div>
                    <br>
                    <input type="radio" class="payment"  id="gotovina"  name="gotovina" value="Gotovina" placeholder="Gotovina"/ onclick="prikaziGotovina()">
                    <label class="placanja" for="gotovina">Gotovina</label>
                    <p style="font-style: italic; margin-left:20px;  background-color:#FF9933; border-radius:10px; border:2px solid aliceblue;">*Placanje na licu mesta, kod kurira koji isporucuje.</p>
                    <br>
                    <input type="radio" class="payment"  id="placanjeURadnji" name="placanjeURadnji" value="Placanje u radnji"/ onclick="prikaziPlacanjeRadnja()">
                    <label class="placanja" for="placanjeURadnji">Placanje u radnji"</label>
                    <p style="font-style: italic; margin-left:20px;  background-color:#FF9933; border-radius:10px; border:2px solid aliceblue;">*Platite u radnji odakle mozete i preuzeti artikal.</p>
                </div>
            </div>
            <div class="type-delivery">
                <h1>Nacin isporuke</h1>
                <br>
                <div class="logo">
                    <img src='slike/bex.png' width="60px" height="50px" id="icon">
                    <img src='slike/ax.png' width="100px" height="40px" style="border-radius:10px;">
                    <img src='slike/images.png' width="120px" height="40px" style="border-radius:10px; margin-left:10px;">
                </div>
                <br>
                <div>
                    <input type="radio" class="delivery" id="bex" name="bex" value="Bex isporuka" onclick="prikaziBex()"/>
                    <label class="placanja" for="bex">Bex isporuka</label>
                    <br>
                    <br>
                    <input type="radio" class="delivery" id="aks" name="aks" value="Aks isporutka" onclick="prikaziAks()"/>
                    <label class="placanja" for="aks">Aks isporuka</label>
                    <br>
                    <br>
                    <input type="radio" class="delivery" id="posta" name="posta" value="Posta Srbije" onclick="prikaziPosta()"/>
                    <label class="placanja" for="posta">Posta Srbije</label>
                    <br>
                    <br>
                    <input type="radio" class="delivery" id="preuzimanjeLicno" name="preuzimanjeLicno" value="Preuzmite u radnji" onclick="prikaziLicno()"/>
                    <label class="placanja" for="preuzimanjeLicno">Preuzmite u radnji</label>
                </div>
            </div>
            <div class="commit-transaction">
                <h1>Vasa korpa</h1>
                <img src='slike/korpa.png' width="120px" height="120px">
                <h3 id="proizvodi" style="font-style: italic;"><?php if(isset($_SESSION['korpa'])){echo $_SESSION['korpa'];}else{echo "Ovde ce se ispisati proizvodi";}?></h3>
                <h3>Broj proizvoda: <span id="brojProizvoda"><?php echo $user->brojProizvoda; ?></span></h3>
                <input type="submit" class="button-action" id="submit" name="submit" value="Potvrdite transakciju"/>
            </div>
        </div>
    </form>

    <div id="alert" style="visibility:hidden;">
        <div id="box">
            <div class="obavestenje">
                 Obaveštenje!
            </div>
            <div class="sadrzaj">
                <p id="opis" style="color:saddlebrown;">Transakcija je izvrsena. Hvala na kupovini</p>
                <button id="confirm" onclick="zatvori();">OK</button>
            </div>
        </div>
    </div>
</body>
</html>