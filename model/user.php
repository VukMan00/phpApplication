<?php

class User{
    public $id;
    public $username;
    public $password;
    public $ime;
    public $prezime;


    public function __construct($id=null,$username=null,$password=null,$ime=null,$prezime=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->ime = $ime;
        $this->prezime = $prezime;
    }


    public static function logIn($name, $password, mysqli $conn){
        $q = "SELECT * FROM user WHERE username= '".$name."' and password ='".$password."' limit 1;";
        
        return $conn->query($q);
    }
}


?>