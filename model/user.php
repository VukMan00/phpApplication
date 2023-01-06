<?php

class User{
    public $id;
    public $username;
    public $password;
    public $ime;
    public $prezime;
    public $brojProizvoda;


    public function __construct($id=null,$username=null,$password=null,$ime=null,$prezime=null,$brojProizvoda = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->brojProizvoda = $brojProizvoda;
    }


    public static function logIn($username, $password,$conn){
        $q = "SELECT * FROM user WHERE username= '".$username."' and password ='".$password."'";
        return $conn->query($q);
    }

    public static function register($username,$password,$ime,$prezime,$conn){
        $q = "INSERT INTO user(username, password, ime, prezime,brojProizvoda) values('$username', '$password', '$ime', '$prezime','0')";
        return $conn->query($q);
    }

    public static function updateBrojProizvoda($id,$brojProizvoda,$conn){
        $query = "UPDATE user SET brojProizvoda='".$brojProizvoda."'WHERE userId='".$id."'";
        return $conn->query($query);
    }

    public static function getBrojProizvoda($userId,$conn){
        $q = "SELECT brojProizvoda FROM user WHERE userId='".$userId."'";
        return $conn->query($q);
    }

    public static function getUserByUserId($userId,$conn){
        $q = "SELECT * FROM user WHERE userId='".$userId."'";
        return $conn->query($q);
    }
}


?>