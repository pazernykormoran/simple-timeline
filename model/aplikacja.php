<?php


include 'model/model.php';
include 'classes/user.php';


class AplikacjaModel extends Model{

    public function logowanieValidate($postArray) {
       
        if(isset($postArray['login'])&&isset($postArray['haslo'])){
            $query="SELECT id, login as login , password, question, answer, role
            From users 
            Where login=?";
            
            // $select=$this->pdo->query($query);
            $prepared = $this->pdo->prepare($query);
            $prepared->execute([ $postArray['login']]);
            $select = $prepared->fetchAll();
            
            $uzytkownik = null;
            foreach ($select as $row) {
                echo 'asd';
                if (password_verify($postArray['haslo'], $row['password'])){
                    echo 'verified';
                    $uzytkownik=new User(
                        $row["id"],$row["login"],$row["question"],$row["answer"],$row["role"]);
                }

            }   
        }
        if($uzytkownik == null){
            return false;
        }

        $_SESSION['uzytkownik']=strval( $uzytkownik->getLogin() );
        $_SESSION['idUzytkownika']=strval( $uzytkownik->getId() );
        $_SESSION['idWspolnoty']=1;
        $_SESSION['rolaUzytkownika']=strval( $uzytkownik->getRole() );;

        return true;

    }
    public function zapomnialemHaslaValidate($postArray) {
        if(isset($postArray['login/email'])){
            $query="SELECT question
            From users 
            Where login=?";
            // $select=$this->pdo->query($query);
            $prepared = $this->pdo->prepare($query);
            $prepared->execute([ $postArray['login/email']]);
            $select = $prepared->fetchAll();

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
            Where answer=?";
            // $select=$this->pdo->query($query);
            $prepared = $this->pdo->prepare($query);
            $prepared->execute([$postArray['answer']]);
            $select = $prepared->fetchAll();
            foreach ($select as $row) {
                return True;
            }  
            return false;
        }
        else{
            return false;
        }

        
    }
    public function zmienHasloPerform($postArray) {

        if(isset($postArray['haslo1']) && isset($postArray['haslo2'])){
            //sprawdz czy dobra answer
            $login = null;
            if(isset($_SESSION['uzytkownik'])){
                $login=$_SESSION['uzytkownik'];
            }else if(isset($_SESSION['login'])){
                $login=$_SESSION['login'];
            }
            
            if($login&&$postArray['haslo1']==$postArray['haslo2']){
                $hashed_password = password_hash($postArray['haslo1'], PASSWORD_DEFAULT);
                echo $hashed_password;
                $query="UPDATE users 
                SET password=? 
                WHERE login =?";
                // $select=$this->pdo->query($query);
                $prepared = $this->pdo->prepare($query);
                $prepared->execute([$hashed_password, $login]);
                // $select = $prepared->fetchAll();
    
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
