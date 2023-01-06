<?php


class Basket{
    public $user;
    public $article;
    public $kolicina;
    public $velicina;

    public function __construct($user=null,$article=null,$kolicina=null,$velicina){

        $this->user = $user;
        $this->article = $article;
        $this->kolicina = $kolicina;
        $this->velicina = $velicina;
    }

    public static function add($userId, $articleId,$kolicina,$velicina,$conn){
        $query = "INSERT INTO basket(userId,articleId,kolicina,velicina) VALUES ('$userId','$articleId','$kolicina','$velicina')";
        return $conn->query($query);
    }

    public static function getArticlesByUserId($userId,$conn){
        $query = "SELECT * FROM basket WHERE userId='".$userId."'";
        return $conn->query($query);
    }

    public static function getSizesByArticleId($articleId,$userId,$conn){
        $q = "SELECT velicina,kolicina FROM basket WHERE userId= '".$userId."' and articleId ='".$articleId."'";
        return $conn->query($q);
    }

    public static function delete($articleId,$userId,$conn){
        $q = "DELETE FROM basket WHERE userId= '".$userId."' and articleId ='".$articleId."'";
        return $conn->query($q);
    }

    public static function updateVelicinaKolicina($articleId,$userId,$kolicina,$velicina,$conn){
        $query = "UPDATE basket SET kolicina='".$kolicina."' ,velicina='".$velicina."' WHERE userId='".$userId."' and articleId='".$articleId."'";
        return $conn->query($query);
    }

    public static function getArticleByArticleId($articleId,$userId,$conn){
        $query = "SELECT articleId FROM basket WHERE articleId = '".$articleId."' and userId='".$userId."'";
        return $conn->query($query);
    }

    public static function getKolicina($articleId,$userId,$conn){
        $query = "SELECT kolicina FROM basket WHERE articleId='".$articleId."' AND userId='".$userId."'";
        return $conn->query($query);
    }

    public static function getVelicina($articleId,$userId,$conn){
        $query = "SELECT velicina FROM basket WHERE userId='".$userId."' AND articleId='".$articleId."'";
        return $conn->query($query);
    }

    public static function deleteArticlesOfUser($userId,$conn){
        $query="DELETE FROM basket WHERE userId='".$userId."'";
        return $conn->query($query);
    }


}



?>