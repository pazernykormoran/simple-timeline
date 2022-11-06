<?php 
class Event{
    private $id;
    private $name;
    private $startDate;
    private $endDate;
    private $shortDescription;
    private $longDescription;
    private $imgUrl;
    private $type;

    function __construct($id,$name,$startDate,$endDate,$shortDescription,$longDescription,$imgUrl, $type) {
        $this->id=$id;
        $this->name=$name;
        $this->startDate=$startDate;
        $this->endDate=$endDate;
        $this->shortDescription=$shortDescription;
        $this->longDescription=$longDescription;
        $this->imgUrl=$imgUrl;
        $this->type=$type;
     }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getStartDate(){
        return $this->startDate;
    }

    public function getEndDate(){
        return $this->endDate;
    }

    public function getShortDescription(){
        return $this->shortDescription;
    }

    public function getLongDescription(){
        return $this->longDescription;
    }

    public function getImgUrl(){
        return $this->imgUrl;
    }

    public function getType(){
        return $this->type;
    }

}
?>