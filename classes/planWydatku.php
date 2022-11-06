<?php 
class PlanWydatku{
    private $id;
    private $czestotliwoscRoczna;
    private $kwota;
    private $nazwa;
    private $kategoria;
    private $wydatki=array();

    function __construct($id,$czestotliwoscRoczna,$kwota,$nazwa,$kategoria,$wydatki) {
        $this->id=$id;
        $this->czestotliwoscRoczna=$czestotliwoscRoczna;
        $this->kwota=$kwota;
        $this->nazwa=$nazwa;
        $this->kategoria=$kategoria;
        $this->wydatki=$wydatki;
     }

     public function getId(){
        return $this->id;
    }

    public function getCzestotliwoscRoczna(){
        return $this->czestotliwoscRoczna;
    }
    
    public function getKwota(){
        return $this->kwota;
    }
    
    public function getNazwa(){
        return $this->nazwa;
    }

    public function getKategoria(){
        return $this->kategoria;
    }

    public function getWydatki(){
        return $this->wydatki;
    }

    public function setWydatki($wydatki){
        $this->wydatki=$wydatki;
    }

    public function setKategoria($kategoria){
        $this->kategoria=$kategoria;
    }

}
?>