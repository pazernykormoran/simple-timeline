<?php 
class Usterka{
    private $id;
    private $dataZgloszenia;
    private $stanRealizacji;
    private $temat;
    private $opis;
    private $budynek;
    private $uzytkownik;
    private $wspolnotaMieszkaniowa;

    function __construct($id,$dataZgloszenia,$stanRealizacji,$temat,$opis,$budynek,$uzytkownik, $wspolnotaMieszkaniowa) {
        $this->id=$id;
        $this->dataZgloszenia=$dataZgloszenia;
        $this->stanRealizacji=$stanRealizacji;
        $this->temat=$temat;
        $this->opis=$opis;
        $this->budynek=$budynek;
        $this->uzytkownik=$uzytkownik;
        $this->wspolnotaMieszkaniowa=$wspolnotaMieszkaniowa;
     }

     public function getId(){
        return $this->id;
    }

    public function getDataZgloszenia(){
        return $this->dataZgloszenia;
    }

    public function getStanRealizacji(){
        return $this->stanRealizacji;
    }

    public function getTemat(){
        return $this->temat;
    }

    public function getOpis(){
        return $this->opis;
    }

    public function getBudynek(){
        return $this->budynek;
    }

    public function getUzytkownik(){
        return $this->uzytkownik;
    }

    public function getWspolnotaMieszkaniowa(){
        return $this->wspolnotaMieszkaniowa;
    }

    

}
?>