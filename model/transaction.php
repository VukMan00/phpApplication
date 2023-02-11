<?php

class Transaction{
    public $transactionId;
    public $adresa;
    public $opstina;
    public $brojTelefona;
    public $email;
    public $placanje;
    public $dostava;
    public $iznos;
    public $user;

    function __construct($transactionId=null,$adresa=null,$opstina=null,$brojTelefona=null,$email=null,$iznos=null,$placanje=null,$dostava=null,$user=null)
    {
        $this->transactionId = $transactionId;
        $this->adresa = $adresa;
        $this->opstina = $opstina;
        $this->brojTelefona = $brojTelefona;
        $this->email = $email;
        $this->iznos = $iznos;
        $this->placanje = $placanje;
        $this->dostava = $dostava;
        $this->user = $user;
    }

    public static function addTransaction($adresa,$opstina,$brojTelefona,$email,$placanje,$dostava,$iznos,$userId,$conn){
        $query = "INSERT INTO transaction(adresa,opstina,brojTelefona,email,placanje,dostava,iznos,userId) VALUES('$adresa','$opstina','$brojTelefona','$email','$placanje','$dostava','$iznos','$userId')";
        return $conn->query($query);
    }

    public static function getTransaction($conn){
        $query = "SELECT transactionId FROM transaction ORDER BY transactionId DESC LIMIT 1";
        return $conn->query($query);
    }
}
?>