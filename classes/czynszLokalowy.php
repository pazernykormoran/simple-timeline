<?php 
class CzynszLokalowy{
    private $id;
    private $lokal;
    private $uzytkownik;
    private $data;
    private $kwota;
    private $budzet;

    function __construct($id,$lokal,$uzytkownik,$data,$kwota,$budzet) {
        $this->id=$id;
        $this->lokal=$lokal;
        $this->uzytkownik=$uzytkownik;
        $this->data=$data;
        $this->kwota=$kwota;
        $this->budzet=$budzet;
     }

     public function getId(){
        return $this->id;
    }

    public function getLokal(){
        return $this->lokal;
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