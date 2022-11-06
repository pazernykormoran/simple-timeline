<?php 
class Budynek{
    private $id;
    private $adres;
    private $wspolnotaMieszkaniowa;

    function __construct($id,$adres,$wspolnotaMieszkaniowa) {
        $this->id=$id;
        $this->adres=$adres;
        $this->wspolnotaMieszkaniowa=$wspolnotaMieszkaniowa;
     }

     public  function getId(){
        return $this->id;
    }

    public  function getAdres(){
        return $this->adres;
    }

    public function getWspolnotaMieszkaniowa(){
        return $this->wspolnotaMieszkaniowa;
    }
}
?>