<?php
include_once('model/model.php');
include_once 'classes/type.php';

class TypyModel extends Model{

    public function pobierzTypy() {
   
        $query="SELECT id, name, icon From types";
        $select=$this->pdo->query($query);
        
        foreach ($select as $row) {
            $data[]=new Type($row["id"],$row["name"], $row["icon"]);
        }

        return $data;

    }

    public function pobierzTypId($id) {
   
        $query="SELECT id, name, icon
        From types 
        WHERE name = ".$id;
            
        $select=$this->pdo->query($query);
        
        foreach ($select as $row) {
            $data[]=new Type($row["id"],$row["name"], $row["icon"]);
        }

        return $data[0];

    }

}
?>
