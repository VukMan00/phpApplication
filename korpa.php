<?php
    require "dbBroker.php";
    require "model/user.php";
    require "model/article.php";
    require "model/basket.php";

    
    session_start();
    $user=null;
    $cena = 0;
    static $brojProizvoda = 0;
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        $result = Basket::getArticlesByUserId($user->userId, $conn);
        $korpa = array();
        $velicine = array();
        $kolicina = array();
        while($row = mysqli_fetch_object($result)){
            $articleId = $row->articleId;
            $korpa[] = $articleId;
            $velicine[] = $row->velicina;
            $kolicine[] = $row->kolicina;
        }

        $brojProizvoda = $user->brojProizvoda;
        $korpa_items = array();
        for($i=0;$i<sizeof($korpa);$i++){
            $result1 = Article::getArticleById($korpa[$i],$conn);
            $article = $result1->fetch_object();
            $cena = $cena + $article->cena*$kolicine[$i];
            $korpa_items[] = $article;
        }
    }

    if(!isset($_SESSION['viewArticle'])){
        $_SESSION['viewArticle'] = new Article();
        $_SESSION['dostupneVelicine'] = '';
        $_SESSION['kolicina'] = 0;
        $_SESSION['error']='';
        echo '<style>#error{visibility: hidden !important;}</style>';
    }


    if(isset($_POST['submit']) && $_POST['submit'] == "Pogledaj artikal"){
        $selektovano = array();
        if(!empty($_POST["select"])){
            $selektovano = $_POST['select'];
            if(sizeof($selektovano)==1){
                $idArticle = $selektovano[0];
                $result = Article::getArticleById($idArticle,$conn);
                $article = $result->fetch_object();
                $_SESSION['dostupneVelicine'] = $article->velicina;

                $resultVelicina = Basket::getSizesByArticleId($idArticle,$user->userId,$conn);
            
                $rsl= mysqli_fetch_row($resultVelicina);
                $article->velicina = $rsl[0];
                $_SESSION['kolicina'] = $rsl[1];
                $_SESSION['viewArticle'] = $article;

                echo '<style>#error{visibility: hidden !important;}</style>';
                echo '<style>#div-view{visibility: visible !important;}</style>';
            }
            else{
                $_SESSION['error']='Mozete samo jedan artikal da izaberete!';
                echo '<style>#error{visibility: visible !important;}</style>';
                echo '<style>#div-view{visibility: hidden !important;}</style>';
            }
        }
        else{
            $_SESSION['error']="Niste izabrali artikal";
            echo '<style>#error{visibility: visible !important;}</style>';
            echo '<style>#div-view{visibility: hidden !important;}</style>';
        }
    }

    if(isset($_POST['submit']) && $_POST['submit']=="Ok"){
        $article = $_SESSION['viewArticle'];
        $kolicina = $_SESSION['kolicina'];
        $velicine = $_POST['velicina'];

        $velicineArtikla = explode(',',$article->velicina);
        $velicineKorpe = explode(' ',$velicine);
        $flag = false;

        if(!empty($_POST['size'])){
            $sizes = $_POST['size'];
            foreach($sizes as $size){
                $velicine = $velicine." ".$size;
                $kolicina++;
            }
            
            $rsl = Basket::updateVelicinaKolicina($article->id,$user->userId,$kolicina,$velicine,$conn);
        }
        echo '<style>#div-view{visibility: hidden !important;}</style>';
        header("Refresh:0");

    }

    if(isset($_POST['submit']) && $_POST['submit']=="Predjite na kupovinu"){
        $brojProizvoda = User::getBrojProizvoda($user->userId,$conn);
        $rslBr = mysqli_fetch_row($brojProizvoda);
        $user->brojProizvoda = $rslBr[0];
        $_SESSION['user'] = $user;
        header("Location: kupovina.php");
        die();
    }

    if(isset($_POST['LogOut'])){
        $_SESSION['user']=null;
        unset($_SESSION['korpa']);
        header("Location:index.php");
    }

    if(isset($_POST['back'])){
        $brojProizvoda = User::getBrojProizvoda($user->userId,$conn);
        $rslBr = mysqli_fetch_row($brojProizvoda);
        $user->brojProizvoda = $rslBr[0];
        $_SESSION['user'] = $user;
        header("Refresh:0; url=katalog.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/korpa.css?<?php echo time(); ?>" rel="stylesheet">
    <script type="text/javascript" src="js/korpa.js"></script>
    <script type="text/javascript" src="js/prikazi.js"></script>
    <title>Korpa</title>
</head>
<body>
    <form method="POST" aciton="#">
        <div class="dataOfUser">
            <input type="submit"  name="back" id="back" value="Povratak na katalog"/>
            <input type="submit"  name="LogOut" id="logOut" value="LogOut"/>
        </div>
    </form>

    <div class="heading-info">
        <h1 style="font-style:italic; font-weight:bold; font-size:40px;"><?php if($user!=null){
            echo $user->ime . " " . $user->prezime;
        } ?>
        </h1>
        <div class="pretraga">
            <h2>Pronadji artikal</h2>
            <select id="artikal" name="artikal" onchange="prikaziArtikal(this.value,'<?php echo $user->userId;?>');">
                <?php
                    $articles = array();
                    $articles[] = new Article();
                    foreach($korpa_items as $korpa_item){
                        $articles[] = $korpa_item;
                    }
                    
                    foreach($articles as $article):
                ?>
                <option value="<?php echo $article->id;?>"><?php echo $article->naziv?></option>
                <?php
                    endforeach;
                ?>
            </select>
        </div>
    </div>

    <div class="articles">
        <form method="POST">
            <table border="1" id="tblBasket">
                <thead>
                    <tr>
                        <th></th>
                        <th>Naziv</th>
                        <th>Marka</th>
                        <th>Cena</th>
                        <th>Velicine</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $brojac = 0;
                        foreach($korpa_items as $korpa_item):
                    ?>
                    <tr>
                        <td>
                            <label for="select[]"><?php echo $korpa_item->id; ?></label>
                            <input type="checkbox" id="select" class="select" name="select[]" value="<?php echo $korpa_item->id?>">
                        </td>
                        <td><?php echo $korpa_item->naziv;?></td>
                        <td><?php echo $korpa_item->marka;?></td>
                        <td><?php echo $korpa_item->cena . " " . "RSD";?></td>
                        <td><?php echo $velicine[$brojac]; $brojac++;?></td>   
                        <td><a href="#" id="delete" onclick="obrisi('<?php echo $korpa_item->id; ?>','<?php echo $user->userId;?>',this.parentNode.parentNode.rowIndex)">Izbrisi</a></td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Ukupno:</td>
                        <td id="ukupno"><?php echo $cena . " " . "RSD"?></td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <div class="submits">
                <input type="submit" class="button-action" id="submit" name="submit" value="Pogledaj artikal" />
                <input type="submit" class="button-action" id="submit" name="submit" value="Predjite na kupovinu" />
                <h1 id="error" style="visibility:hidden; font-style:italic;"><?php echo $_SESSION['error'];?></h1>
            </div>
            <div class="view-article" id="div-view" style="visibility:hidden;">
                <?php 
                    $view = $_SESSION['viewArticle'];
                    $velicine= $_SESSION['dostupneVelicine'];
                    $dostupneVelicine = explode(',',$velicine);
                ?>
                <label for="naziv">Naziv proizvoda</label>
                <input type="text" name="naziv" id="naziv" value="<?php echo $view->naziv; ?>" readonly/>
                <label for="marka">Marka proizvoda</label>
                <input type="text" name="marka" id="marka" value="<?php echo $view->marka; ?>" readonly/>
                <label for="cena">Cena</label>
                <input type="text" name="cena" id="cena" value="<?php echo $view->cena; ?>" readonly/>
                <label for="velicina">Velicine</label>
                <input type="text" name="velicina" id="velicina" value="<?php echo $view->velicina; ?>" readonly/>
                <label>Dostupne velicine:</label>
                <?php 
                    for($i=0;$i<sizeof($dostupneVelicine);$i++):
                ?>
                <div>
                    <label for="size" style="margin-left:10px"><?php echo $dostupneVelicine[$i]; ?></label>
                    <input type="checkbox" id="size" name="size[]" value="<?php echo $dostupneVelicine[$i];?>" />
                </div>
                <?php
                    endfor;
                    $view = null;
                ?>
                <br>
                <input type = "submit" id="submit-article" name="submit" value="Ok"/>
            </div>
        </form>
    </div>
</body>
</html>