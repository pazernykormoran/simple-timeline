<?php 
class Kategoria{
    private $id;
    private $nazwa;
    private $podzialKosztow;//rowno albo w zależności od metrażu mieszkania

    function __construct($id,$podzialKosztow,$nazwa) {
        $this->id=$id;
        $this->nazwa=$nazwa;
        $this->podzialKosztow=$podzialKosztow;
     }

     public function getId(){
        return $this->id;
    }

    public function getNazwa(){
        return $this->nazwa;
    }
    
    public function getPodzialKosztow(){
        return $this->podzialKosztow;
    }
}
?>