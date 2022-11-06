<?php



include_once('model/model.php');
// include 'classes/adres.php';
// include 'classes/usterka.php';
// include 'classes/budynek.php';
include 'classes/event.php';
include 'classes/type.php';

class WydarzeniaModel extends Model{

    public function pobierzWydarzenia() {
   
        $query="SELECT e.id as eid, e.startDate, e.endDate, e.shortDescription, e.longDescription, e.imgUrl, e.name as ename, t.id as tid, t.name as tname, t.icon
        From events as e
        LEFT JOIN `types` as t
        ON t.id = e.typeId";
            
        $select=$this->pdo->query($query);
        
        foreach ($select as $row) {
            $data[]=new Event($row["eid"],$row["ename"], $row["startDate"], $row["endDate"], $row["shortDescription"], $row["longDescription"], $row["imgUrl"], new Type($row["tid"], $row["tname"], $row["icon"]));
        }

        return $data;

    }

    public function pobierzWydarzenieId($id) {
   
        $query="SELECT e.id as eid, e.startDate, e.endDate, e.shortDescription, e.longDescription, e.imgUrl, e.name as ename, t.id as tid, t.name as tname, t.icon
        From events as e
        LEFT JOIN `types` as t
        ON t.id = e.typeId
        WHERE e.id = ".$id;
            
        $select=$this->pdo->query($query);
        
        foreach ($select as $row) {
            $data[]=new Event($row["eid"],$row["ename"], $row["startDate"], $row["endDate"], $row["shortDescription"], $row["longDescription"], $row["imgUrl"], new Type($row["tid"], $row["tname"], $row["icon"]));
        }

        return $data[0];

    }

    public function dodajWydarzeniePerform($postArray, $filesArray) {
         

        if($this->validateWydarzenie($postArray)) {
            $url = '';

            if (isset($filesArray['fileToUpload']['name'])) {
                $image_info = getimagesize($filesArray["fileToUpload"]["tmp_name"]);
                if($image_info[0] != 60 && $image_info[1] != 60){
                    return False;
                }
                $url = $this->zapiszPlik($filesArray);
            }
            
            // $wydarzenie = new Event(null, date("Y/m/d"),"Zgloszono",$postArray['temat'],$postArray['opis'],$postArray['adres'],$_SESSION['idUzytkownika'],$_SESSION['idWspolnoty']);
            $wydarzenie = new Event(null, $postArray['name'], 
                    date("Y/m/d", strtotime($postArray['startDate'])), date("Y/m/d", strtotime($postArray['endDate'])), 
                    $postArray['shortDescription'], $postArray['longDescription'], $url, null);
            $this->dodajWydarzenie($wydarzenie, $postArray['type']);
            return true;
        }
       else{
            return false;
        }

    }

    public function edytujWydarzeniePerform($postArray, $filesArray, $wydarzenieOrig) {

        if($this->validateWydarzenie($postArray)) {
            $url = $wydarzenieOrig->getImgUrl();

            if (isset($filesArray['fileToUpload']['name']) && $filesArray['fileToUpload']['name'] != '') {
                $image_info = getimagesize($filesArray["fileToUpload"]["tmp_name"]);
                if($image_info[0] != 60 && $image_info[1] != 60){
                    return False;
                }
                $url = $this->zapiszPlik($filesArray);
            }
            
            // $wydarzenie = new Event(null, date("Y/m/d"),"Zgloszono",$postArray['temat'],$postArray['opis'],$postArray['adres'],$_SESSION['idUzytkownika'],$_SESSION['idWspolnoty']);
            $wydarzenie = new Event($wydarzenieOrig->getId(), $postArray['name'], 
                    date("Y/m/d", strtotime($postArray['startDate'])), date("Y/m/d", strtotime($postArray['endDate'])), 
                    $postArray['shortDescription'], $postArray['longDescription'], $url, null);
            $this->edytujWydarzenie($wydarzenie, $postArray['type']);
            return true;
        }
       else{
            return false;
        }


    }

    // public function pobierzAdresyBudynkowWspolnoty($id) {
    //     $query="SELECT DISTINCT miejscowosc,nrMieszkania,ulica, kodPocztowy, idZewnetrzne
    //     From adresy
    //     Where idZewnetrzne IN ( 
    //         SELECT id 
    //         From budynki
    //         Where idWspolnoty =".$id.")";
            
    //     $select=$this->pdo->query($query);
    //     foreach ($select as $row) {
    //         $data[]=new Adres(null, $row["kodPocztowy"],$row["miejscowosc"],$row["nrMieszkania"],$row["ulica"], $row["idZewnetrzne"]);
    //     }

    //     return $data;
    // }

   private function dodajWydarzenie($wydarzenie, $typeId) {
        $ins=$this->pdo->prepare('INSERT INTO events (typeId, startDate, endDate, shortDescription, longDescription, imgUrl, name) VALUES (
            :typeId, :startDate, :endDate, :shortDescription, :longDescription, :imgUrl, :name)');
        $ins->bindValue(':typeId',$typeId , PDO::PARAM_INT);
        $ins->bindValue(':startDate', $wydarzenie->getStartDate(), PDO::PARAM_STR);
        $ins->bindValue(':endDate', $wydarzenie->getEndDate(), PDO::PARAM_STR);
        $ins->bindValue(':shortDescription', $wydarzenie->getShortDescription(), PDO::PARAM_STR);
        $ins->bindValue(':longDescription', $wydarzenie->getLongDescription(), PDO::PARAM_STR);
        $ins->bindValue(':imgUrl', $wydarzenie->getImgUrl(), PDO::PARAM_STR);
        $ins->bindValue(':name', $wydarzenie->getName(), PDO::PARAM_STR);
        $ins->execute();
    }

    private function edytujWydarzenie($wydarzenie, $typeId) {
        $query = "UPDATE events SET typeId=?, startDate=?, endDate=?, shortDescription=?, longDescription=?, imgUrl=?, name=? WHERE id=?";
        $this->pdo->prepare($query)->execute([ $typeId, 
            $wydarzenie->getStartDate(), $wydarzenie->getEndDate(), $wydarzenie->getShortDescription(), $wydarzenie->getLongDescription(),
            $wydarzenie->getImgUrl(), $wydarzenie->getName(), $wydarzenie->getId()]);
    }

    private function zapiszPlik($filesArray){
        $_FILES = $filesArray;
        $target_dir = "img/";
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
        return $target_file;
    }

    private function validateWydarzenie($postArray) {
        if (isset($postArray['name']) && $postArray['name'] != null && 
            isset($postArray['startDate']) && $postArray['startDate'] != null && 
            isset($postArray['endDate']) && 
            isset($postArray['shortDescription']) && $postArray['shortDescription'] != null && 
            isset($postArray['longDescription']) && $postArray['longDescription'] != null && 
            $_SESSION['uzytkownik'] &&  $_SESSION['idWspolnoty']) {
            return true;
        }
        else {
            return false;
        }
    }

}
?>