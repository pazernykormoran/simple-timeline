<?php 
class User{
    private $id;
    private $login;
    private $question;
    private $answer;  
    private $role;

    function __construct($id, $login, $question,$answer, $role) {
        $this->id=$id;
        $this->login=$login;
        $this->question=$question;
        $this->answer=$answer;
        $this->role=$role;
     }

     public function getId(){
        return $this->id;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function getAnswer(){
        return $this->answer;
    }

    public function getRole(){
        return $this->role;
    }
}
?>