<?php 
class WspolnotaMieszkaniowa{
    private $id;
    private $nazwa;
    private $numerKonta;

    function __construct($id,$nazwa, $numerKonta) {
        $this->id=$id;
        $this->nazwa=$nazwa;
        $this->numerKonta=$numerKonta;
     }

     public function getId(){
        return $this->id;
    }

    public function getNazwa(){
        return $this->nazwa;
    }

    public function getNumerKonta(){
        return $this->numerKonta;
    }


}
?>