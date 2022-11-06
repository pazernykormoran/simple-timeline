<?php 
class CzynszMieszkaniowy{
    private $id;
    private $mieszkanie;
    private $uzytkownik;
    private $data;
    private $kwota;
    private $budzet;

    function __construct($id,$mieszkanie,$uzytkownik,$data,$kwota,$budzet) {
        $this->id=$id;
        $this->mieszkanie=$mieszkanie;
        $this->uzytkownik=$uzytkownik;
        $this->data=$data;
        $this->kwota=$kwota;
        $this->budzet=$budzet;
     }

     public function getId(){
        return $this->id;
    }

    public function getMieszkanie(){
        return $this->mieszkanie;
    }

    public function getUzytkownik(){
        return $this->uzytkownik;
    }

    public function getData(){
        return $this->data;
    }

    public function getKwota(){
        return $this->kwota;
    }

    public function getBudzet(){
        return $this->budzet;
    }
}
?>