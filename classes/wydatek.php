<?php 
class Wydatek{
    private $id;
    private $idPlanuWydatkow;
    private $idUsterki;
    private $dataRealizacji;
    private $kwota;
    private $opis;

    function __construct($id,$idPlanuWydatkow,$idUsterki,$dataRealizacji,$kwota,$opis) {
        $this->id=$id;
        $this->idPlanuWydatkow=$idPlanuWydatkow;
        $this->idUsterki=$idUsterki;
        $this->dataRealizacji=$dataRealizacji;
        $this->kwota=$kwota;
        $this->opis=$opis;
     }

     public function getId(){
        return $this->id;
    }

    public function getIdPlanuWydatkow(){
        return $this->idPlanuWydatkow;
    }

    public function getIdUsterki(){
        return $this->idUsterki;
    }

    public function getDataRealizacji(){
        return $this->dataRealizacji;
    }

    public function getKwota(){
        return $this->kwota;
    }

    public function getOpis(){
        return $this->opis;
    }

}
?>