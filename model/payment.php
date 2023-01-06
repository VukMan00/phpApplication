<?php

class Payment{
    public $id;
    public $banka;
    public $brojRacuna;
    public $transactionId;


    function __construct($id=null,$banka=null,$brojRacuna=null,$transactionId=null)
    {
        $this->id = $id;
        $this->banka = $banka;
        $this->brojRacuna = $brojRacuna;
        $this->transactionId = $transactionId;
    }

    public static function addPayment($banka,$brojRacuna,$transactionId,$conn){
        $query = "INSERT INTO datapayment(banka,brojRacuna,transactionId) VALUES('$banka','$brojRacuna','$transactionId')";
        return $conn->query($query);
    }
}





?>