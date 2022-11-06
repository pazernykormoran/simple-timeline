<?php 
class Mieszkanie{
    private $id;
    private $czynsz;
    private $numer;
    private $powierzchnia;
    private $subkonto;
    private $adres;

    function __construct($id,$czynsz,$numer,$powierzchnia,$subkonto,$adres) {
        $this->id=$id;
        $this->czynsz=$czynsz;
        $this->numer=$numer;
        $this->powierzchnia=$powierzchnia;
        $this->subkonto=$subkonto;
        $this->adres=$adres;
     }

     public function getId(){
        return $this->id;
    }
    
    public function getAdres(){
        //echo $this->adres->getMiejscowosc();
        return $this->adres;
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

    public function getSubkonto(){
        return $this->subkonto;
    }

}
?>