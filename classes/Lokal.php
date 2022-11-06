<?php 
class Lokal{
    private $id;
    private $czynsz;
    private $numer;
    private $powierzchnia;
    private $subkonto;
    private $wynajety;
    private $zagospodarowanie;
    private $adres;

    function __construct($id,$czynsz,$numer,$powierzchnia,$subkonto,$wynajety,$zagospodarowanie,$adres) {
        $this->id=$id;
        $this->czynsz=$czynsz;
        $this->numer=$numer;
        $this->powierzchnia=$powierzchnia;
        $this->wynajety=$wynajety;
        $this->zagospodarowanie=$zagospodarowanie;
        $this->adres=$adres;
     }

     public function getAdres(){
        return $this->adres;
    }

    public function getId(){
        return $this->id;
    }

    public function getCzynsz(){
        return $this->czynsz;
    }

    public function getNumer(){
        return $this->numer;
    }

    public function getPowierzchnia(){
        return $this->powierzchnia;
    }

    public function getSunkonto(){
        return $this->subkonto;
    }

    public function getWynajety(){
        return $this->wynajety;
    }

    public function getZagospodarowanie(){
        return $this->zagospodarowanie;
    }

}
?>