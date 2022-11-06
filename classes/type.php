<?php 
class Type{
    private $id;
    private $name;
    private $icon;


    function __construct($id, $name, $icon) {
        $this->id=$id;
        $this->name=$name;
        $this->icon=$icon;
     }

     public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getIcon(){
        return $this->icon;
    }

}
?>