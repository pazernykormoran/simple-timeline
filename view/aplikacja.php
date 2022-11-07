<?php

include 'view/view.php';

class AplikacjaView extends View{


    public function  dashboard() {
        $this->setNecessery();
        $model=$this->loadModel('wydarzenia');
        $wydarzenia=$model->pobierzWydarzenia();
        $this->set('wydarzenia',$wydarzenia);
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('aplikacja/dashboard');
    }
    public function  logowanie() {
        $this->setNecessery();
        $this->render('aplikacja/logowanie');
    }
    public function zapomnialemHasla() {
        $this->setNecessery();
        $this->render('aplikacja/zapomnialemHasla');
    }
    public function pytaniePomocnicze($pytaniePomocnicze) {
        $this->setNecessery();
        $this->set('pytaniePomocnicze',$pytaniePomocnicze);
        $this->render('aplikacja/pytaniePomocnicze');
    }
    public function zmienHaslo(){
        $this->setNecessery();
        $this->render('aplikacja/zmienHaslo');
    }
}
?>
