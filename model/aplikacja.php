<?php


include 'model/model.php';
include 'classes/user.php';


class AplikacjaModel extends Model{

    public function logowanieValidate($postArray) {
       
        if(isset($postArray['login'])&&isset($postArray['haslo'])){
            $query="SELECT id, login as login , password, question, answer, role
            From users 
            Where login= '".$postArray['login'] ."' AND password= '".$postArray['haslo'] ."'";
            
            $select=$this->pdo->query($query);
            $uzytkownik;
            foreach ($select as $row) {
                
                $uzytkownik=new User(
                    $row["id"],$row["login"],$row["question"],$row["answer"],$row["role"]);
            }   
        }

        if($select->rowCount()>0){
            $_SESSION['uzytkownik']=strval( $uzytkownik->getLogin() );
            $_SESSION['idUzytkownika']=strval( $uzytkownik->getId() );
            $_SESSION['idWspolnoty']=1;
            $_SESSION['rolaUzytkownika']=strval( $uzytkownik->getRole() );;

            return true;
        }else{
            return false;
        }
    }
    public function zapomnialemHaslaValidate($postArray) {
        if(isset($postArray['login/email'])){
            $query="SELECT question
            From users 
            Where login= '".$postArray['login/email']."'";
            $select=$this->pdo->query($query);
            $pytPomocznicze;
            foreach ($select as $row) {
                $pytPomocznicze=$row["question"];
                $_SESSION['login']=$postArray['login/email'];
            }  
            if($pytPomocznicze){
                return $pytPomocznicze;
            }else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    public function pytaniePomocniczeValidate($postArray) {


        if(isset($postArray['answer'])){
            $query="SELECT id
            From users 
            Where answer= '".$postArray['answer']."'";
            $select=$this->pdo->query($query);
            if($select->rowCount() > 0){
            return true;
            }
            return false;
        }
        else{
            return false;
        }

        
    }
    public function zmienHasloPerform($postArray) {
        //zapisz dane do bazy. (email pobierz z sesji jako email zapisany w funkcji zapomniałęm hasło albo po prostu z użytkownika zapisanego w sesji jeśli jest zalogowany)
            //postarray ma "haslo"

        //zwraca bool czy udało się zapisać
        echo 'SIEMAaaaaaaaaa';
        if(isset($postArray['haslo1']) && isset($postArray['haslo2'])){
            //sprawdz czy dobra answer
            $login;
            if(isset($_SESSION['uzytkownik'])){
                $login=$_SESSION['uzytkownik'];
            }else if(isset($_SESSION['login'])){
                $login=$_SESSION['login'];
            }
            
            if($login&&$postArray['haslo1']==$postArray['haslo2']){
                $query="UPDATE users 
                SET password= '". $postArray['haslo1'] ."'
                WHERE login = '". $login ."'";
                $select=$this->pdo->query($query);
                return true;
            }else{
                return false;
            }
           
        }
        else{
            return false;
        }
    }



}
?>
