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
        WHERE id=?";
            
        $prepared = $this->pdo->prepare($query);
        $prepared->execute([ $id]);
        $select = $prepared->fetchAll();
        
        foreach ($select as $row) {
            $data[]=new Type($row["id"],$row["name"], $row["icon"]);
        }

        return $data[0];

    }

    public function usunTypId($id) {
        if(isset($id) && $id != '' && $id != null){
            try {
                $query="DELETE
                From types 
                WHERE id=?";
                $this->pdo->prepare($query)->execute([ $id]);
                return true;
            } catch (Exception $e) {
                return false;
            }

        }
        return false;
    }

    public function dodajTypPerform($postArray, $filesArray) {
         

        if($this->validateTyp($postArray)) {
            $url = '';

            if (isset($filesArray['fileToUpload']['name'])  && $filesArray['fileToUpload']['name'] != '') {
                $image_info = getimagesize($filesArray["fileToUpload"]["tmp_name"]);
                if($image_info[0] != 100 && $image_info[1] != 100){
                    return False;
                }
                $url = $this->zapiszPlik($filesArray);
            }
            
            $typ = new Type(null, $postArray['name'], $url);
            $this->dodajTyp($typ);
            return true;
        }
       else{
            return false;
        }

    }

    public function edytujTypPerform($postArray, $filesArray, $typOrig) {

        if($this->validateTyp($postArray)) {
            $url = $typOrig->getIcon();

            if (isset($filesArray['fileToUpload']['name']) && $filesArray['fileToUpload']['name'] != '') {
                $image_info = getimagesize($filesArray["fileToUpload"]["tmp_name"]);
                if($image_info[0] != 100 && $image_info[1] != 100){
                    return False;
                }
                $url = $this->zapiszPlik($filesArray);
            }
            
            $typ = new Type($typOrig->getId(), $postArray['name'], $url);
            $this->edytujTyp($typ);
            return true;
        }
       else{
            return false;
        }


    }


   private function dodajTyp($typ) {
        $ins=$this->pdo->prepare('INSERT INTO types (name, icon) VALUES (
            :name, :icon)');
        $ins->bindValue(':name', $typ->getName(), PDO::PARAM_STR);
        $ins->bindValue(':icon', $typ->getIcon(), PDO::PARAM_STR);
        $ins->execute();
    }

    private function edytujTyp($typ) {
        $query = "UPDATE types SET name=?, icon=? WHERE id=?";
        $this->pdo->prepare($query)->execute([ $typ->getName(), $typ->getIcon(), $typ->getId()]);
    }

    private function zapiszPlik($filesArray){
        $_FILES = $filesArray;
        $target_dir = "js/timeglider/icons";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
        return basename($_FILES["fileToUpload"]["name"]);
    }

    private function validateTyp($postArray) {
        if (isset($postArray['name']) && $postArray['name'] != null && 
            $_SESSION['uzytkownik'] &&  $_SESSION['idWspolnoty']) {
            return true;
        }
        else {
            return false;
        }
    }

}
?>

