<?php

class Article{
    public $id;
    public $naziv;
    public $marka;
    public $cena;
    public $velicina;

    public function __construct($id=null,$naziv=null,$marka=null,$cena=null,$velicina=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->marka = $marka;
        $this->cena = $cena;
        $this->velicina = $velicina;
    }


    public static function getArticles($conn){
        $query = "SELECT * FROM articles";
        return $conn->query($query);
    }
}



?>
