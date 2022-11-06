<?php 
class Adres{
    private $id;
    private $kodPocztowy;
    private $miejscowosc;
    private $numerMieszkania;
    private $ulica;
    private $budynek;

    function __construct($id,$kodPocztowy,$miejscowosc,$numerMieszkania,$ulica,$budynek) {
        $this->id=$id;
        $this->kodPocztowy=$kodPocztowy;
        $this->miejscowosc=$miejscowosc;
        $this->numerMieszkania=$numerMieszkania;
        $this->ulica=$ulica;
        $this->budynek=$budynek;
     }

//todo zrobić gettery i settery\
public function getMiejscowosc(){
    return $this->miejscowosc;
}

public function getNumerMieszkania(){
    return $this->numerMieszkania;
}

public function getUlica(){
    return $this->ulica;
}

public function getBudynek(){
    return $this->budynek;
}
public function getId(){
    return $this->id;
}

public function getKodPocztowy(){
    return $this->kodPocztowy;
}

}
?>